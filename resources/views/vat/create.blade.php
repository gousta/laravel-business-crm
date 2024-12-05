@extends('layouts.app', ['pageTitle' => 'ΝΕΟ ΦΠΑ'])

@push('backbutton')
    <ul class="hi-menu">
        <li>
            <a href="{{ route('vat.index') }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
        </li>
    </ul>
@endpush

@section('content')
<div class="card">

    <div class="card-body card-padding">
        {!! Form::open(['url' => route('vat.store'), 'method' => 'POST']) !!}
        @include('vat.shared.form')
        {!! Form::close() !!}
    </div>
</div>
@stop

@push('scripts')

@endpush