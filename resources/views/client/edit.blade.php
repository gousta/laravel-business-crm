@extends('layouts.app', ['pageTitle' => 'Επεξεργασία'])

@push('backbutton')
    <li>
        <ul class="hi-menu">
            <li>
                <a href="{{ route('client.show', $client->id) }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
            </li>
        </ul>
    </li>
@endpush

@section('content')
    <div class="card">
        {{-- <div class="card-header ch-alt">
            <a href="{{ route('client.show', $client->id) }}" class="card-back-btn">
                <i class="zmdi zmdi-arrow-left"></i>
            </a>
            <h2>Επεξεργασία Πελάτη</h2>
        </div> --}}

        <div class="card-body card-padding">
            {!! Form::open(['url' => route('client.update', $client->id), 'method' => 'PUT']) !!}
                @include('client.shared.form')
            {!! Form::close() !!}
        </div>
    </div>
@stop

@push('scripts')

@endpush