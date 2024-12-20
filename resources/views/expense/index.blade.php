@extends('layouts.app', ['pageTitle' => 'ΕΞΟΔΑ'])

@push('actionbutton')
    <li>
        <a href="{{ route('expense.create') }}"><i class="him-icon zmdi zmdi-plus-circle"></i></a>
    </li>
@endpush

@section('content')
<div class="card">
    <div>
        <ul class="tab-nav" data-tab-color="black">
            @foreach($years as $year)
                <li class="{{ $year == $selectedYear ? 'active' : '' }}">
                    <a href="#" class="a-prevent filter-by-year" data-year="{{ $year }}">{{ $year }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th width="10%">ΗΜΕΡΟΜΗΝΙΑ</th>
                    <th>ΠΟΣΟ</th>
                    <th>ΠΕΡΙΓΡΑΦΗ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $item)
                    <tr data-href="{{ route('expense.edit', $item->id) }}">
                        <td class="vamiddle">{{ $item->created_at }}</td>
                        <td class="vamiddle">&euro; {{ $item->amount or '' }}</td>
                        <td class="vamiddle">{{ $item->description or '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $(document).on('click', 'tr[data-href]', function () {
                window.location.href = $(this).data('href');
            });

            $(document).on('click', '.filter-by-year', function (e) {
                var year = $(this).data('year');
                window.location = "{{ route('expense.index') }}" + '?year=' + year;
            })

        });
    </script>
@endpush