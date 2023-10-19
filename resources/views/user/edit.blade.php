@extends('layouts.app', ['pageTitle' => 'Επεξεργασία χρήστη'])

@push('backbutton')
    <li>
        <ul class="hi-menu">
            <li>
                <a href="{{ route('user.index') }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
            </li>
        </ul>
    </li>
@endpush

@section('content')
    <div class="card">

        <div class="card-body card-padding">
            {!! Form::open(['url' => route('user.update', $user->id), 'method' => 'PUT']) !!}
                @include('user.shared.form')
            {!! Form::close() !!}
        </div>
    </div>
@stop

@push('scripts')

@endpush
