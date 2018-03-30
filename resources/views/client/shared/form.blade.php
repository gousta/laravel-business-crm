    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <div class="fg-line">
                    <label for="name">ΟΝΟΜΑ</label>
                    <input id="name" type="text" name="name" class="form-control" placeholder="" required="required" value="{{ $client['name'] or '' }}">
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group {{ $errors->has('surname') ? 'has-error' : '' }}">
                <div class="fg-line">
                    <label for="surname">ΕΠΩΝΥΜΟ</label>
                    <input id="surname" type="text" name="surname" class="form-control" placeholder="" value="{{ $client['surname'] or '' }}">
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-6">

            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <div class="fg-line">
                    <label for="phone">ΤΗΛΕΦΩΝΟ</label>
                    <input id="phone" type="number" name="phone" class="form-control" placeholder="6930123456" value="{{ $client['phone'] or '' }}">
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <div class="fg-line">
                    <label for="email">EMAIL</label>
                    <input id="email" type="email" name="email" class="form-control" placeholder="onoma@gmail.com" value="{{ $client['email'] or '' }}">
                </div>
            </div>
        </div>
    </div>

    <div class="row m-b-15">
        <div class="col-xs-6 col-lg-2">
            <div class="radio">
                <label>
                    <input type="radio" name="gender" value="female" {{ !isset($client['gender']) || $client['gender'] === null || $client['gender'] === 'female' ? 'checked="checked"':'' }}>
                    <i class="input-helper"></i>
                    Γυναίκα
                </label>
            </div>
        </div>
        <div class="col-xs-6 col-lg-2">
            <div class="radio">
                <label>
                    <input type="radio" name="gender" value="male" {{ isset($client['gender']) && $client['gender'] === 'male' ? 'checked="checked"':'' }}>
                    <i class="input-helper"></i>
                    Άνδρας
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="fg-line">
            <label for="birthday">ΗΜΕΡΟΜΗΝΙΑ ΓΕΝΝΗΣΗΣ</label>
            <input id="birthday" type="text" name="birthday" class="form-control input-mask" data-mask="00/00/0000" placeholder="dd/mm/yyyy" value="{{ $client['birthday'] or '' }}" autocomplete="off">
        </div>
    </div>

    <div class="form-group">
        <div class="fg-line">
            <label for="notes">ΣΗΜΕΙΩΣΕΙΣ</label>
            <textarea id="notes" class="form-control auto-size" name="notes" placeholder="...">{{ $client['notes'] or '' }}</textarea>
        </div>
    </div>

    <div class="text-right">
        <button class="btn bgm-black">ΑΠΟΘΗΚΕΥΣΗ</button>
    </div>

    @push('scripts')
        <script src="/assets/vendors/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
        <script src="/assets/vendors/bower_components/autosize/dist/autosize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                autosize($('.auto-size'));
            });
        </script>
    @endpush