@extends('layouts.app', ['pageTitle' => 'Χρήστες'])

@push('actionbutton')
    <li>
        <a href="{{ route('user.create') }}"><i class="him-icon zmdi zmdi-plus-circle"></i></a>
    </li>
@endpush

@section('content')
    <div class="card">

        <div class="table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>ΟΝΟΜΑ</th>
                        <th>EMAIL</th>
                        <th>ΡΟΛΟΣ</th>
                        <th>ΗΜΕΡΟΛΟΓΙΟ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr data-href="{{ route('user.edit', $user->id) }}">
                            <td class="vamiddle">{{ $user->name or '' }}</td>
                            <td class="vamiddle">{{ $user->email or '' }}</td>
                            <td class="vamiddle">{{ config('crm.roles.'.$user->role.'.label') }}</td>
                            <td class="vamiddle">{{ $user->show_in_calendar ? 'ΝΑΙ':'ΟΧΙ' }}</td>
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

            $(document).on('click', 'tr[data-href]', function() {
                window.location.href = $(this).data('href');
            });

        });
    </script>
@endpush
