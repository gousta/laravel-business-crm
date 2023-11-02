@extends('layouts.app', ['pageTitle' => 'Πρόγραμμα Εργασίας' ])

@push('vendorstyles')

@endpush

@push('styles')
    <style>

        .date-input {
            display:none;
            visibility:hidden;
        }

        .disabled:hover > a {
            background: transparent !important;
        }

        .disabled > a > .him-icon  {
            color: #25ac72;
        }

        .disabled a:hover  {
            cursor: default;
        }

        @media (max-width: 992px) {
            #header .calendar .hi-logo {
                float: none;
            }

            .hi-menu > li.arrow-button  {
                min-width: auto;
                width: 35px;
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
            <li class="hi-logo disabled">
                <a href="javascript:;" class="date-selector">{{$date_week_formatted}}</a>
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
