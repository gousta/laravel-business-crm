@push('styles')
    <style>
        .flex { display: flex; flex-wrap: wrap; gap: 5px; }
        .flex .btn { flex-grow: 1; margin: 0; padding: 0px 5px; height: 32px }

        .calendar {
            /* margin-top: 50px; */
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }

        .calendar .day {
            width: 100%;
        }

        .calendar .card.card-active {
            box-shadow: 0px 0px 0px 2px #25ac72;
        }

        .calendar .card .card-header {
            font-weight: 900;
            line-height: 15px;
            border-bottom: 1px solid #eee;
        }

        @media(max-width: 768px) {
            .calendar {
                flex-wrap: wrap;
            }
        }
    </style>
@endpush

<div class="calendar">

    @foreach ($week as $row)
    <div class="day">
        <div class="card {{ $row['date'] === $today ? 'card-active':'' }}">
            <div class="card-header">
                <div class="m-b-5">{{ $row['formatted_day'] }}</div>
                <div>{{ $row['formatted_date'] }}</div>
            </div>
            <div class="card-body card-padding">
                @foreach ($users as $user)
                    <div class="">
                        <div class="checkbox m-t-15 m-b-0" id="{{$user->id}}|{{$row['date']}}">
                            <label>
                                <input type="checkbox" data-user-id="{{ $user->id }}" data-date="{{ $row['date'] }}" name="{{ implode([$user->id,$row['date']],'|') }}" {{ isset($schedule_exclusions[implode([$user->id,$row['date']],'|')]) ? '':'checked' }} />
                                <i class="input-helper"></i>
                                {{ $user->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr class="m-t-0 m-b-0" />
            <div class="card-body card-padding">
                <div class="flex">
                    <button class="btn btn-xs disable-all">ΚΛΕΙΣΤΑ</button>
                    <button class="btn btn-xs enable-all">ΑΝΟΙΧΤΑ</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.disable-all', function(e) {
                e.preventDefault();
                $(this).closest('.day').find('input[type="checkbox"]').prop('checked', false);
                save();
            });
            $(document).on('click', '.enable-all', function(e) {
                e.preventDefault();
                $(this).closest('.day').find('input[type="checkbox"]').prop('checked', true);
                save();
            });

            $(document).on('change', 'input[type="checkbox"]', function(e) {
                e.preventDefault();
                save();
            });

            function save() {
                const checkboxes = $(document).find('input[type="checkbox"]');
                const rows = [];
                $.each(checkboxes, function() {
                    rows.push({
                        ...$(this).data(),
                        checked: $(this).prop('checked')
                    });
                });

                const url = "{{ route('async.scheduleExclusion.any.update') }}";
                $.ajax({ method: "PUT", url, data: { rows } }).done(function() {
                    notify('Αποθηκεύτηκε', 'inverse');
                });
            }
        });
    </script>
@endpush
