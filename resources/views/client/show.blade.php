@extends('layouts.app', ['pageTitle' => $client->name .' ' . $client->surname])

@push('vendorstyles')
  <link href="/assets/vendors/bower_components/chosen/chosen.css" rel="stylesheet">
@endpush

@push('backbutton')
  <li>
    <ul class="hi-menu">
      <li>
        <a href="{{ route('client.index') }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
      </li>
    </ul>
  </li>
@endpush

@push('actionbutton')
  <li>
    <a href="{{ route('client.edit', $client->id) }}"><i class="him-icon zmdi zmdi-edit"></i></a>
  </li>
@endpush

@section('content')
  <div style="background: #880E4F;margin: -16px -15px -40px -15px;padding: 30px 46px 70px">
    <div class="">
      <div class="c-white pull-right">
        {!! $client->notes ? nl2br($client->notes):'-' !!}
      </div>
      <div class="c-white m-b-5">
        <i class="zmdi zmdi-phone p-r-5 p-t-4 pull-left"></i>
        <a class="c-white" href="tel:{{ $client->phone or '' }}">{{ $client->phone or '-' }}</a>
      </div>
      <div class="c-white">
        <i class="zmdi zmdi-email p-r-5 p-t-5 pull-left"></i>
        <a class="c-white" href="mailto:{{ $client->email or '' }}">{{ $client->email or '-' }}</a>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body card-padding f-400 c-gray">
      @include('layouts.error')
      ΣΗΜΕΡΑ
    </div>
    @if(isset($labor['today']) && count($labor['today']) > 0)
      <div class="table-responsive">
        <table class="table table-striped table-condensed table-va-middle">
          <thead>
            <tr>
              <th>&nbsp;</th>
              <th width="150">ΗΜΕΡΟΜΗΝΙΑ</th>
              <th width="600">ΑΝΤΙΚΕΙΜΕΝΟ</th>
              <th>ΣΗΜΕΙΩΣΕΙΣ</th>
              <!-- <th>ΠΛΗΡΩΜΗ</th> -->
              <th>TIMH</th>
            </tr>
          </thead>
          <tbody>
            @foreach($labor['today'] as $lab)
              <tr>
                <td style="width:120px">
                  <a href="{{ route('client.labor.destroy', ['id' => $client->id, 'lid' => $lab->id]) }}" class="c-red p-r-15">
                    <i class="zmdi zmdi-delete f-s-22"></i>
                  </a>
                  <a href="{{ route('client.labor.edit', ['id' => $client->id, 'lid' => $lab->id]) }}" class="c-black">
                    <i class="zmdi zmdi-edit f-s-24"></i>
                  </a>
                </td>
                <td>{{ $lab->date or '' }}</td>
                <td>{{ $lab->item->namePublic or '' }}</td>
                <td>{{ $lab->notes or '' }}</td>
                <!-- <td>
                  <button class="btn btn-sm {{ !$lab->pos ? 'btn-primary':'btn-link' }}" data-id="{{ $lab->id }}" data-payment="cash">ΜΕΤΡΗΤΑ</button>
                  <button class="btn btn-sm {{ $lab->pos ? 'btn-primary':'btn-link' }}" data-id="{{ $lab->id }}" data-payment="pos">POS</button>
                </td> -->
                <td style="width:100px">{{ $lab->price or '' }} &euro;</td>
              </tr>
            @endforeach
            <tr>
              <th colspan="4">ΣΥΝΟΛΟ</th>
              <th>{{ array_sum($labor['today']->pluck('price')->toArray()) }} &euro;</th>
            </tr>
          </tbody>
        </table>
      </div>
    @else
      <div class="alert bgm-lightgray" role="alert">
        <div class="c-gray f-s-25 text-center">
          <i class="zmdi zmdi-shopping-basket"></i>
        </div>
      </div>
    @endif

    <div class="card-body card-padding m-t-30 f-400 c-gray">
      ΠΑΛΑΙΟΤΕΡΑ
    </div>

    @if(isset($labor['old']) && count($labor['old']) > 0)
      <div class="table-responsive">
        <table class="table table-striped table-condensed table-va-middle">
          <thead>
            <tr>
              <th>&nbsp;</th>
              <th width="150">ΗΜΕΡΟΜΗΝΙΑ</th>
              <th width="600">ΑΝΤΙΚΕΙΜΕΝΟ</th>
              <th>ΣΗΜΕΙΩΣΕΙΣ</th>
              <th>ΤΙΜΗ</th>
            </tr>
          </thead>
          <tbody>
            @foreach($labor['old'] as $lab)
              <tr>
                <td style="width:120px">
                  @if(Auth::user()->role === 'admin')
                  <a href="{{ route('client.labor.destroy', ['id' => $client->id, 'lid' => $lab->id]) }}" class="c-red p-r-15">
                    <i class="zmdi zmdi-delete f-s-22"></i>
                  </a>
                  @endif
                  <a href="{{ route('client.labor.edit', ['id' => $client->id, 'lid' => $lab->id]) }}" class="c-black">
                    <i class="zmdi zmdi-edit f-s-24"></i>
                  </a>
                </td>
                <td>{{ $lab->date or '' }}</td>
                <td>{{ $lab->item->namePublic or '' }}</td>
                <td>{{ $lab->notes or '' }}</td>
                <td style="width:100px">{{ $lab->price or '' }} &euro;</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="alert bgm-lightgray" role="alert">
        <div class="c-gray f-s-25 text-center">
          <i class="zmdi zmdi-shopping-basket"></i>
        </div>
      </div>
    @endif
  </div>

  <a data-toggle="modal" href="#modalMain" class="btn bgm-pink btn-icon ccta waves-effect">
    <i class="zmdi zmdi-plus"></i>
  </a>

  <div class="modal fullscreen" id="modalMain" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        {!! Form::open(['url' => route('client.labor.store', $client->id), 'method' => 'POST', 'class' => 'form-store-labor']) !!}
          <div role="tabpanel">
            <ul class="tab-nav" data-tab-color="black" role="tablist">
              @foreach($catalog->groupBy('cat') as $categoryName => $items)
                <li class="{{ $loop->first ? 'active':'' }}">
                  <a href="#tabCat{{ $loop->iteration }}" aria-controls="tabCat{{ $loop->iteration }}" role="tab" data-toggle="tab">
                    {{ $categoryName }}
                  </a>
                </li>
              @endforeach
            </ul>
            <div class="tab-content p-l-15 p-r-15">
              @foreach($catalog->groupBy('cat') as $categoryName => $items)
                <div role="tabpanel" class="tab-pane {{ $loop->first ? 'active':'' }}" id="tabCat{{ $loop->iteration }}">
                  @foreach($items->groupBy('brand') as $brand => $items)
                    @if(!empty($brand))
                      <div class="f-700 c-black m-b-10 {{ $loop->first ? '':'m-t-15' }}">{{ $brand or '-' }}</div>
                    @endif
                    
                    <div class="row">
                      @foreach($items->sortBy('name') as $item)
                        <div class="col-xs-12 col-sm-6 col-md-4 a-hover p-b-5 p-t-5 brd-2 catalog-item" data-item data-price="{{ $item->price or '' }}" data-name="{{ $item->name or '' }}" data-id="{{ $item->id or '' }}">
                          {{ $item->name or '' }} <span class="pull-right">&euro;{{ $item->price or '' }}</span>
                        </div>
                      @endforeach
                    </div>
                  @endforeach
                </div>
              @endforeach
            </div>
          </div>
          
          <div class="bgm-lightgray p-t-15">
            <div class="m-l-15 m-r-15">
              <div class="row">
                <div class="col-md-2 col-xs-12 m-b-15">
                  <div class="fg-line">
                    <label for="date">ΗΜΕΡΟΜΗΝΙΑ</label>
                    <input id="date" type="text" name="date" class="form-control input-mask" data-mask="00/00/0000" placeholder="dd/mm/yyyy" value="{{ date('d-m-Y') }}" autocomplete="off" required="required">
                  </div>
                </div>
                <div class="col-md-1 col-xs-12 m-b-15">
                  <div class="fg-line">
                    <label for="price">ΤΙΜΗ</label>
                    <input id="price" name="price" type="number" class="form-control item-price" value="{{ Request::old('price') }}" required="required">
                  </div>
                </div>
                <div class="col-md-3 col-xs-12 m-b-15">
                  <div class="fg-line">
                    <label>ΑΝΤΙΚΕΙΜΕΝΟ</label>
                    <input name="" type="text" class="form-control catalog-name disabled" disabled value="" required="required">
                    <input name="catalog_id" type="hidden" class="catalog-id" value="">
                  </div>
                </div>
                <div class="col-md-6 col-xs-12 m-b-15">
                  <div class="fg-line">
                    <label for="notes">ΣΗΜΕΙΩΣΕΙΣ</label>
                    <textarea rows="2" id="notes" class="form-control" name="notes" placeholder="...">{{ Request::old('notes') }}</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <a href="#" class="btn btn-link a-prevent" data-dismiss="modal">ΑΚΥΡΟ</a>
            <button type="submit" class="btn bgm-black">ΠΡΟΣΘΗΚΗ ΣΤΟ ΚΑΛΑΘΙ</button>
          </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop

