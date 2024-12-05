@extends('layouts.app', ['pageTitle' => 'ΡΑΝΤΕΒΟΥ'])

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
            display: none;
            visibility: hidden;
        }

        @media (max-width: 992px) {
            #main {
                padding-top: 110px;
            }

            #header .calendar .hi-logo {
                float: none;
            }

            .date-selector {
                display: none !important;
            }

            .date-selector-short {
                display: block !important;
            }

            .hi-menu>li.arrow-button {
                min-width: auto;
                width: 35px;
            }

            #header .hi-logo a.date-selector {
                font-size: 16px;
            }

            #header .calendar {
                padding-top: 46px;
            }

            #header .calendar .hi-menu .hi-logo {
                width: calc(100vw - 90px);
                /* 90px = 2x 45px (arrow buttons) */
            }
        }
    </style>


    <style>
        .table-wrap {
            position: relative;
            margin-bottom: 20px;
        }

        .table {
            border: 0;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .table thead {
            position: sticky;
            inset-block-start: 56px;
            z-index: 1;
        }

        .table thead tr th,
        .table tbody tr td {
            border: 0;
            padding: 0 8px !important;
            height: 30px;
            line-height: 30px;
        }

        .table thead tr th {
            font-weight: 900;
        }

        .table tbody tr td {
            cursor: pointer;
        }

        .table tbody tr td.selected {
            background: pink;
        }
    </style>
@endpush

@push('headercenter')
    <li class="calendar">
        <ul class="hi-menu">
            <li class="arrow-button">
                <a href="{{ $date_prev_link }}"><i class="him-icon zmdi zmdi-arrow-left"></i></a>
            </li>
            <li class="date-selector-wrapper hi-logo">
                <a href="#" class="date-selector">{{$date_formatted}}</a>
                <a href="#" class="date-selector-short">{{$date_formatted_short}}</a>
                <input class="date-input" />
            </li>
            <li class="arrow-button">
                <a href="{{ $date_next_link }}"><i class="him-icon zmdi zmdi-arrow-right"></i></a>
            </li>
        </ul>
    </li>
@endpush

@section('content')

<div id="root">
    Loading...
    <noscript>JavaScript is required.</noscript>
</div>
<script>
    window.appointmentProps = {
        hours: {!! json_encode($hours) !!},
        users: {!! json_encode($users) !!},
        date: {!! json_encode($date) !!},
    };
</script>
<script type="module" src="/appointments-next-gen/index.js"></script>
@stop

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/gr.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            var calendar = $('.date-input').flatpickr({
                locale: 'gr',
                positionElement: $('.date-selector-wrapper')[0],
                clickOpens: false,
                enableTime: false,
                disableMobile: true,
                position: 'auto center',
                nextArrow: '<i class="zmdi zmdi-arrow-right" />',
                prevArrow: '<i class="zmdi zmdi-arrow-left" />',
                onChange: (datetime, date) => {
                    window.location.href = "{{ route('appointmentNextGen.index', ['date' => '_date']) }}".replace('_date', date);
                }
            });

            $(document).on('click', '.date-selector-wrapper', function (e) {
                e.preventDefault();
                calendar.open();
            });
        });
    </script>
@endpush