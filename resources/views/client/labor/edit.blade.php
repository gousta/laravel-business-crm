@extends('layouts.app', ['pageTitle' => 'Επεξεργασία Εργασίας'])

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
        <div class="card-body card-padding">
            {!! Form::open(['url' => route('client.labor.update', ['id' => $client->id, 'lid' => $labor->id]), 'method' => 'POST']) !!}
                @include('client.labor.shared.form')
            {!! Form::close() !!}
        </div>
    </div>
@stop

@push('scripts')

@endpush