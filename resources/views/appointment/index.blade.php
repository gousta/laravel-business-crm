@extends('layouts.app', ['pageTitle' => 'Ραντεβού' ])

@push('vendorstyles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('styles')
    <style>
        .date-selector {
            display: block !important;
        }

        .date-selector-short {
            display: none !important;
        }

        .date-input {
            display:none;
            visibility:hidden;
        }

        @media (max-width: 992px) {
            #header .calendar .hi-logo {
                float: none;
            }

            .date-selector {
                display: none !important;
            }

            .date-selector-short {
                display: block !important;
            }

            .hi-menu > li.arrow-button  {
                min-width: auto;
                width: 35px;
            }

            #header .hi-logo a.date-selector {
                font-size: 16px;
            }
        }
    </style>
@endpush

@push('headercenter')
    <li class="calendar">
        <ul class="hi-menu">
            <li class="arrow-button">
                <a href="{{ $date_prev_link }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
            </li>
            <li class="hi-logo">
                <a href="#" class="date-selector">{{$date_formatted}}</a>
                <a href="#" class="date-selector-short">{{$date_formatted_short}}</a>
                <input class="date-input"/>
            </li>
            <li class="arrow-button">
                <a href="{{ $date_next_link }}"><i class="him-icon zmdi zmdi-arrow-right"></i></a>
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
    <script src="https://npmcdn.com/flatpickr/dist/l10n/gr.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            var calendar = $('.date-input').flatpickr({
                locale: 'gr',
                positionElement: $('.date-selector')[0],
                clickOpens: false,
                enableTime: false,
                disableMobile: true,
                nextArrow: '<i class="zmdi zmdi-arrow-right" />',
                prevArrow: '<i class="zmdi zmdi-arrow-left" />',
                onChange: (datetime, date) => {
                    window.location.href = "{{ route('appointment.index', ['date'=>'_date']) }}".replace('_date', date);
                }
            });

            $(document).on('click', '.date-selector', function (e) {
                e.preventDefault();
                calendar.open();
            });

            $(document).on('click', '.date-selector-short', function (e) {
                e.preventDefault();
                calendar.open();
            });
        });
    </script>
@endpush
