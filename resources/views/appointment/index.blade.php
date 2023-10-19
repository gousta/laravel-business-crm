@extends('layouts.app', ['pageTitle' => 'Ραντεβού' ])

@push('actionbutton')
    <li class="hi-logo">
        <a>{{$date_formatted}}</a>
    </li>
    <li>
        <a href="{{ $date_prev_link }}" class="action-create"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
    </li>
    <li>
        <a href="{{ $date_next_link }}" class="action-create"><i class="him-icon zmdi zmdi-arrow-right"></i></a>
    </li>
@endpush

@section('content')
    @include('appointment.shared.table-interactive')
    <!-- @include('appointment.shared.slot') -->
@stop

@push('scripts')

@endpush