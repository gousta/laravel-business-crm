@extends('layouts.app', ['pageTitle' => 'ΦΠΑ'])

@push('actionbutton')
    <li>
        <a href="{{ route('vat.create') }}"><i class="him-icon zmdi zmdi-plus-circle"></i></a>
    </li>
@endpush

@section('content')
    <div class="card">
        <div class="row">
            <div class="col-xs-6">
                <div class="card-header">
                    <h2>ΦΠΑ</h2>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="card-filter">
                    <div class="select">
                        <form id="range-form">
                            <select name="month" data-filter="range" class="form-control">
                                @foreach($filter['range'] as $ri)
                                    <option value="{{ $ri['value'] }}" {{ $ri['value'] === $filter['monthValue'] ? 'selected':''}}>
                                        {{ $ri['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th width="10%">ΗΜΕΡΟΜΗΝΙΑ</th>
                        <th>ΤΑΜΕΙΑΚΗ</th>
                        <th>ΤΙΜΟΛΟΓΙΑ</th>
                        <th>ΑΠΟΤΕΛΕΣΜΑ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vats as $item)
                        <tr data-href="{{ route('vat.edit', $item->id) }}">
                            <td class="vamiddle">{{ $item->created_at }}</td>
                            <td class="vamiddle">&euro; {{ $item->cashier or '' }}</td>
                            <td class="vamiddle">&euro; {{ $item->invoice or '' }}</td>
                            <td class="vamiddle">
                                @if($item->result > 0)
                                    <strong class="c-red">&euro; {{ $item->result or '' }}</strong>
                                @else
                                    <strong class="c-green">&euro; {{ $item->result or '' }}</strong>
                                @endif
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