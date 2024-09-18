<div class="mb-3">
    <label for="formFile" class="form-label">Varsayılan Ana resim:</label>
    <input type="file" class="form-control" id="main_image" name="main_image">
</div>
<div class="mb-3">
    <label for="formFile" class="form-label">Diğer Resimler:</label>
    <input type="file" class="form-control" id="images" name="images[]" multiple>
</div>

@if (isset($main_image) || isset($images))
<div class="mb-5 mt-5">
    <label for=""><i>Daha önce yüklenmiş resimler: </i></label>
    @if (isset($main_image))
    <div class="mt-5">
        <label for="">Ana Resim: </label>
        <div class="row" style="align-items: center">
            <img src="{{url($main_image->path)}}" alt="main_image" style="max-width: 200px;">
            <small class="mr-3 ml-3"><i><b>Değiştirebilmek için yukarıda yeni bir ana resim seçiniz!</b></i></small>
        </div>
    </div>
    @endif

    @if (isset($images) && count($images)>0)
    <div class="mt-5">
        <label for="">Diğer Resimler: </label>
        @foreach ($images as $image)
            <div class="row mt-4" style="align-items: center">
                <img src="{{url($image->path)}}" alt="image_{{$image->code}}" style="max-width: 200px;">
                <div class="mr-2 ml-2">
                    <a href="{{route('admin_shop_product_delete_image')}}?code={{$image->code}}&parent_code={{$image->parent_code}}" class="btn btn-danger"><i class="fas fa-trash-alt mr-2 ml-1"></i>Sil</a>
                </div>
            </div>
        @endforeach

    </div>
    @endif

</div>
@endif
