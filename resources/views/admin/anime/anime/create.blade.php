@extends("admin.layouts.main")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Yeni Anime Ekle</h4>

                <form class="needs-validation" id="animeCreateForm" action="{{route('admin_anime_create')}}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom01">İsim:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="İsim" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Resim:</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="Dosya Seçiniz"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom03">Açıklama:</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                                placeholder="Açıklama"></textarea>
                        </div>
                    </div>
                    <div style="float: right;">
                        <button class="btn btn-primary" type="submit">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
