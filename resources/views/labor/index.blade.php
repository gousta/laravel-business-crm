@extends('layouts.app', ['pageTitle' => 'ΕΡΓΑΣΙΕΣ ΓΙΑ ' . \Carbon\Carbon::parse(\Request::get('date'))->formatLocalized(config('crm.date_format'))])

@push('backbutton')
    <ul class="hi-menu">
        <li>
            <a href="{{ url()->previous() }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
        </li>
    </ul>
@endpush

@push('actionbutton')
    {{-- <li>
        <a href="{{ route('client.create') }}"><i class="him-icon zmdi zmdi-account-add"></i></a>
    </li> --}}
@endpush

@section('content')

<div class="card">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ΥΠΗΡΕΣΙΑ</th>
                    <th>ΠΕΛΑΤΗΣ</th>
                    <th>ΤΙΜΗ</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $labor)
                    <tr>
                        <td>{{ $labor->item->name or '' }}</td>
                        <td><a href="{{ route('client.show', $labor->client->id) }}">{{ $labor->client->name or '' }} {{ $labor->client->surname or '' }}</a></td>
                        <td>&euro;{{ $labor->price or '' }}</td>
                        <td>{{ $labor->time or '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@push('scripts')

@endpush