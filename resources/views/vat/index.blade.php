@extends('layouts.app', ['pageTitle' => 'ΦΠΑ'])

@push('actionbutton')
    <li>
        <a href="{{ route('vat.create', Request::all()) }}"><i class="him-icon zmdi zmdi-plus-circle"></i></a>
    </li>
@endpush

@section('content')
    <div class="card">
        <div class="">
            <ul class="tab-nav" data-tab-color="black">
                @foreach($filter['range'] as $ri)
                    <li{!! $ri['value'] === $filter['date'] ? ' class="active"':'' !!}>
                        <a href="{{ route('vat.index', ['date' => $ri['value']]) }}">{{ $ri['label'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="card-body card-padding">
            <div class="row m-b-15">
                <div class="col-xs-6">
                    <span class="f-700 c-lightgreen">ΤΙΜΟΛΟΓΙΑ &euro; {!! $total->invoice or '0' !!}</span>
                </div>
                <div class="col-xs-6 text-right">
                    <span class="f-700 c-brown">&euro; {!! $total->cashier or '0' !!} ΤΑΜΕΙΑΚΗ</span>
                </div>
            </div>
            <div class="progress progress-sweet">
                <div class="progress-bar bgm-lightgreen" style="width: {!! $total->invoicePercentage !!}%;"></div>
                <div class="progress-bar bgm-brown" style="width: {!! $total->cashierPercentage !!}%;"></div>
            </div>
        </div>

        <div class="card-body card-padding">
            <span class="f-700 c-black">{!! $total->result > 0 ? 'ΧΡΕΟΣ' : 'ΕΞΤΡΑ' !!} &euro; {!! abs($total->result) !!}</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>ΤΑΜΕΙΑΚΗ</th>
                        <th>ΤΙΜΟΛΟΓΙΑ</th>
                        <th>ΑΠΟΤΕΛΕΣΜΑ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vats as $item)
                        <tr data-href="{{ route('vat.edit', ['id' => $item->id, 'date' => Request::input('date')]) }}">
                            <td class="vamiddle">&euro; {{ $item->cashier or '0' }}</td>
                            <td class="vamiddle">&euro; {{ $item->invoice or '0' }}</td>
                            <td class="vamiddle">
                                <strong class="{!! ($item->result > 0) ? 'c-brown':'c-lightgreen' !!}">&euro; {{ abs($item->result) }}</strong>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('change', '[data-filter="range"]', function () {
                $('#range-form').submit();
            });

            $(document).on('click', 'tr[data-href]', function () {
                window.location.href = $(this).data('href');
            });

        });
    </script>
@endpush