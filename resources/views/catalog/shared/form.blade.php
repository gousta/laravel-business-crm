@include('layouts.error')

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="name">ΟΝΟΜΑ</label>
            <input id="name" type="text" name="name" class="form-control" placeholder="" required="required" value="{{ $item['name'] or '' }}">
        </div>
        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
            <label for="price">TIMH</label>
            <input id="price" type="number" name="price" class="form-control" placeholder="" required="required" value="{{ $item['price'] or '' }}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <label for="cat">ΚΑΤΗΓΟΡΙΑ</label>
        <div class="m-b-15">
            @foreach($categories as $cat)
                <div class="category-radio radio clearfix m-t-10">
                    <label>
                        <input required="required" type="radio" name="cat" value="{{ $cat }}" {{ isset($item['cat']) && $item['cat'] === $cat ? 'checked="checked"' : '' }}>
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
        <label for="brand">ΜΑΡΚΑ</label>
        <div class="m-b-15">
            @foreach($brands as $brand)
                @if(!empty($brand))
                    <div class="brand-radio radio clearfix m-t-10">
                        <label>
                            <input type="radio" name="brand" value="{{ $brand }}" {{ isset($item['brand']) && $item['brand'] === $brand ? 'checked="checked"' : '' }}>
                            <i class="input-helper"></i>
                            {{ $brand }}
                        </label>
                    </div>
                @endif
            @endforeach

            <div class="new-brand">
                <input class="new-brand-input form-control hidden" type="text" value="" placeholder="ΟΝΟΜΑ ΜΑΡΚΑΣ" />
                <a href="#" class="new-brand-btn">Νέα μάρκα</a>
                <a href="#" class="cancel-new-brand-btn hidden">Άκυρωση</a>
            </div>
        </div>
    </div>
</div>


<div class="text-right">
    <button class="btn bgm-crm">ΑΠΟΘΗΚΕΥΣΗ</button>
</div>


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {


            // CATEGORY
            $(document).on('click', '.new-category-btn', function (e) {
                e.preventDefault();

                $('.new-category .new-category-input').attr('name', 'cat');
                $('.new-category .new-category-input').removeClass('hidden');
                $('.new-category .new-category-btn').addClass('hidden');
                $('.new-category .cancel-new-category-btn').removeClass('hidden');
                $('.category-radio').addClass('disabled');
                $('.category-radio label input').attr('disabled', true);
            });

            $(document).on('click', '.cancel-new-category-btn', function (e) {
                e.preventDefault();

                $('.new-category .new-category-input').attr('name', '');
                $('.new-category .new-category-input').addClass('hidden');
                $('.new-category .new-category-btn').removeClass('hidden');
                $('.new-category .cancel-new-category-btn').addClass('hidden');
                $('.category-radio').removeClass('disabled');
                $('.category-radio label input').attr('disabled', false);
            });

            $(document).on('input', '.new-category-input', function (e) {
                this.value = this.value.toUpperCase();
            });


            // BRAND
            $(document).on('click', '.new-brand-btn', function (e) {
                e.preventDefault();

                $('.new-brand .new-brand-input').attr('name', 'brand');
                $('.new-brand .new-brand-input').removeClass('hidden');
                $('.new-brand .new-brand-btn').addClass('hidden');
                $('.new-brand .cancel-new-brand-btn').removeClass('hidden');
                $('.brand-radio').addClass('disabled');
                $('.brand-radio label input').attr('disabled', true);
            });

            $(document).on('click', '.cancel-new-brand-btn', function (e) {
                e.preventDefault();

                $('.new-brand .new-brand-input').attr('name', '');
                $('.new-brand .new-brand-input').addClass('hidden');
                $('.new-brand .new-brand-btn').removeClass('hidden');
                $('.new-brand .cancel-new-brand-btn').addClass('hidden');
                $('.brand-radio').removeClass('disabled');
                $('.brand-radio label input').attr('disabled', false);
            });
        });
    </script>
@endpush