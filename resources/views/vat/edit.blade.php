@extends('layouts.app', ['pageTitle' => 'Επεξεργασία ΦΠΑ'])

@push('backbutton')
    <li>
        <ul class="hi-menu">
            <li>
                <a href="{{ route('vat.index') }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
            </li>
        </ul>
    </li>
@endpush

@section('content')
    <div class="card">

        <div class="card-body card-padding">
            {!! Form::open(['url' => route('vat.update', $vat->id), 'method' => 'PUT']) !!}
                @include('vat.shared.form')
            {!! Form::close() !!}
        </div>
    </div>
@stop

@push('scripts')

@endpush