@include('layouts.error')


<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">ΟΝΟΜΑ</label>
            <input id="name" type="text" name="name" class="form-control" placeholder="" value="{{ $user['name'] or '' }}" />
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
            <div class="select">
                <label for="email">ΡΟΛΟΣ</label>

                <select id="role" name="role" class="form-control user-select" data-placeholder="ΕΠΙΛΟΓΗ">
                    @foreach (config('crm.roles') as $key => $role)
                        <option value="{{ $key }}" {{ isset($user['role']) && $user['role'] === $key ? 'selected':'' }}>
                            {{ $role['label'] }} ({{ empty($role['access']) ? 'all' : join($role['access'], ', ') }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email">EMAIL</label>
    <input id="email" type="email" name="email" class="form-control" required="required" value="{{ $user['email'] or '' }}" />
</div>

@if (isset($user['id']))

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email">PASSWORD</label>
    <input id="password" type="password" name="password" class="form-control" value="" />
</div>

@else

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="email">ΚΩΔΙΚΟΣ ΠΡΟΣΒΑΣΗΣ</label>
            <input id="password" type="password" name="password" class="form-control" required="required" value="" />
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="email">ΕΠΑΝΑΛΗΨΗ ΚΩΔΙΚΟΥ ΠΡΟΣΒΑΣΗΣ</label>
            <input id="password_confirm" type="password" name="password_confirm" class="form-control" required="required" value="" />
        </div>
    </div>
</div>

@endif

<div class="form-group {{ $errors->has('show_in_calendar') ? 'has-error' : '' }}">
    <div class="checkbox m-t-0 m-b-15">
        <label>
            <input type="checkbox" name="show_in_calendar" value="true" {{ isset($user['show_in_calendar']) && $user['show_in_calendar'] ? 'checked':'' }} />
            <i class="input-helper"></i>
            ΕΜΦΑΝΙΣΗ ΣΤΟ ΗΜΕΡΟΛΟΓΙΟ
        </label>
    </div>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name">ΣΕΙΡΑ ΕΜΦΑΝΙΣΗΣ ΣΤΟ ΗΜΕΡΟΛΟΓΙΟ</label>
    <input id="name" type="text" name="order_in_calendar" class="form-control" placeholder="" value="{{ $user['order_in_calendar'] or '' }}" />
</div>

<div class="text-right">
    <button class="btn bgm-crm">ΑΠΟΘΗΚΕΥΣΗ</button>
</div>

@push('scripts')
    <!-- <script type="text/javascript">
        $(document).ready(function() {

            var regex = /[+-]?([0-9]*[.,])?[0-9]+/g;

            $(document).on('input', '#description', function () {
                var total = 0;
                var str = $(this).val();

                while ((m = regex.exec(str)) !== null) {
                    // This is necessary to avoid infinite loops with zero-width matches
                    if (m.index === regex.lastIndex) {
                        regex.lastIndex++;
                    }
                    m[0] = m[0].replace(',', '.');

                    total = total + parseFloat(m[0]);
                }

                $('#amount').val(total.toFixed(2));
            });

        });
    </script> -->
@endpush
