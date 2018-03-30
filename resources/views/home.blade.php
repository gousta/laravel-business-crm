@extends('layouts.app', ['pageTitle' => 'Home'])

@push('vendorstyles')
    <link href="/assets/vendors/bower_components/chosen/chosen.css" rel="stylesheet">
@endpush

@section('content')

    <div class="card">
        <div class="card-header ch-alt text-center">
            <h2>Σύνολο <span class="f-700 cart-total">0</span>&euro;</h2>
        </div>
        <div class="card-body card-padding">
            <div class="m-b-15">
                <label for="client_id">Πελάτης</label>
                <select id="client_id" name="client_id" class="form-control user-select" data-placeholder="ΕΠΙΛΟΓΗ">
                    <option value=""></option>
                    
                    @foreach($clients as $client)
                        <option value="{{ $client->id or '' }}">
                            {{ $client->name or '' }} {{ $client->surname or '' }} - {{ $client->phone or '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">

                {!! Form::open(['url' => '', 'method' => 'POST', 'class' => 'form']) !!}

                @foreach($categories as $cat)
                    <div class="{{ $cat === 'ΤΕΧΝΙΚΕΣ ΕΡΓΑΣΙΕΣ' ? 'col-xs-12 col-md-6 col-lg-6':'col-xs-12 col-md-3 col-lg-3' }}">
                        <div class="f-s-15 f-700 m-b-15">{{ $cat }}</div>

                        <div class="{{ $cat === 'ΤΕΧΝΙΚΕΣ ΕΡΓΑΣΙΕΣ' ? 'col-split-2':'' }}">
                            @foreach($catalog as $item)
                                @if($item->cat === $cat)
                                    <div class="checkbox m-t-0 m-b-15">
                                        <label>
                                            <input type="checkbox" name="service[{{ $item->id }}]" value="{{ $item->id }}">
                                            <i class="input-helper"></i>
                                            {{ $item->name or '' }}
                                        
                                            <div class="pull-right p-r-30">
                                                <input type="text" name="item[{{ $item->id }}]" class="form-control text-right item_{{ $item->id }}" style="opacity:1;width:25px" value="{{ $item->price or '' }}">
                                                {{-- {{ $item->price or '' }}&euro; --}}
                                            </div>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                    </div>
                @endforeach

                {!! Form::close() !!}

            </div>
                        
        </div>
    </div>




@stop

@push('scripts')
    <script src="/assets/vendors/bower_components/chosen/chosen.jquery.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.user-select').chosen({
                width: '100%',
                allow_single_deselect: true
            });

            $(document).on('change', '.checkbox', function() {
                var total = 0;

                $.each($('.form').serializeArray(), function(index, item) {
                    if (item.name.indexOf("service") >= 0) {
                        total = total + parseInt($('.item_'+item.value).val(), 10);
                    }
                });

                $('.cart-total').html(total);
                console.log('total', total);
            });
        });
    </script>
@endpush