@extends('layouts.app', ['pageTitle' => 'Πελάτες ('.count($clients).')'])

@push('actionbutton')
  <li>
    <a href="{{ route('labor.index') }}"><i class="him-icon zmdi zmdi-assignment"></i></a>
  </li>
  <li>
    <a href="{{ route('client.create') }}"><i class="him-icon zmdi zmdi-account-add"></i></a>
  </li>
@endpush

@section('content')
  <div class="card">

    <div class="table-responsive">
      <table id="data-table-basic" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th>ΟΝΟΜΑ</th>
            <th>ΕΠΩΝΥΜΟ</th>
            <th data-orderable="false">EMAIL</th>
            <th data-orderable="false">ΤΗΛΕΦΩΝΟ</th>
          </tr>
        </thead>
        <tbody>
          @foreach($clients as $client)
            <tr data-href="{{ route('client.show', $client->id) }}">
              <td class="vamiddle"><strong>{{ $client->name or '' }}</strong></td>
              <td class="vamiddle"><strong>{{ $client->surname or '' }}</strong></td>
              <td class="vamiddle">{{ $client->email or '' }}</td>
              <td class="vamiddle">{{ $client->phone or '' }}</td>
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

      $(document).on('click', 'tr[data-href]', function () {
        window.location.href = $(this).data('href');
      });

    });
  </script>
@endpush