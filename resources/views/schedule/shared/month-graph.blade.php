
@push('styles')
    <style>
        .month-graph {
            margin-bottom: 40px;
        }

        @media(max-width: 768px) {
            .month-graph {
                display: none;
            }
        }

        .month-box {
            height: 50px;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }

        .month-week-box {
            background: #eee;
            height: calc(50% - 4px);
            width: calc(50% - 4px);
            margin: 2px;
        }

        .month-week-box.active {
            background: #ddd;
        }
    </style>
@endpush

<div class="month-graph">
    <div class="row">
        @foreach($month_graph as $month)
        <div class="col-sm-1">
            <div>{{ $month->formatLocalized('%Y') }}</div>
            <div>{{ $month->formatLocalized('%B') }}</div>
            <div class="month-box">
                <div class="month-week-box"></div>
                <div class="month-week-box active"></div>
                <div class="month-week-box"></div>
                <div class="month-week-box"></div>
            </div>
        </div>
        @endforeach
    </div>
</div>
