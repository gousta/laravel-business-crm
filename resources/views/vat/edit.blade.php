@extends('layouts.app', ['pageTitle' => 'Επεξεργασία ΦΠΑ'])

@push('backbutton')
    <li>
        <ul class="hi-menu">
            <li>
                <a href="{{ route('vat.index', Request::only('date')) }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
            </li>
        </ul>
    </li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body card-padding">
            @include('vat.shared.form')
        </div>
    </div>
@stop

@push('scripts')

@endpush