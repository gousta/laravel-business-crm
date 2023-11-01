@extends('layouts.app', ['pageTitle' => 'Πρόγραμμα Εργασίας' ])

@push('vendorstyles')

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

        .hi-menu > li.arrow-button.disabled:hover > a {
            background: transparent;
        }

        .hi-menu > li.arrow-button.disabled > a > .him-icon  {
            color: #25ac72;
        }

        .hi-menu > li.arrow-button.disabled a:hover  {
            cursor: default;
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

            <li class="arrow-button {{$date_prev_link ? '':'disabled'}}">
                <a href="{{$date_prev_link ? $date_prev_link:'javascript:;'}}" {{$date_prev_link ? '':'disabled'}}><i class="him-icon zmdi zmdi-arrow-left"></i></a>
            </li>
            <li class="hi-logo">
                <a href="#" class="date-selector">{{$date_week_formatted}}</a>
            </li>
            <li class="arrow-button">
                <a href="{{ $date_next_link }}"><i class="him-icon zmdi zmdi-arrow-right"></i></a>
            </li>
        </ul>
    </li>
@endpush


@section('content')
    {{--@include('schedule.shared.month-graph')--}}
    @include('schedule.shared.calendar')
@stop

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            //
        });
    </script>
@endpush
