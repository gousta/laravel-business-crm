@extends('layouts.app', ['pageTitle' => 'Επεξεργασία αντικειμένου'])

@push('backbutton')
    <li>
        <ul class="hi-menu">
            <li>
                <a href="{{ route('catalog.index') }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
            </li>
        </ul>
    </li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body card-padding">
            {!! Form::open(['url' => route('catalog.update', $item->id), 'method' => 'PUT']) !!}
                @include('catalog.shared.form')
            {!! Form::close() !!}
        </div>
    </div>
@stop

@push('scripts')

@endpush