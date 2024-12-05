@extends('layouts.app', ['pageTitle' => 'ΝΕΟΣ ΠΕΛΑΤΗΣ'])

@push('backbutton')
    <ul class="hi-menu">
        <li>
            <a href="{{ route('client.index') }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
        </li>
    </ul>
@endpush

@section('content')
<div class="card">
    {{-- <div class="card-header ch-alt">
        <a href="{{ route('client.index') }}" class="card-back-btn">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
        <h2>Νέος Πελάτης</h2>
    </div> --}}

    <div class="card-body card-padding">
        {!! Form::open(['url' => route('client.store'), 'method' => 'POST']) !!}
        @include('client.shared.form')
        {!! Form::close() !!}
    </div>
</div>
@stop

@push('scripts')

@endpush