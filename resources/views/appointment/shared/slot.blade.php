@push('styles')
    <link href="/assets/vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
@endpush

<div class="modal appointment-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title appointment-title"></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="appointment-start-hour">Ώρα έναρξης</label>
                            <div class="select">
                                <select id="appointment-start-hour" name="appointment-start-hour" class="form-control" disabled>
                                    @foreach($hours as $hour)
                                        <option value="{{ $hour }}">{{ $hour }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="appointment-end-hour">Ώρα λήξης</label>
                            <div class="select">
                                <select id="appointment-end-hour" name="appointment-end-hour" class="form-control">
                                    @foreach($hours as $hour)
                                        <option value="{{ $hour }}">{{ $hour }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <h5>Παλιός πελάτης</h5>

                        <div class="form-group">
                            <select class="select2">
                                <option></option>
                                <option>Subaru</option>
                                <option>Mitsubishi</option>
                                <option>Scion</option>
                                <option>Daihatsu</option>
                                <option>Hino</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <h5>Νέος πελάτης</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link appointment-close">ΑΚΥΡΟ</button>
                <button type="button" class="btn bgm-crm">ΔΗΜΙΟΥΡΓΙΑ ΡΑΝΤΕΒΟΥ</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="/assets/vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var a = $(".select2-parent")[0] ? $(".select2-parent") : $("body");
            $('.select2').select2({
                dropdownAutoWidth: !0,
                width: "100%",
                dropdownParent: a,
            });

            $(document).on('keyup', function(e) {
                // if (e.key == "Enter") $('.appointment-close').click();
                if (e.key == "Escape") $('.appointment-close').click();
            });

            $(document).on('click', '.appointment-close', function(e) {
                e.preventDefault();
                $('.appointment-modal').modal('hide');
            });

            $(document).on('click', '.slot', function(e) {
                e.preventDefault();

                var {
                    appointmentTitle,
                    appointmentUserId,
                    appointmentStartHour,
                    appointmentDate,
                } = $(this).data();

                $('.appointment-modal').modal({ show: true });
                $('.appointment-title').html(appointmentTitle);
                $('[name=appointment-start-hour]').val(appointmentStartHour);

                $('[name=appointment-end-hour] option').prop('disabled', false);
                $('[name=appointment-end-hour] option').each(function( index ) {
                    const startingHour = Number(appointmentStartHour.replace(':', ''));
                    const currentHour = Number($(this).val().replace(':', ''));

                    $(this).prop('disabled', startingHour > currentHour);
                });
                $('[name=appointment-end-hour]').val(appointmentStartHour);

            });
        });
    </script>
@endpush