@push('scripts')
  <script src="/assets/vendors/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var modal = $('#modalMain');

      modal.on('shown.bs.modal', function () {
        $('[data-item]').removeClass('catalog-item-selected');
        $('.item-price').val('');
        $('.catalog-name').val('')
        $('.catalog-id').val('')
      });

      $(document).on('click', '[data-item]', function(e) {
        $('[data-item]').removeClass('catalog-item-selected');
        $(this).addClass('catalog-item-selected');
        $('.item-price').val($(this).data('price'));
        $('.catalog-name').val($(this).data('name'))
        $('.catalog-id').val($(this).data('id'))
      });

      $(document).on('click', '[data-payment]', function(e) {
        var id = $(this).data('id');
        var payment = $(this).data('payment');

        if($(this).hasClass('btn-primary')) return; // do nothing if user presses the same payment method

        $('[data-id='+id+']').removeClass('btn-primary').addClass('btn-link');
        $(this).removeClass('btn-link').addClass('btn-primary');
        
        console.log('labor', id, payment);
        
        $.ajax({
          method: "POST",
          url: "{{ route('async.client.labor.update', ['id' => $client->id, 'laborId' => 'laborId']) }}".replace('laborId', id),
          data: { pos: payment === 'pos' }
        })
          .done(function(data) {});
      });

    });
  </script>
@endpush