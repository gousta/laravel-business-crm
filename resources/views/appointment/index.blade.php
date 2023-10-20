@extends('layouts.app', ['pageTitle' => 'Ραντεβού' ])

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('headercenter')
    <li>
        <ul class="hi-menu">
            <li>
                <a href="{{ $date_prev_link }}" class="action-create"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
            </li>
            <li class="hi-logo">
                <a href="#" class="date-selector">{{$date_formatted}}</a>
                <input class="date-input" style="display:none" />
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            var calendar = $('.date-input').flatpickr({
                positionElement: $('.date-selector')[0],
                clickOpens: false,
                enableTime: false,
                nextArrow: '<i class="zmdi zmdi-long-arrow-right" />',
                prevArrow: '<i class="zmdi zmdi-long-arrow-left" />',
                onChange: (datetime, date) => {
                    window.location.href = "{{ route('appointment.index', ['date'=>'_date']) }}".replace('_date', date);
                }
            });

            $(document).on('click', '.date-selector', function (e) {
                e.preventDefault();

                calendar.open();
            });
        });
    </script>
@endpush
