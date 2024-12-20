@extends('layouts.app', ['pageTitle' => 'ΠΕΛΑΤΕΣ (' . count($clients) . ')'])

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

                    @if(config('crm.mode') === 'mechanic')
                        <th data-orderable="false">ΜΑΡΚΑ-ΜΟΝΤΕΛΟ</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr data-href="{{ route('client.show', $client->id) }}">
                        <td class="vamiddle"><strong>{{ $client->name or '' }}</strong></td>
                        <td class="vamiddle"><strong>{{ $client->surname or '' }}</strong></td>
                        <td class="vamiddle">{{ $client->email or '' }}</td>
                        <td class="vamiddle">{{ $client->phone or '' }}</td>

                        @if(config('crm.mode') === 'mechanic')
                            <td class="vamiddle">{{ $client->vehicle->brand or '' }}{!! $client->vehicle->model ? ' – ' . $client->vehicle->model : '' !!}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $(document).on('click', 'tr[data-href]', function () {
                window.location = $(this).data('href');
            });

        });
    </script>
@endpush
