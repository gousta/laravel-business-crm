@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group {{ $errors->has('cashier') ? 'has-error' : '' }}">
    <div class="fg-line">
        <label for="cashier">ΦΠΑ ΤΑΜΕΙΑΚΗΣ</label>
        <input id="cashier" type="number" step="0.01" name="cashier" class="form-control" placeholder="" value="{{ $vat['cashier'] or '' }}">
    </div>
</div>

<div class="form-group {{ $errors->has('invoice') ? 'has-error' : '' }}">
    <div class="fg-line">
        <label for="invoice">ΦΠΑ ΑΠΟ ΤΙΜΟΛΟΓΙΑ</label>
        <input id="invoice" type="number" step="0.01" name="invoice" class="form-control" placeholder="" value="{{ $vat['invoice'] or '' }}">
    </div>
</div>


<div class="text-right">
    <button class="btn bgm-black">ΑΠΟΘΗΚΕΥΣΗ</button>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            // var regex = /[+-]?([0-9]*[.,])?[0-9]+/g;

            // $(document).on('input', '#description', function () {
            //     var total = 0;
            //     var str = $(this).val();

            //     while ((m = regex.exec(str)) !== null) {
            //         // This is necessary to avoid infinite loops with zero-width matches
            //         if (m.index === regex.lastIndex) {
            //             regex.lastIndex++;
            //         }
            //         m[0] = m[0].replace(',', '.');

            //         total = total + parseFloat(m[0]);
            //     }

            //     $('#amount').val(total.toFixed(2));
            // });

        });
    </script>
@endpush