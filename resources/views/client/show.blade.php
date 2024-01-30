@extends('layouts.app', ['pageTitle' => $client->name . ' ' . $client->surname])

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
    <div class="bgm-crm-dark" style="margin: -16px -15px -40px -15px;padding: 30px 46px 70px">
        <div class="">
            <div class="c-white pull-right">
                <i class="zmdi zmdi-comment-text p-l-5 p-t-4 pull-right"></i>
                {!! $client->notes ? nl2br($client->notes):'-' !!}
            </div>
            <div class="c-white m-b-5">
                <i class="zmdi zmdi-library p-r-5 p-t-2 pull-left"></i>
                Κωδ. Πελάτη: {{ $client->id or '-' }}
            </div>
            <div class="c-white m-b-5">
                <i class="zmdi zmdi-phone p-r-5 p-t-3 pull-left"></i>
                <a class="c-white" href="tel:{{ $client->phone or '' }}">{{ $client->phone or '-' }}</a>
            </div>
            <div class="c-white">
                <i class="zmdi zmdi-email p-r-5 p-t-4 pull-left"></i>
                <a class="c-white" href="mailto:{{ $client->email or '' }}">{{ $client->email or '-' }}</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body card-padding f-700 c-black brd-4">
            @include('layouts.error')
            ΣΗΜΕΡΑ
        </div>
        @if(isset($labor['today']) && count($labor['today']) > 0)
            <div class="table-responsive">
                <table class="table table-condensed table-va-middle">
                    <thead>
                        <tr>
                            <th width="100">&nbsp;</th>
                            <th width="10">&nbsp;</th>
                            <th width="150">ΗΜΕΡΟΜΗΝΙΑ</th>
                            <th width="100">TIMH</th>
                            <th width="300">ΑΝΤΙΚΕΙΜΕΝΟ</th>
                            <th>ΣΗΜΕΙΩΣΕΙΣ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($labor['today'] as $index => $lab)
                            <tr>
                                <td>
                                    <a href="{{ route('client.labor.destroy', ['id' => $client->id, 'lid' => $lab->id]) }}" class="c-orange p-r-15">
                                        <i class="zmdi zmdi-delete f-s-18"></i>
                                    </a>
                                    <a href="{{ route('client.labor.edit', ['id' => $client->id, 'lid' => $lab->id]) }}" class="c-black">
                                        <i class="zmdi zmdi-edit f-s-18"></i>
                                    </a>
                                </td>
                                <td>
                                    @if(count($labor['today']) > 1)
                                        {{ $index === 0 ? '┌':'' }}
                                        {{ $index > 0 && $index + 1 < count($labor['today']) ? '├':'' }}
                                        {{ $index + 1 === count($labor['today']) ? '└':'' }}
                                    @else
                                        &nbsp;
                                    @endif
                                </td>
                                <td>{{ $lab->date or '' }}</td>
                                <td>{{ $lab->price or '' }} &euro;</td>
                                <td>{{ $lab->item->namePublic or '' }}</td>
                                <td>{{ $lab->notes or '' }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>ΣΥΝΟΛΟ</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>
                                {{ array_sum($labor['today']->pluck('price')->toArray()) }} &euro;
                            </th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
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

        <div class="card-body card-padding m-t-30 f-700 c-black">
            ΙΣΤΟΡΙΚΟ ({{count($labor['old'])}})
        </div>

        @if(isset($labor['old']) && count($labor['old']) > 0)
            <div class="table-responsive">
                <table class="table table-condensed table-va-middle">
                    <thead>
                        <tr>
                            <th width="100">&nbsp;</th>
                            <th width="10">&nbsp;</th>
                            <th width="150">ΗΜΕΡΟΜΗΝΙΑ</th>
                            <th width="100">ΤΙΜΗ</th>
                            <th width="300">ΑΝΤΙΚΕΙΜΕΝΟ</th>
                            <th>ΣΗΜΕΙΩΣΕΙΣ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $laborGroupped = $labor['old']->groupBy('date');
                        @endphp
                        @foreach($laborGroupped as $date => $labs)
                            @foreach($labs as $index => $lab)
                            <tr>
                                <td>
                                    @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('client.labor.destroy', ['id' => $client->id, 'lid' => $lab->id]) }}" class="c-orange p-r-15">
                                        <i class="zmdi zmdi-delete f-s-18"></i>
                                    </a>
                                    @endif
                                    <a href="{{ route('client.labor.edit', ['id' => $client->id, 'lid' => $lab->id]) }}" class="c-black">
                                        <i class="zmdi zmdi-edit f-s-18"></i>
                                    </a>
                                </td>
                                <td>
                                    @if(count($labs) > 1)
                                        {{ $index === 0 ? '┌':''}}
                                        {{ $index > 0 && $index + 1 < count($labs) ? '├':''}}
                                        {{ $index + 1 === count($labs) ? '└':''}}
                                    @else
                                        &nbsp;
                                    @endif
                                </td>
                                <td>{{ $lab->date }}</td>
                                <td>{{ $lab->price or '' }} &euro;</td>
                                <td>{{ $lab->item->namePublic or '' }}</td>
                                <td>{{ $lab->notes or '' }}</td>
                            @endforeach
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

    <a data-toggle="modal" href="#modalMain" class="btn bgm-crm btn-icon ccta waves-effect">
        <i class="zmdi zmdi-plus"></i>
    </a>

    <div class="modal fullscreen" id="modalMain" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="height:100vh">
                {!! Form::open(['url' => route('client.labor.store', $client->id), 'method' => 'POST', 'class' => 'form-store-labor']) !!}
                    <div style="display:flex;flex-direction:column;height:100vh;">
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
                        </div>
                        <div role="tabpanel" style="flex-grow:1;overflow-y:scroll">
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

                        <div class="" style="border-top: 2px solid #EEEEEE">
                            <div class="m-l-15 m-r-15">
                                <h3 class="catalog-name m-b-15"></h3>
                                <input name="catalog_id" type="hidden" class="catalog-id" value="">

                                <div class="row cart-details">
                                    <div class="col-md-2 col-xs-6 m-b-10">
                                        <label for="date">ΗΜΕΡΟΜΗΝΙΑ</label>
                                        <input id="date" type="text" name="date" class="form-control input-mask" data-mask="00/00/0000" placeholder="dd/mm/yyyy" value="{{ date('d-m-Y') }}" autocomplete="off" required="required">
                                    </div>
                                    <div class="col-md-2 col-xs-6 m-b-10">
                                        <label for="price">ΤΙΜΗ</label>
                                        <input id="price" name="price" type="number" step=".01" class="form-control item-price" value="{{ Request::old('price') }}" required="required">
                                    </div>
                                    <div class="col-md-8 col-xs-12 m-b-10">
                                        <label for="notes">ΣΗΜΕΙΩΣΕΙΣ</label>
                                        <textarea rows="2" id="notes" class="form-control" name="notes" placeholder="...">{{ Request::old('notes') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer cart-details">
                                <a href="#" class="btn btn-link a-prevent" data-dismiss="modal">ΑΚΥΡΟ</a>
                                <button disabled type="submit" class="btn add-to-cart bgm-crm">ΠΡΟΣΘΗΚΗ ΣΤΟ ΚΑΛΑΘΙ</button>
                            </div>
                        </div>
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
                $('.catalog-name').html('-')
                $('.catalog-id').val('');
                $('.cart-details').addClass('hide');
            });

            $(document).on('click', '[data-item]', function(e) {
                $('.cart-details').removeClass('hide');
                $('[data-item]').removeClass('catalog-item-selected');
                $(this).addClass('catalog-item-selected');
                $('.item-price').val($(this).data('price'));
                $('.catalog-name').html($(this).data('name'))
                $('.catalog-id').val($(this).data('id'))
                $('.add-to-cart').attr('disabled', false);
            });

            // $(document).on('click', '[data-payment]', function(e) {
            //     var id = $(this).data('id');
            //     var payment = $(this).data('payment');

            //     if($(this).hasClass('btn-primary')) return; // do nothing if user presses the same payment method

            //     $('[data-id='+id+']').removeClass('btn-primary').addClass('btn-link');
            //     $(this).removeClass('btn-link').addClass('btn-primary');

            //     console.log('labor', id, payment);

            //     $.ajax({
            //         method: "POST",
            //         url: "{{ route('async.client.labor.update', ['id' => $client->id, 'laborId' => 'laborId']) }}".replace('laborId', id),
            //         data: { pos: payment === 'pos' }
            //     })
            //     .done(function(data) {});
            // });

        });
    </script>
@endpush
