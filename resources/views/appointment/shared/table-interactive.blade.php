@push('styles')
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

        .table thead tr th {
            background: #f3f3f3;
            font-weight: 900;
        }

        .table thead tr th:first-child {
            width: 65px;
        }

        .table tbody tr td {
            border-top: 0;
            border-left: 5px solid #f3f3f3;
            border-right: 5px solid #f3f3f3;
            border-bottom: 0;
            padding: 0 !important;
            height: 30px;
        }

        .table tbody tr td:first-child {
            background: #f3f3f3;
            padding: 5px 0 5px 0 !important;
            border-top-color: transparent;
            border-bottom-color: transparent;
        }

        .tips-row {
            border-bottom: 15px solid #f3f3f3;
            z-index: 1;
        }

        .tips-input,
        .slot-input {
            display: block;
            width: 100%;
            height: 100%;
            border: 1px solid #f3f3f3;
            box-shadow: none;
            padding-left: 5px;
            padding-right: 5px;
        }

        .slot-input::placeholder {
            color: #ccc;
        }

        .tips-wrapper,
        .slot-wrapper {
            position: relative;
        }

        .base-tooltip {
            visibility: hidden;
            display: block;
            overflow: hidden;
            box-sizing: border-box;
            padding: 2px 4px;
            background: #32c787;
            color: #fff;
            font-weight: 600;
            font-size: 12px;
            border-radius: 2px 0 0 2px;
            position: absolute;
            top: 0px;
            left: -38px;
            z-index: 1;
            top: 0px;
        }

        .tips-tooltip {
            left: -45px;
        }

        .slot-tooltip {
            left: -38px;
        }

        .tooltip-input:focus {
            border: 1px solid #32c787;
            border-radius: 0 2px 2px 2px;
        }

        .tooltip-input:focus + .base-tooltip {
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

<div class="table-wrap">
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
        <!-- <tr class="tips-row">
            <td>TIPS</td>
            @foreach($users as $user)
            <td class="tips-wrapper">
                <input type="number" class="tips-input tooltip-input" data-user-id="{{$user->id}}" data-date="{{$date}}" />
                <div class="base-tooltip tips-tooltip">€ TIPS</div>
            </td>
            @endforeach
        </tr> -->

        @foreach($hours as $hour)
        <tr>
            <td>{{ $hour }}</td>
            @foreach($users as $user)
            <td class="slot-wrapper" id="{{ str_replace(':', '', $user->id.$date.$hour) }}">
                <input type="text" class="slot-input tooltip-input" data-user-id="{{$user->id}}" data-date="{{$date}}" data-hour="{{$hour}}" />
                <div class="base-tooltip slot-tooltip">{{$hour}}</div>
            </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
</div>

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
