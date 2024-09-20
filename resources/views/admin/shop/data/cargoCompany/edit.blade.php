@extends('admin.layouts.main')
@section('admin_content')
    @php
        use Illuminate\Support\Facades\Route;

        $currentRouteName = Route::currentRouteName();

        $authType = $currentRouteName == 'admin_shop_cargo_company_create' ? $create : $update;
    @endphp
    @if ($authType)
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- JAVASCRIPT -->
        <script src="{{ 'admin/assets/libs/jquery/jquery.min.js' }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <form class="needs-validation" id="EditForm" action="{{ route('admin_shop_cargo_company_save') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            @isset($item)
                                <div hidden>
                                    <input type="text" class="form-control" id="code" name="code"
                                        value="{{ $item->code ?? '' }}" required>
                                </div>
                            @endisset

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">Kargo Firması İsmi:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="İsim" value="{{ $item->value ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">Kargo Firması Fotoğrafı:</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Kargo Firması Fotoğrafı">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="description">Açıklama:</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Açıklama">{{ $item->optional_2 ?? '' }}</textarea>

                                </div>
                            </div>
                            <div style="float: right;">
                                <button class="btn btn-primary" type="button" onclick="editSubmitForm()">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function editSubmitForm() {
                var name = document.getElementById('name').value;
                if (name == "") {
                    Swal.fire({
                        title: "Hata",
                        text: "Lütfen Gerekli Yerleri Doldurunuz.",
                        icon: "error"
                    });
                } else {
                    document.getElementById('EditForm').submit();
                }

            }
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if (!$authType)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
