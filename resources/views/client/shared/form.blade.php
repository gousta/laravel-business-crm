@include('layouts.error')

@push('styles')
    <style>
        .row>.can-be-single-column:only-child {
            width: 100%;
        }

        .brand-input-dropdown-menu .tt-dropdown-menu {
            max-height: 150px;
            overflow-y: auto;
        }
    </style>
@endpush

<div class="row">
    <div class="col-lg-6 col-md-12 can-be-single-column">
        <h5 class="with-hr">ΠΡΟΣΩΠΙΚΑ ΣΤΟΙΧΕΙΑ</h5>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">ΟΝΟΜΑ</label>
                    <input id="name" type="text" name="name" class="form-control" placeholder="" required="required" value="{{ $client['name'] or '' }}">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group {{ $errors->has('surname') ? 'has-error' : '' }}">
                    <label for="surname">ΕΠΩΝΥΜΟ</label>
                    <input id="surname" type="text" name="surname" class="form-control" placeholder="" value="{{ $client['surname'] or '' }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="phone">ΤΗΛΕΦΩΝΟ (KINHTO)</label>
                    <input id="phone" type="number" name="phone" class="form-control" placeholder="6930123456" value="{{ $client['phone'] or '' }}">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">EMAIL</label>
                    <input id="email" type="email" name="email" class="form-control" placeholder="onoma@gmail.com" value="{{ $client['email'] or '' }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="birthday">ΗΜΕΡΟΜΗΝΙΑ ΓΕΝΝΗΣΗΣ</label>
                    <input id="birthday" type="text" name="birthday" class="form-control input-mask" data-mask="00/00/0000" placeholder="ΗΗ/ΜΜ/ΕΕΕΕ" value="{{ $client['birthday'] or '' }}" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-6 m-b-15">
                <label>ΦΥΛΟ</label>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="female" {{ !isset($client['gender']) || $client['gender'] === null || $client['gender'] === 'female' ? 'checked="checked"' : '' }}>
                                <i class="input-helper"></i>
                                Γυναίκα
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="male" {{ isset($client['gender']) && $client['gender'] === 'male' ? 'checked="checked"' : '' }}>
                                <i class="input-helper"></i>
                                Άνδρας
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @if(config('crm.mode') === 'mechanic')
            <div class="form-group {{ $errors->has('vat') ? 'has-error' : '' }}">
                <label for="vat">ΑΦΜ</label>
                <input id="vat" type="text" name="vat" class="form-control" placeholder="" value="{{ $client['vat'] or '' }}">
            </div>
        @endif

        <div class="form-group">
            <label for="notes">ΣΗΜΕΙΩΣΕΙΣ</label>
            <textarea id="notes" class="form-control auto-size" rows="4" name="notes" placeholder="...">{{ $client['notes'] or '' }}</textarea>
        </div>
    </div>
    @if(config('crm.mode') === 'mechanic')
        <div class="col-lg-6 col-md-12 ">
            <h5 class="with-hr">ΟΧΗΜΑ</h5>

            <div class="row">
                <div class="col-xs-6">
                    <div class="brand-input-dropdown-menu">
                        <div class="form-group {{ $errors->has('vehicle_brand') ? 'has-error' : '' }}">
                            <label for="vehicle_brand">ΜΑΡΚΑ</label>
                            <input id="vehicle_brand" type="text" name="vehicle_brand" class="form-control brand-input capitalize-input" placeholder="" value="{{ $client['vehicle']['brand'] or '' }}">
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group {{ $errors->has('vehicle_model') ? 'has-error' : '' }}">
                        <label for="vehicle_model">ΜΟΝΤΕΛΟ</label>
                        <input id="vehicle_model" type="text" name="vehicle_model" class="form-control capitalize-input" placeholder="" value="{{ $client['vehicle']['model'] or '' }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group {{ $errors->has('vehicle_license_plate') ? 'has-error' : '' }}">
                        <label for="vehicle_license_plate">ΑΡΙΘΜΟΣ ΚΥΚΛΟΦΟΡΙΑΣ</label>
                        <input id="vehicle_license_plate" type="text" name="vehicle_license_plate" class="form-control capitalize-input remove-spaces" placeholder="ΙΤΟ1234" value="{{ $client['vehicle']['license_plate'] or '' }}">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group {{ $errors->has('vehicle_production_year') ? 'has-error' : '' }}">
                        <label for="vehicle_production_year">ΕΤΟΣ ΚΑΤΑΣΚΕΥΗΣ</label>
                        <input id="vehicle_production_year" type="text" name="vehicle_production_year" class="form-control input-mask" data-mask="0000" placeholder="2015" value="{{ $client['vehicle']['production_year'] or '' }}">
                    </div>
                </div>
            </div>


            <div class="form-group {{ $errors->has('vehicle_vin') ? 'has-error' : '' }}">
                <label for="vehicle_vin">ΑΡΙΘΜΟΣ ΠΛΑΙΣΙΟΥ</label>
                <input id="vehicle_vin" type="text" name="vehicle_vin" class="form-control capitalize-input alphanumeric-input" placeholder="XXXXXXXXXXXXXXXXX" value="{{ $client['vehicle']['vin'] or '' }}">
            </div>



            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group {{ $errors->has('vehicle_engine_displacement_cc') ? 'has-error' : '' }}">
                        <label for="vehicle_engine_displacement_cc">ΚΥΒΙΚΑ ΕΚΑΤΟΣΤΑ ΚΙΝΗΤΗΡΑ</label>
                        <input id="vehicle_engine_displacement_cc" type="text" name="vehicle_engine_displacement_cc" class="form-control remove-spaces" placeholder="1685" value="{{ $client['vehicle']['engine_displacement_cc'] or '' }}">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group {{ $errors->has('vehicle_engine_code') ? 'has-error' : '' }}">
                        <label for="vehicle_engine_code">ΚΩΔΙΚΟΣ ΚΙΝΗΤΗΡΑ</label>
                        <input id="vehicle_engine_code" type="text" name="vehicle_engine_code" class="form-control" placeholder="D4FD" value="{{ $client['vehicle']['engine_code'] or '' }}">
                    </div>
                </div>
            </div>

        </div>
    @endif
