@push('styles')
    <style>
        .table {
            table-layout: fixed;
        }

        .table .slot {
            display: block;
            padding: 5px 10px;
            border-radius: 2px;
            height: 100%;
            color: transparent;
        }

        .table .slot:focus {
            color: transparent;
            background: transparent;
        }

        .table .slot:hover {
            color: #333;
            background: white;
        }

        @media (max-width: 768px) {
            .table {
                table-layout: auto;
            }
        }
    </style>
@endpush

<div class="table-responsive">
    <table class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th width="100" style="background: none">&nbsp;</th>
                @foreach($users as $user)
                <th>{{ $user->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($hours as $hour)
            <tr>
                <td style="padding:5px 10px">{{ $hour }}</td>
                @foreach($users as $user)
                <td style="padding:0">
                    <a
                        href="#"
                        data-appointment-date="{{ $date }}"
                        data-appointment-start-hour="{{ $hour }}"
                        data-appointment-user-id="{{ $user->id }}"
                        data-appointment-title="Νέο ραντεβού για {{$date_formatted}} με {{ $user->name }}"
                        class="slot">Στις {{ $hour }} με {{ $user->name }}</a>
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
