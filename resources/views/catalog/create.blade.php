@extends('layouts.app', ['pageTitle' => 'NEO ANTIKEIMENO'])

@push('backbutton')
    <ul class="hi-menu">
        <li>
            <a href="{{ route('catalog.index') }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
        </li>
    </ul>
@endpush

@section('content')
<div class="card">
    <div class="card-body card-padding">
        {!! Form::open(['url' => route('catalog.store'), 'method' => 'POST']) !!}
        @include('catalog.shared.form')
        {!! Form::close() !!}
    </div>
</div>
@stop

@push('scripts')

@endpush