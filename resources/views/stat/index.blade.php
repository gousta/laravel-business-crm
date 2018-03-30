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
              @foreach($frame['week'] as $date)
                <tr>
                  <td>
                    {{ \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('d/m') }}
                    &nbsp;
                    {{ \Carbon\Carbon::createFromFormat('d/m/Y', $date)->formatLocalized('%A') }}
                  </td>

                  <td class="text-right">
                    @if(isset($data['this_week'][$date], $data['this_week'][$date][0]))
                      <i class="zmdi zmdi-male-alt"></i> {{ $data['this_week'][$date][0]->clients or '' }}
                      &nbsp;
                      <span class="f-500 c-cyan p-r-10">&euro; {{ $data['this_week'][$date][0]->sum or '' }}</span>

                      <a class="c-pink" href="{{ route('labor.index', ['date' => \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d')]) }}">
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
          <div class="card-header"><h2>Ημερήσιος μέσος όρος πελατών/τζίρου</h2></div>
          <div class="card-body card-padding p-b-0">
            <div class="visitors-stats-item p-l-10 p-r-10 m-b-20">
              <strong><i class="zmdi zmdi-male-alt"></i> {{ $data['all']['average_customers_per_day'] }}</strong>
              <strong class="pull-right f-500 c-cyan">&euro; {{ $data['all']['average_per_day'] }}</strong>
            </div>
          </div>
          <div class="card-header"><h2>Μέσος όρος τζίρου ανά ημέρα της εβδομάδας</h2></div>
          <table class="table table-inner table-vmiddle table-condensed">
            <tbody>
              @foreach($data['all']['average_per_dayofweek'] as $row)
                <tr>
                  <td>{{ ucfirst($row->week_day) }}</td>
  
                  <td class="text-right">
                    <span class="f-500 c-cyan">&euro; {{ number_format($row->sum/$row->days, 0, ',', '.') }}</span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
  
          <div class="card-header"><h2>Ρεκόρ</h2></div>
          <div class="card-body card-padding">
            @foreach($data['best_days'] as $best)
              <div class="visitors-stats-item p-l-10 p-r-10 m-b-10">
                <strong><i class="zmdi zmdi-calendar"></i> {{ $best->date or '' }}</strong>
                <strong class="pull-right">&euro; {{ $best->sum or '' }}</strong>
              </div>
            @endforeach
          </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-4">
      <div class="card">
        <div class="card-header"><h2>Συνολικά έξοδα ανά εγγραφή</h2></div>
        <table class="table table-inner table-vmiddle table-condensed">
          <tbody>
            @foreach($data['expenses_analysis'] as $row)
              <tr>
                <td>{{ ucfirst($row['reason']) }}</td>

                <td class="text-right">
                  <span class="f-500 c-red">&euro; {{ number_format($row['amount'], 0, ',', '.') }}</span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="col-md-12 col-lg-4">
      <div class="card">
        <div class="card-header"><h2>Σύνολα ανά έτος</h2></div>

        <div class="card-body m-t-0">
          <table class="table table-inner table-vmiddle table-condensed">
            <tbody>
              @foreach($data['sum_per_year'] as $year)
                <tr>
                  <td>
                    {{ \Carbon\Carbon::parse($year->txn_date)->format('Y') }}
                  </td>

                  <td class="text-right">
                    <i class="zmdi zmdi-male-alt"></i> {{ $year->clients or '' }}
                    &nbsp;
                    <span class="f-500 c-cyan">&euro; {{ number_format($year->sum, 0, ',', '.') }}</span>

                    @if(isset($data['expense_per_year'][$year->txn_date]))
                      -
                      <span class="f-500 c-red">&euro; {{ number_format($data['expense_per_year'][$year->txn_date]->sum, 0, ',', '.') }}</span>
                      /
                      <span class="f-500 c-green">&euro; {{ number_format($year->sum - $data['expense_per_year'][$year->txn_date]->sum, 0, ',', '.') }}</span>
                    @else
                      -
                      <span class="f-500 c-red">&euro; 0</span>
                      /
                      <span class="f-500 c-green">&euro; {{ number_format($year->sum, 0, ',', '.') }}</span>
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
          <h2>Σύνολα ανα μήνα</h2>
        </div>

        <div class="card-body m-t-0">
          <table class="table table-inner table-vmiddle table-condensed">
            <tbody>
              @foreach($data['sum_per_month'] as $month)
                <tr>
                  <td>
                    {{ \Carbon\Carbon::parse($month->txn_date)->formatLocalized('%b') }}
                    {{ \Carbon\Carbon::parse($month->txn_date)->format('y') }}
                  </td>

                  <td class="text-right">
                    <i class="zmdi zmdi-male-alt"></i> {{ $month->clients or '' }}
                    &nbsp;
                    <span class="f-500 c-cyan">&euro; {{ number_format($month->sum, 0, ',', '.') }}</span>

                    @if(isset($data['expense_per_month'][$month->txn_date]))
                      -
                      <span class="f-500 c-red">&euro; {{ number_format($data['expense_per_month'][$month->txn_date]->sum, 0, ',', '.') }}</span>
                      /
                      <span class="f-500 c-green">&euro; {{ number_format($month->sum - $data['expense_per_month'][$month->txn_date]->sum, 0, ',', '.') }}</span>
                    @else
                      -
                      <span class="f-500 c-red">&euro; 0</span>
                      /
                      <span class="f-500 c-green">&euro; {{ number_format($month->sum, 0, ',', '.') }}</span>
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

  <div class="row">
    <div class="col-md-12 col-lg-4">

      <div class="card">
        <div class="card-header">
          <h2>Σύνολο ανά κατηγορία</h2>
        </div>
        <div class="card-body m-t-0">
          <table class="table table-inner table-vmiddle table-condensed">
            <tbody>
              @foreach($data['monthly_gross_revenue_by_category'] as $row)
                <tr>
                  <td>{{ $row->cat or '' }}</td>
                  <td class="f-500 c-cyan text-right">&euro; {{ $row->sum or '' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h2>Διάσημες υπηρεσίες</h2>
        </div>
        <div class="card-body m-t-0">
          <table class="table table-inner table-vmiddle table-condensed">
            <tbody>
              @foreach($data['most_used_labor'] as $labor)
                <tr>
                  <td>{{ $labor->item->name or '' }}</td>
                  <td class="text-right">
                    <span class="f-300 c-black p-r-10"><i class="zmdi zmdi-play"></i> {{ $labor->count or '' }}</span>
                    <span class="f-500 c-cyan">&euro; {{ $labor->sum or '' }}</span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <div class="col-md-12 col-lg-4">
      <div class="card">
        <div class="card-header">
          <h2>Top Γυναίκες</h2>
        </div>

        <div class="card-body m-t-0">
          <table class="table table-inner table-vmiddle table-condensed">
            <tbody>
              @foreach($data['best_clients_female'] as $woman)
                <tr>
                  <td>{{ $woman->client->name or '' }} {{ $woman->client->surname or '' }}</td>
                  <td class="f-500 c-cyan text-right">&euro; {{ $woman->sum or '' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-lg-4">
      <div class="card">
        <div class="card-header">
          <h2>Top Άνδρες</h2>
        </div>

        <div class="card-body m-t-0">
          <table class="table table-inner table-vmiddle table-condensed">
            <tbody>
              @foreach($data['best_clients_male'] as $man)
                <tr>
                  <td>{{ $man->client->name or '' }} {{ $man->client->surname or '' }}</td>
                  <td class="f-500 c-cyan text-right">&euro; {{ $man->sum or '' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-lg-4"></div>

  </div>

@stop

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.min.js"></script>
  <script src="/assets/vendors/bower_components/moment/min/moment-with-locales.min.js"></script>
  
  <script type="text/javascript">
    moment.locale('el');
    var data = {!! json_encode($data) !!}

    data.sum_per_month.reverse()

    new Chart(document.getElementById("sum_per_month"), {
      type: 'line',
      data: {
        labels: data.sum_per_month.map(function(r) { return moment(r.txn_date).format('MMM YY') }),
        datasets: [
          {
            fill: true,
            label: 'Τζίρος',
            data: data.sum_per_month.map(function(r) { return r.sum }),
          }
        ]
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