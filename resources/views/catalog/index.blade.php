@extends('layouts.app', ['pageTitle' => 'Κατάλογος'])

@push('actionbutton')
    <li>
        <a href="{{ route('catalog.create') }}"><i class="him-icon zmdi zmdi-plus-circle"></i></a>
    </li>
@endpush

@section('content')
    <div class="card">
        <div>
            <ul class="tab-nav">
                <li class="active">
                    <a href="#" class="a-prevent filter-by-category" data-category="">ΟΛΑ</a>
                </li>
            @foreach($catalog->groupBy('cat') as $category => $items)
                <li>
                    <a href="#" class="a-prevent filter-by-category" data-category="{{ $category }}">{{ $category }}</a>
                </li>
            @endforeach
            </ul>
        </div>

        <div class="table-responsive">
            <table id="data-table-basic" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>ΚΩΔ.</th>
                        <th>ΟΝΟΜΑ</th>
                        <th>TIMH</th>
                        <th>ΚΑΤΗΓΟΡΙΑ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($catalog as $item)
                        <tr data-href="{{ route('catalog.edit', $item->id) }}">
                            <td class="vamiddle">{{ $item->id or '' }}</td>
                            <td class="vamiddle">{{ $item->name or '' }}</td>
                            <td class="vamiddle">&euro; {{ $item->price or '' }}</td>
                            <td class="vamiddle">{{ $item->cat or '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('click', 'tr[data-href]', function(e) {
                window.location.href = $(this).data('href');
            });

            $(document).on('click', '.filter-by-category', function(e) {
                $('.tab-nav li').removeClass('active');
                $(this).parent().addClass('active');

                $('input[type="search"]').val($(this).data('category')).trigger('input');
            })

        });
    </script>
@endpush