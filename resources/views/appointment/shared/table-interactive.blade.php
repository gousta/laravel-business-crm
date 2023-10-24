@push('styles')
    <style>
        .table {
            table-layout: fixed;
            position: relative;
            border-collapse: collapse;
        }

        .table thead tr th {
            background: #f3f3f3;
            font-weight: 800;
            position: sticky;
            top: 56px; /** required for `sticky` to work */
            z-index: 1;
        }

        .table thead tr th:first-child {
            background: none;
            width: 65px;
        }

        .table tbody tr td {
            padding: 0 !important;
            height: 32px;
        }

        .table tbody tr td:first-child {
            padding: 5px 0 !important;
        }

        .table-bordered {
            border: 10px solid #f3f3f3;
            border-top: 1px solid #f3f3f3;
            border-bottom: 1px solid #f3f3f3;
        }
        .table-bordered > tbody > tr > td,
        .table-bordered > thead > tr > th {
            border: 10px solid #f3f3f3;
            border-top: 1px solid #ddd;
            border-bottom: none;
        }
        .table-bordered > tbody > tr > td:first-child {
            border-top: 1px solid #f5f5f5;
        }

        .slot-input {
            display: block;
            width: 100%;
            height: 32px;
            border: 0px solid transparent;
            box-shadow: none;
            padding-left: 10px;
            padding-right: 10px;
        }

        .slot-input:focus {
            padding-right: 60px;
        }

        .slot-input::placeholder {
            color: #ccc;
        }

        .slot-wrapper {
            position: relative;
        }
        .slot-tooltip {
            visibility: hidden;
            display: block;
            overflow: hidden;
            box-sizing: border-box;
            padding: 2px 7px;
            background: #333;
            color: #fff;
            font-weight: 600;
            font-size: 12px;
            border-radius: 50px;
            position: absolute;
            top: 6px;
            right: 5px;
        }

        :focus + .slot-tooltip {
            margin-bottom: 0;
            height: auto;
            visibility: visible;
        }

        @media (max-width: 768px) {
            .table {
                table-layout: auto;
            }

            .table thead tr th:not(:first-child) {
                min-width: 300px;
            }
        }
    </style>
@endpush

<table class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th>&nbsp;</th>
            @foreach($users as $user)
            <th>{{ $user->name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($hours as $hour)
        <tr>
            <td>{{ $hour }}</td>
            @foreach($users as $user)
            <td class="slot-wrapper" id="{{ str_replace(':', '', $user->id.$date.$hour) }}">
                <input type="text" class="slot-input" data-user-id="{{$user->id}}" data-date="{{$date}}" data-hour="{{$hour}}" />
                <div class="slot-tooltip">{{$hour}}</div>
            </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>

@push('scripts')
    <script type="text/javascript">
        var appointmentMap = {};

        function getSlotId(userId, date, hour) {
            return [userId, date, hour].join('').replace(':', '');
        }

        async function loadAppointments() {
            const url = "{{ route('async.appointment.index', ['date' => $date]) }}";

            $.ajax({ method: "GET", url }).done(function({ appointments }) {
                for (const appointment of appointments) {
                    const slotId = getSlotId(appointment.user_id, appointment.date, appointment.hour);

                    $(`#${slotId} > .slot-input`).val(appointment.description);
                    appointmentMap[slotId] = appointment.description;
                }
            });
        }

        async function saveAppointment(user_id, description, date, hour) {
            $(`.slot-input`).attr('disabled', true);
            const url = "{{ route('async.appointment.any.update') }}";
            const data = { user_id, description, date, hour };
            $.ajax({ method: "PUT", url, data }).done(function() {
                notify('Αποθηκεύτηκε', 'inverse');
                $(`.slot-input`).attr('disabled', false);
                loadAppointments();
            });
        }

        $(document).ready(function() {
            loadAppointments();
            // setInterval(loadAppointments, 10000);

            $(document).on('blur', '.slot-input', async function(e) {
                e.preventDefault();

                const { userId, date, hour } = $(this).data();
                const description = $(this).val();
                const slotId = getSlotId(userId, date, hour);
                const existingDescription = appointmentMap[slotId] || '';

                if (existingDescription !== description) {
                    await saveAppointment(userId, description, date, hour);
                }
            });
        });
    </script>
@endpush
