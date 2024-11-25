@include('layouts.error')

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description">ΑΝΤΙΚΕΙΜΕΝΑ</label>
    <textarea rows="12" id="description" name="description" class="form-control" required="required" style="font-family:monospace;font-size:14px">{{ $expense['description'] or '' }}</textarea>
    <p class="help-block">Ένα αντικείμενο σε κάθε γραμμή. Παράδειγμα μορφής γραμμής: 10.30 kafes</p>
</div>

<div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
    <label for="amount">ΠΟΣΟ</label>
    <input id="amount" type="number" step="0.01" name="amount" class="form-control" placeholder="0.0" value="{{ $expense['amount'] or '' }}">
    <p class="help-block">Το συνολικό υπολογίζεται αυτόματα από τα αντικείμενα, αλλά μπορείτε πάντα να το τροποποιήσετε.</p>
</div>

<div class="text-right">
    <button class="btn bgm-crm">ΑΠΟΘΗΚΕΥΣΗ</button>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            var regex = /[+-]?([0-9]*[.,])?[0-9]+/g;

            // CALCULATOR
            $(document).on('input', '#description', function () {
                hideError();
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

            // VALIDATOR
            $(document).on('blur', '#description', function () {
                var input = $(this);
                var lines = input.val().split('\n');

                // FIX INPUT VALUE
                lines.forEach(function(line) {
                    lines = lines.map(line => line.trim()).filter(line => line !== '');
                    input.val(lines.join('\n'));
                });

                // FETCH INPUT VALUE AGAIN
                lines = input.val().split('\n');

                var linesWithErrors = [];

                lines.forEach(function(line) {
                    if (!/^\d+(\.\d{1,2})?\s+.+$/.test(line)) {
                        linesWithErrors.push(line);
                    }
                });

                if (linesWithErrors.length > 0) {
                    showError(linesWithErrors);
                }
            });

            function showError(linesWithErrors) {
                $('#description').parent().addClass('has-error');
                $('#description').siblings('.help-block').text(`Κάθε γραμμή πρέπει να περιέχει έναν αριθμό (ποσό) πρώτα και μετά μια περιγραφή. Γραμμές με λάθη: "${linesWithErrors.join('", "')}"`).show();
            }

            function hideError() {
                $('#description').parent().removeClass('has-error');
                $('#description').siblings('.help-block').text('Ένα αντικείμενο σε κάθε γραμμή. Παράδειγμα μορφής γραμμής: 10.30 kafes');
            }

        });
    </script>
@endpush
