@extends('layouts.app', ['pageTitle' => 'Ραντεβού' ])

@push('headercenter')
    <li>
        <ul class="hi-menu">
            <li>
                <a href="{{ $date_prev_link }}" class="action-create"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
            </li>
            <li class="hi-logo">
                <a href="#">{{$date_formatted}}</a>
            </li>
            <li>
                <a href="{{ $date_next_link }}" class="action-create"><i class="him-icon zmdi zmdi-arrow-right"></i></a>
            </li>
        </ul>
    </li>
@endpush

@push('actionbutton')
@endpush

@section('content')
    <!-- @include('appointment.shared.table') -->
    <!-- @include('appointment.shared.slot') -->
    @include('appointment.shared.table-interactive')
@stop

@push('scripts')

@endpush
