@extends("admin.layouts.main")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Kullanıcı Grubu Oluştur</h4>
                <p class="card-title-desc">
                    Aşağıdaki değerleri doldurarak yeni bir kullanıcı grubu oluşturabilirsiniz
                </p>

                <form class="needs-validation" id="AuthGroupCreateForm" action="{{route('admin_authgroup_create')}}"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Yazı:</label>
                            <input type="text" class="form-control" id="text" name="text" placeholder="Yazı" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
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