</div>

<div class="row">
    <div class="col-xs-6">

        @if(Auth::user()->role === 'admin' && isset($client, $client->id))
            <a href="{{ route('client.delete', ['id' => $client->id]) }}" class="btn bgm-red">
                ΑΙΤΗΜΑ ΔΙΑΓΡΑΦΗΣ
            </a>
        @endif
    </div>
    <div class="col-xs-6">
        <div class="text-right">
            <button class="btn bgm-crm">ΑΠΟΘΗΚΕΥΣΗ</button>
        </div>
    </div>
</div>

@push('scripts')
    <script src="/assets/vendors/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
    <script src="/assets/vendors/bower_components/autosize/dist/autosize.min.js"></script>
    <script src="/assets/vendors/bower_components/typeahead.js/dist/typeahead.jquery.min.js"></script>
    <script type="text/javascript">

        var brands = [
            "ABARTH",
            "AC",
            "ACURA",
            "AIXAM",
            "ALFA ROMEO",
            "ARIEL",
            "ARRINERA",
            "ASTON MARTIN",
            "AUDI",
            "BENTLEY",
            "BMW",
            "BUGATTI",
            "BUICK",
            "CADILLAC",
            "CATERHAM",
            "CHEVROLET",
            "CHRYSLER",
            "CITROËN",
            "CORVETTE",
            "DACIA",
            "DAF",
            "DAIHATSU",
            "DODGE",
            "DR MOTOR",
            "ELFIN",
            "FERRARI",
            "FIAT",
            "FORD",
            "GAZ",
            "GEELY",
            "GILLET",
            "GINETTA",
            "GENERAL MOTORS",
            "GMC",
            "GREAT WALL",
            "GUMPERT",
            "HENNESSEY",
            "HOLDEN",
            "HONDA",
            "HUMMER",
            "HYUNDAI",
            "INFINITI",
            "ISUZU",
            "JAGUAR",
            "JEEP",
            "JOSS",
            "KIA",
            "KOENIGSEGG",
            "LADA",
            "LAMBORGHINI",
            "LANCIA",
            "LAND ROVER",
            "LEXUS",
            "LINCOLN",
            "LOTUS",
            "LUXGEN",
            "MAHINDRA",
            "MARUTI SUZUKI",
            "MASERATI",
            "MAYBACH",
            "MAZDA",
            "MCLAREN",
            "MERCEDES",
            "MG",
            "MINI",
            "MITSUBISHI",
            "MORGAN MOTOR",
            "MUSTANG",
            "NISSAN",
            "NOBLE",
            "OPEL",
            "PAGANI",
            "PANOZ",
            "PERODUA",
            "PEUGEOT",
            "PIAGGIO",
            "PININFARINA",
            "PORSCHE",
            "PROTON",
            "RENAULT",
            "REVA",
            "RIMAC",
            "ROLLS ROYCE",
            "RUF LOGO",
            "SAAB",
            "SCANIA",
            "SCION",
            "SEAT",
            "SHELBY",
            "SKODA",
            "SMART",
            "SPYKER",
            "SSANGYONG",
            "SSC",
            "SUBARU",
            "SUZUKI",
            "TATA",
            "TATRA",
            "TESLA",
            "TOYOTA",
            "TRAMONTANA",
            "TROLLER",
            "TVR",
            "UAZ",
            "VANDENBRINK",
            "VAUXHALL",
            "VECTOR MOTORS",
            "VENTURI",
            "VOLKSWAGEN",
            "VOLVO",
            "WIESMANN",
            "ZAGATO",
            "ZAZ",
            "ZIL"];

        var substringMatcher = function (strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function (i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });

                cb(matches);
            };
        };

        $(document).ready(function () {
            autosize($('.auto-size'));

            $('.capitalize-input').on('input', function () {
                $(this).val($(this).val().toUpperCase());
            });

            $('.remove-spaces').on('input', function () {
                $(this).val($(this).val().replace(/\s/g, ''));
            });

            $('.alphanumeric-input').on('input', function () {
                $(this).val($(this).val().replace(/[^a-zA-Z0-9]/g, ''));
            });

            $('.brand-input').typeahead(
                { hint: true, highlight: true, minLength: 0 },
                { name: 'brands', limit: 5, source: substringMatcher(brands) }
            );
        });


    </script>
@endpush
