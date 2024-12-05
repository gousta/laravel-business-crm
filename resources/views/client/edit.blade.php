@extends('layouts.app', ['pageTitle' => 'ΕΠΕΞΕΡΓΑΣΙΑ ΠΕΛΑΤΗ'])

@push('backbutton')
    <ul class="hi-menu">
        <li>
            <a href="{{ route('client.show', $client->id) }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
        </li>
    </ul>
@endpush

@section('content')
<div class="card">
    <div class="card-body card-padding">
        {!! Form::open(['url' => route('client.update', $client->id), 'method' => 'PUT']) !!}
        @include('client.shared.form')
        {!! Form::close() !!}
    </div>
</div>
@stop

@push('scripts')

@endpush