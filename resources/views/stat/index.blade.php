@extends('layouts.app', ['pageTitle' => 'Σύνοψη'])

@push('actionbutton')
    {{-- <li>
    <a href="{{ route('client.create') }}"><i class="him-icon zmdi zmdi-account-add"></i></a>
  </li> --}}
@endpush

@push('centertext')
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h2>Η εβδομάδα</h2>
                </div>

                <div class="card-body m-t-0">
                    <table class="table table-inner table-vmiddle table-condensed">
                        <tbody>
                            @foreach ($frame['week'] as $date)
                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('d/m') }}
                                        &nbsp;
                                        {{ \Carbon\Carbon::createFromFormat('d/m/Y', $date)->formatLocalized('%A') }}
                                    </td>

                                    <td class="text-right">
                                        @if (isset($data['this_week'][$date], $data['this_week'][$date][0]))
                                            <i class="zmdi zmdi-male-alt"></i>
                                            {{ $data['this_week'][$date][0]->clients or '' }}
                                            &nbsp;
                                            <span
                                                class="f-500 c-crm p-r-10">&euro;{{ $data['this_week'][$date][0]->sum or '' }}</span>

                                            <a class="c-crm" href="{{ route('labor.index', ['date' => \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d')]) }}">
                                                <i class="zmdi zmdi-assignment"></i>
                                            </a>
                                        @else
                                            <span class="c-gray f-s-13">ΚΛΕΙΣΤΑ</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Ημερήσιος μέσος όρος πελατών/τζίρου</h2>
                </div>
                <div class="card-body card-padding p-b-0">
                    <div class="visitors-stats-item p-l-10 p-r-10 m-b-10">
                        <strong class="c-gray p-r-10">ΤΕΛΕΥΤΑΙΑ 3 ΧΡΟΝΙΑ</strong>
                        <span class="pull-right">
                            @if (isset($data['all'], $data['all']['average_customers_per_day'], $data['all']['average_per_day']))
                                <strong><i class="zmdi zmdi-male-alt"></i>
                                    {{ $data['all']['average_customers_per_day'] }}</strong>
                                <strong class="p-l-10 f-500 c-crm">&euro;{{ number_format($data['all']['average_per_day'], 0, ',', '.') }}</strong>
                            @endif
                        </span>
                    </div>
                    @foreach ($data['all']['average_per_day_yearly'] as $year => $yearAveragePerDay)
                        <div class="visitors-stats-item p-l-10 p-r-10 m-b-10">
                            <strong class="c-gray p-r-10">{{ $year }}</strong>
                            <span class="pull-right">
                                <strong><i class="zmdi zmdi-male-alt"></i> {{ $yearAveragePerDay['customers'] }}</strong>
                                <strong class="p-l-10 f-500 c-crm">&euro;{{ $yearAveragePerDay['amount'] or '' }}</strong>
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="card-header">
                    <h2>Μέσος όρος τζίρου ανά ημέρα της εβδομάδας</h2>
                </div>
                <table class="table table-inner table-vmiddle table-condensed">
                    <tbody>
                        @foreach ($data['all']['average_per_dayofweek'] as $row)
                            <tr>
                                <td>{{ ucfirst($row->week_day) }}</td>

                                <td class="text-right">
                                    <span
                                        class="f-500 c-crm">&euro;{{ number_format($row->sum / $row->days, 0, ',', '.') }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="card-header">
                    <h2>Ρεκόρ</h2>
                </div>
                <div class="card-body card-padding">
                    @foreach ($data['best_days'] as $best)
                        <div class="visitors-stats-item p-l-10 p-r-10 m-b-10">
                            <strong><i class="zmdi zmdi-calendar"></i> {{ $best->date or '' }}</strong>
                            <strong class="pull-right">&euro;{{ $best->sum or '' }}</strong>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h2>Συνολικά έξοδα ανά εγγραφή</h2>
                </div>
                <table class="table table-inner table-vmiddle table-condensed">
                    <tbody>
                        @foreach ($data['expenses_analysis'] as $row)
                            <tr>
                                <td>{{ ucfirst($row['reason']) }}</td>

                                <td class="text-right">
                                    <span class="f-500 c-red">&euro;{{ number_format($row['amount'], 0, ',', '.') }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h2>Σύνολα ανά έτος</h2>
                </div>

                <div class="card-body m-t-0">
                    <table class="table table-inner table-vmiddle table-condensed">
                        <tbody>
                            @foreach ($data['sum_per_year'] as $year)
                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::parse($year->txn_date)->format('Y') }}
                                    </td>

                                    <td class="text-right">
                                        <i class="zmdi zmdi-male-alt"></i> {{ $year->clients or '' }}
                                        &nbsp;
                                        <span
                                            class="f-500 c-crm">&euro;{{ number_format($year->sum, 0, ',', '.') }}</span>

                                        @if (isset($data['expense_per_year'][$year->txn_date]))
                                            -
                                            <span
                                                class="f-500 c-red">&euro;{{ number_format($data['expense_per_year'][$year->txn_date]->sum, 0, ',', '.') }}</span>
                                            /
                                            <span
                                                class="f-500 c-green">&euro;{{ number_format($year->sum - $data['expense_per_year'][$year->txn_date]->sum, 0, ',', '.') }}</span>
                                        @else
                                            -
                                            <span class="f-500 c-red">&euro;0</span>
                                            /
                                            <span
                                                class="f-500 c-green">&euro;{{ number_format($year->sum, 0, ',', '.') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <canvas id="sum_per_year" height="120"></canvas>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Σύνολα ανα μήνα</h2>
                </div>

                <div class="card-body m-t-0">
                    <table class="table table-inner table-vmiddle table-condensed">
                        <tbody>
                            @foreach ($data['sum_per_month'] as $month)
                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::parse($month->txn_date)->formatLocalized('%b') }}
                                        {{ \Carbon\Carbon::parse($month->txn_date)->format('y') }}
                                    </td>

                                    <td class="text-right">
                                        <i class="zmdi zmdi-male-alt"></i> {{ $month->clients or '' }}
                                        &nbsp;
                                        <span
                                            class="f-500 c-crm">&euro;{{ number_format($month->sum, 0, ',', '.') }}</span>

                                        @if (isset($data['expense_per_month'][$month->txn_date]))
                                            <span
                                                class="f-500 c-red">&euro;{{ number_format($data['expense_per_month'][$month->txn_date]->sum, 0, ',', '.') }}</span>
                                            /
                                            <span
                                                class="f-500 c-green">&euro;{{ number_format($month->sum - $data['expense_per_month'][$month->txn_date]->sum, 0, ',', '.') }}</span>
                                        @else
                                            <span class="f-500 c-red">&euro;0</span>
                                            /
                                            <span
                                                class="f-500 c-green">&euro;{{ number_format($month->sum, 0, ',', '.') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <canvas id="sum_per_month" height="120"></canvas>
            </div>
        </div>
    </div>

@stop

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.min.js"></script>
    <script src="/assets/vendors/bower_components/moment/min/moment-with-locales.min.js"></script>

    <script type="text/javascript">
        moment.locale('el');
        var data = {!! json_encode($data) !!}

        data.sum_per_year.reverse()
        data.sum_per_month.reverse()

        new Chart(document.getElementById("sum_per_year"), {
            type: 'line',
            data: {
                labels: data.sum_per_year.map(function(r) {
                    return moment(r.txn_date).format('YYYY')
                }),
                datasets: [{
                    fill: true,
                    label: 'Τζίρος',
                    data: data.sum_per_year.map((r) => r.sum),
                    backgroundColor: data.sum_per_year.map(() => 'rgba(50, 199, 135, 1)'),
                    borderColor: data.sum_per_year.map(() => 'rgba(50, 199, 135, 1)'),
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                }
            }
        });

        new Chart(document.getElementById("sum_per_month"), {
            type: 'line',
            data: {
                labels: data.sum_per_month.map(function(r) {
                    return moment(r.txn_date).format('MMM YY')
                }),
                datasets: [{
                    fill: true,
                    label: 'Τζίρος',
                    data: data.sum_per_month.map(function(r) {
                        return r.sum
                    }),
                    backgroundColor: data.sum_per_year.map(() => 'rgba(50, 199, 135, 1)'),
                    borderColor: data.sum_per_year.map(() => 'rgba(50, 199, 135, 1)'),
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                }
            }
        });
    </script>
@endpush
