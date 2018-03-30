@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
    <div class="fg-line">
        <label for="amount">ΠΟΣΟ</label>
        <input id="amount" type="number" step="0.01" name="amount" class="form-control" placeholder="" value="{{ $expense['amount'] or '' }}">
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <div class="fg-line">
        <label for="description">ΑΝΤΙΚΕΙΜΕΝΑ (1 ΣΕ ΚΑΘΕ ΓΡΑΜΜΗ, ΜΟΡΦΗ: 5.50 kafedes)</label>
        <textarea rows="8" id="description" name="description" class="form-control" required="required">{{ $expense['description'] or '' }}</textarea>
    </div>
</div>


<div class="text-right">
    <button class="btn bgm-black">ΑΠΟΘΗΚΕΥΣΗ</button>
</div>

@push('scripts')
    <script type="text/javascript">
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
    </script>
@endpush