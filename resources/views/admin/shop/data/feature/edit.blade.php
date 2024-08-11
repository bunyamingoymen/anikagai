@extends('admin.layouts.main')
@section('admin_content')
@php
    use Illuminate\Support\Facades\Route;

    $currentRouteName = Route::currentRouteName();

    $auth = $currentRouteName == 'admin_shop_category_create' ? $create : $update;
@endphp
    @if ($auth == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <form class="needs-validation" id="EditForm" action="{{ route('admin_shop_feature_save') }}"
                            method="POST">
                            @csrf

                            @isset($item)
                                <div hidden>
                                    <input type="text" class="form-control" id="code" name="code" value="{{$item->code ?? '' }}" required>
                                </div>
                            @endisset

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">Özellik İsmi:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="İsim" value="{{$item->name ?? ''}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="description">Açıklama:</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Açıklama">{{$item->description ?? ''}}</textarea>

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
            @if ($auth == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
