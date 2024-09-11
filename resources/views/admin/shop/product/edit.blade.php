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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <form class="needs-validation" id="EditForm" action="{{ route('admin_shop_product_save') }}"
                            method="POST">
                            @csrf

                            @isset($item)
                                <div hidden>
                                    <input type="text" class="form-control" id="code" name="code" value="{{$item->code ?? '' }}" required>
                                </div>
                            @endisset

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
                                    <div id="summernote"></div>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Açıklama"
                                        hidden required></textarea>

                                </div>
                            </div>
                            <div class="row">
                                <div class="row col-md-6">
                                    <div class="col-md-6">
                                        <label for="price">Ücret:</label>
                                        <div class="row">
                                            <input type="text" class="form-control col-md-3" id="price" name="price"  value="" required>
                                            <select name="priceType" id="priceType" class="form-control col-md-3">
                                                <option value="TRY">TRY</option>
                                                <option value="EUR">EUR</option>
                                                <option value="TRY">TRY</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="float: right;">
                                <button class="btn btn-primary" type="button"
                                    onclick="editSubmitForm()">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>

            $(".js-seelct-multiple").select2({});

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
