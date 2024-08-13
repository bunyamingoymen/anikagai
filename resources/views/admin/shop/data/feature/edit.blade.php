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
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="feature_type">Özellik Tipi: </label>
                                    <select class="form-control" name="feature_type" id="feature_type" onchange="changeFeatureType()">
                                        <option value="0">Yazı</option>
                                        <option value="1">Çoktan Seçmeli</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3" id="feature_type_multiple_id" hidden>
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
                } else if(document.getElementById('feature_type').value == 1 && document.getElementById('multiple_choose_1') &&! document.getElementById('multiple_choose_1').value){
                    Swal.fire({
                        title: "Hata",
                        text: "Lütfen En az bir seçenek giriniz.",
                        icon: "error"
                    });
                }else{
                    document.getElementById('EditForm').submit();
                }

            }

            function changeFeatureType() {
                var value = document.getElementById('feature_type').value;
                if (value == 1) {
                    var html = `
                        <div class="row mb-3">
                            <label>Çoktan Seçmeli Seçenekler:</label>
                        </div>
                        <div id="feature_type_multiple_choose">
                            <div class="row mb-3 feature_type_multiple_chooses_div" id="feature_type_multiple_choose_1">
                                <button type="button" class="btn btn-danger" id="feature_type_multiple_choose_count_1">1</button>
                                <div class="m-1 mr-3 ml-3">
                                    <input type="text" class="form-control feature_type_multiple_chooses" name="multiple_choose[]" id="multiple_choose_1" placeholder="1. seçenek" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3" id="feature_type_multiple_choose_button">
                            <button type="button" class="btn btn-info" onclick="addNewChoose(2)"> + Yeni Seçenek Ekle</button>
                        </div>`;
                    document.getElementById('feature_type_multiple_id').hidden = false;
                    document.getElementById('feature_type_multiple_id').innerHTML = html;
                } else {
                    document.getElementById('feature_type_multiple_id').hidden = true;
                    document.getElementById('feature_type_multiple_id').innerHTML = '';
                }
            }

            function addNewChoose(id) {
                var feature_type_multiple_chooses = document.getElementsByClassName('feature_type_multiple_chooses');
                var chooses = [];
                for(var i = 0; i < feature_type_multiple_chooses.length; i++){
                    chooses[i] = feature_type_multiple_chooses[i].value;
                }
                var html = `
                    <div class="row mb-3 feature_type_multiple_chooses_div" id="feature_type_multiple_choose_${id}">
                        <button type="button" class="btn btn-danger" id="feature_type_multiple_choose_count_${id}">${id}</button>
                        <div class="m-1 mr-3 ml-3">
                            <input type="text" class="form-control feature_type_multiple_chooses" name="multiple_choose[]" id="multiple_choose_${id}" placeholder="${id}. seçenek" required>
                        </div>
                        <div class="m-1 mr-3 ml-1">
                            <button type="button" class="btn btn-warning" id="delete_button_${id}" onclick="deleteChoose(${id})"><i class="fas fa-trash-alt"></i> Sil</button>
                        </div>
                    </div>`;
                document.getElementById('feature_type_multiple_choose').innerHTML += html;

                // Add new button for adding more options
                var button_html = `<button type="button" class="btn btn-info" onclick="addNewChoose(${id + 1})"> + Yeni Seçenek Ekle</button>`;
                document.getElementById('feature_type_multiple_choose_button').innerHTML = button_html;

                var feature_type_multiple_chooses_after = document.getElementsByClassName('feature_type_multiple_chooses');
                for(var i = 0; i < chooses.length; i++){
                    feature_type_multiple_chooses_after[i].value = chooses[i];
                }
            }

            function deleteChoose(id) {
                if (id <= 1) return; // 1. seçenek silinemez

                var count = document.getElementsByClassName('feature_type_multiple_chooses_div').length;
                document.getElementById('feature_type_multiple_choose_' + id).remove();

                // ID ve diğer bilgileri güncelle
                for (var i = id + 1; i <= count; i++) {
                    var new_value = i - 1;

                    var div = document.getElementById('feature_type_multiple_choose_' + i);
                    div.id = 'feature_type_multiple_choose_' + new_value;

                    var count_button = document.getElementById('feature_type_multiple_choose_count_' + i);
                    count_button.id = 'feature_type_multiple_choose_count_' + new_value;
                    count_button.innerText = new_value;

                    var input = document.getElementById('multiple_choose_' + i);
                    input.id = 'multiple_choose_' + new_value;
                    input.placeholder = new_value + '. seçenek';

                    var delete_button = document.getElementById('delete_button_' + i);
                    delete_button.id = 'delete_button_' + new_value;
                    delete_button.setAttribute('onclick', 'deleteChoose(' + new_value + ')');
                }

                // Yeni seçenek ekleme butonunu güncelle
                var button_html = `<button type="button" class="btn btn-info" onclick="addNewChoose(${count})"> + Yeni Seçenek Ekle</button>`;
                document.getElementById('feature_type_multiple_choose_button').innerHTML = button_html;
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
