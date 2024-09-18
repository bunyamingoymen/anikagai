<div class="row">
    <div class="col-md-12 mb-3">
        <label for="name">Ürün İsmi:</label>
        <input type="text" class="form-control" id="name" name="name"
            placeholder="İsim" value="{{$item->name ?? ''}}" required>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-3">
        <label for="description">Açıklama:</label>
        <div id="summernote">{!!$item->description ?? ''!!}</div>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Açıklama"
            hidden required>{!!$item->description ?? ''!!}</textarea>
    </div>
</div>
<div class="row">
    <div class="row col-md-12">
        <div class="col-md-6">
            <label for="price">Ücret:</label>
            <div class="row">
                <input type="number" class="form-control col-md-3" id="price" name="price"  value="{{$item->price ?? ''}}" required>
                <select name="priceType" id="priceType" class="form-control col-md-3 ml-1">
                    <option value="TRY" {{isset($item) && $item->priceType == 'TRY' ?'selected': ''}}>TRY</option>
                    <option value="EUR" {{isset($item) && $item->priceType == 'EUR' ?'selected': ''}}>EUR</option>
                    <option value="USD" {{isset($item) && $item->priceType == 'USD' ?'selected': ''}}>USD</option>
                </select>
            </div>
        </div>
    </div>

</div>

<script>
    $.getScript("{{ url('admin/assets/libs/summernote/summernote-bs4.min.js') }}", function() {
                $(document).ready(function() {
                    $("#summernote").summernote({
                            height: 300,
                            minHeight: null,
                            maxHeight: null,
                            focus: !1,
                        }),
                        $("#summernote-inline").summernote({
                            airMode: !0
                        });
                });
            });
</script>
