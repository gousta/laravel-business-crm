@include('layouts.error')

<div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
    <label for="date">ΜΗΝΑΣ</label>
    <div class="select">
        <select id="date" name="date" class="form-control">
            @foreach($range as $ri)
                <option value="{{ $ri['value'] }}" {!! Request::input('date') == $ri['value'] ? 'selected':'' !!}>
                    {{ $ri['label'] }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group {{ $errors->has('cashier') ? 'has-error' : '' }}">
            <div class="fg-line">
                <label for="cashier">ΦΠΑ ΤΑΜΕΙΑΚΗΣ</label>
                <input id="cashier" type="number" step="0.01" name="cashier" class="form-control" placeholder="" value="{{ $vat['cashier'] or '' }}">
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group {{ $errors->has('invoice') ? 'has-error' : '' }}">
            <div class="fg-line">
                <label for="invoice">ΦΠΑ ΑΠΟ ΤΙΜΟΛΟΓΙΑ</label>
                <input id="invoice" type="number" step="0.01" name="invoice" class="form-control" placeholder="" value="{{ $vat['invoice'] or '' }}">
            </div>
        </div>
    </div>
</div>


<div class="text-right">
    @if($vat)
        {{ Form::open(['method'  => 'DELETE', 'route' => ['vat.destroy', $vat->id]]) }}
        {{ Form::hidden('date', Request::input('date')) }}
        {{ Form::button('ΔΙΑΓΡΑΦΗ', ['type' => 'submit', 'class' => 'btn btn-link c-red']) }}
        {{ Form::close() }}
    @else
        <button class="btn bgm-black">ΑΠΟΘΗΚΕΥΣΗ</button>
    @endif
</div>