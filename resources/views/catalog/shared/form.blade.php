@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <div class="fg-line">
        <label for="name">ΟΝΟΜΑ</label>
        <input id="name" type="text" name="name" class="form-control" placeholder="" required="required" value="{{ $item['name'] or '' }}">
    </div>
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
    <div class="fg-line">
        <label for="price">TIMH</label>
        <input id="price" type="number" name="price" class="form-control" placeholder="" required="required" value="{{ $item['price'] or '' }}">
    </div>
</div>

<div class="f-500">ΚΑΤΗΓΟΡΙΑ</div>
<div class="m-b-15">
    @foreach($categories as $cat)
        <div class="category-radio radio clearfix m-t-10">
            <label>
                <input required="required" type="radio" name="cat" value="{{ $cat }}" {{ isset($item['cat']) && $item['cat'] === $cat ? 'checked="checked"':'' }}>
                <i class="input-helper"></i>
                {{ $cat }}
            </label>
        </div>
    @endforeach

    <div class="new-category">
        <input class="new-category-input form-control hidden" type="text" value="" placeholder="ΟΝΟΜΑ ΚΑΤΗΓΟΡΙΑΣ ΧΩΡΙΣ ΤΟΝΟΥΣ" />
        <a href="#" class="new-category-btn">Νέα κατηγορία</a>
        <a href="#" class="cancel-new-category-btn hidden">Άκυρωση</a>
    </div>
</div>


<div class="text-right">
    <button class="btn bgm-black">ΑΠΟΘΗΚΕΥΣΗ</button>
</div>


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('click', '.new-category-btn', function(e) {
                e.preventDefault();

                $('.new-category .new-category-input').attr('name', 'cat');
                $('.new-category .new-category-input').removeClass('hidden');
                $('.new-category .new-category-btn').addClass('hidden');
                $('.new-category .cancel-new-category-btn').removeClass('hidden');
                $('.category-radio').addClass('disabled');
                $('.category-radio label input').attr('disabled', true);
            });

            $(document).on('click', '.cancel-new-category-btn', function(e) {
                e.preventDefault();
                
                $('.new-category .new-category-input').attr('name', '');
                $('.new-category .new-category-input').addClass('hidden');
                $('.new-category .new-category-btn').removeClass('hidden');
                $('.new-category .cancel-new-category-btn').addClass('hidden');
                $('.category-radio').removeClass('disabled');
                $('.category-radio label input').attr('disabled', false);
            });

            $(document).on('input', '.new-category-input', function(e) {
                this.value = this.value.toUpperCase();
            });
        });
    </script>
@endpush