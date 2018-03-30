<div>
    <div class="row">
        <div class="col-lg-5">
            <div class="form-group">
                <label for="catalog_id">ΕΡΓΑΣΙΑ</label>
                <input type="text" disabled="disabled" class="form-control" value="{{ $labor->item->name or '' }}">
            </div>
        </div>
        <div class="col-lg-2">
            <label for="price">ΤΙΜΗ</label>
            <input id="price" name="price" type="text" class="form-control" value="{{ $labor->price or '' }}">
        </div>
        <div class="col-lg-5">
            <div class="form-group">
                <div class="fg-line">
                    <label for="date">ΗΜΕΡΟΜΗΝΙΑ</label>
                    <input id="date" type="text" name="date" class="form-control input-mask" data-mask="00/00/0000" placeholder="dd/mm/yyyy" value="{{ $labor->date or '' }}" autocomplete="off">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="form-group">
                <div class="fg-line">
                    <label for="notes">ΣΗΜΕΙΩΣΕΙΣ</label>
                    <textarea style="height: 34px;" id="notes" class="form-control" name="notes" placeholder="...">{{ $labor->notes or '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-3 text-right">
            <button class="btn bgm-black btn-lg m-t-10 m-b-10">ΑΠΟΘΗΚΕΥΣΗ</button>
        </div>
    </div>
</div>