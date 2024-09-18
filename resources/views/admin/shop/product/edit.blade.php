@extends('admin.layouts.main')
@section('admin_content')
@php
    use Illuminate\Support\Facades\Route;

    $currentRouteName = Route::currentRouteName();

    $authType = $currentRouteName == 'admin_shop_product_create' ? $create : $update;
@endphp
    @if ($authType)
     <!-- Summernote css -->
     <link href="{{ url('admin/assets/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- JAVASCRIPT -->
        <script src="{{ 'admin/assets/libs/jquery/jquery.min.js' }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link active" data-toggle="tab" href="#general-information" id="general-information-button-id" role="tab">
                                    <i class="dripicons-align-center mr-1 align-middle"></i> <span class="d-none d-md-inline-block">Genel Bilgiler</span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#category-features" id="category-features-button-id" role="tab">
                                    <i class="dripicons-gear mr-1 align-middle"></i> <span class="d-none d-md-inline-block">Özellikler</span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#images-videos" id="images-videos-button-id" role="tab">
                                    <i class="dripicons-photo mr-1 align-middle"></i> <span class="d-none d-md-inline-block">Resimler</span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#other-settings" id="other-settings-button-id" role="tab">
                                    <i class="dripicons-chevron-right mr-1 align-middle"></i> <span class="d-none d-md-inline-block">Diğer Bilgiler</span>
                                </a>
                            </li>
                        </ul>
                        <form class="needs-validation" id="EditForm" action="{{ route('admin_shop_product_save') }}"
                        method="POST" enctype="multipart/form-data">
                            @csrf
                            @isset($item)
                                <div hidden>
                                    <input type="text" class="form-control" id="code" name="code" value="{{$item->code ?? '' }}" required>
                                </div>
                            @endisset
                            <!-- Tab panes -->
                            <div class="tab-content p-3">
                                <div class="tab-pane active" id="general-information" role="tabpanel">

                                    @include('admin.shop.product.includes.edit.general_informaton')

                                    <div>
                                        <button class="btn btn-primary float-right" type="button" onclick="document.getElementById('category-features-button-id').click()"> <i class="dripicons-chevron-right"></i> İleri </button>
                                    </div>
                                </div>

                                <div class="tab-pane" id="category-features" role="tabpanel">

                                    @include('admin.shop.product.includes.edit.category_features')

                                    <div class="mt-3">
                                        <button class="btn btn-primary" type="button" onclick="document.getElementById('general-information-button-id').click()"> <i class="dripicons-chevron-left"></i> Geri </button>
                                        <button class="btn btn-primary float-right" type="button" onclick="document.getElementById('images-videos-button-id').click()"> <i class="dripicons-chevron-right"></i> İleri </button>
                                    </div>
                                </div>

                                <div class="tab-pane" id="images-videos" role="tabpanel">

                                    @include('admin.shop.product.includes.edit.image_videos')

                                    <div class="mt-3">
                                        <button class="btn btn-primary" type="button" onclick="document.getElementById('category-features-button-id').click()"> <i class="dripicons-chevron-left"></i> Geri </button>
                                        <button class="btn btn-primary float-right" type="button" onclick="document.getElementById('other-settings-button-id').click()"> <i class="dripicons-chevron-right"></i> İleri </button>
                                    </div>
                                </div>

                                <div class="tab-pane" id="other-settings" role="tabpanel">

                                    @include('admin.shop.product.includes.edit.other')

                                    <div class="mt-3">
                                        <button class="btn btn-primary" type="button" onclick="document.getElementById('images-videos-button-id').click()"> <i class="dripicons-chevron-left"></i> Geri </button>
                                        <button class="btn btn-primary float-right" type="button" onclick="editSubmitForm()"> <i class="fas fa-save"></i> Kaydet</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>

            function editSubmitForm() {
                document.getElementById('description').value = document.getElementsByClassName('note-editable')[0].innerHTML;

                var name = document.getElementById('name').value;

                if (name == "") {
                    Swal.fire({
                        title: "Hata",
                        text: "Lütfen Gerekli Yerleri Doldurunuz.",
                        icon: "error"
                    });
                }else{
                    document.getElementById('EditForm').submit();
                }

            }

            $(document).ready(function() {
                configCargoCompany();
                configCategory();

                @if (session('select_tab'))
                document.getElementById("{{ session('select_tab') }}").click();
                @endif
            });
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
