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
                        method="POST">
                            @csrf
                            @isset($item)
                                <div hidden>
                                    <input type="text" class="form-control" id="code" name="code" value="{{$item->code ?? '' }}" required>
                                </div>
                            @endisset
                            <!-- Tab panes -->
                            <div class="tab-content p-3">
                                <div class="tab-pane active" id="general-information" role="tabpanel">
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
                                        <div class="row col-md-12">
                                            <div class="col-md-6">
                                                <label for="price">Ücret:</label>
                                                <div class="row">
                                                    <input type="number" class="form-control col-md-3" id="price" name="price"  value="" required>
                                                    <select name="priceType" id="priceType" class="form-control col-md-3 ml-1">
                                                        <option value="TRY">TRY</option>
                                                        <option value="EUR">EUR</option>
                                                        <option value="USD">USD</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div>
                                        <button class="btn btn-primary float-right" type="button" onclick="document.getElementById('category-features-button-id').click()"> <i class="dripicons-chevron-right"></i> İleri </button>
                                    </div>
                                </div>


                                <div class="tab-pane" id="category-features" role="tabpanel">
                                    <div class="mt-3 mb-5">
                                        <label for="selectCategory">Kategoriler:</label>
                                        <select name="selectCategory" id="selectCategory" style="width: 100%;" onchange="changeSelectCategory()" multiple >
                                        </select>
                                    </div>
                                    <div class="mt-5" id="allFeaturesDiv">
                                        <div class="mt-4 mt-lg-0">
                                            <h5 class="font-size-14 mb-3">Inline Radios</h5>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadios" id="inlineRadios1" value="option1" checked="">
                                                <label class="form-check-label" for="inlineRadios1">
                                                    Inline Radio 1
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadios" id="inlineRadios2" value="option2">
                                                <label class="form-check-label" for="inlineRadios2">
                                                    Inline Radio 2
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-primary" type="button" onclick="document.getElementById('general-information-button-id').click()"> <i class="dripicons-chevron-left"></i> Geri </button>
                                        <button class="btn btn-primary float-right" type="button" onclick="document.getElementById('images-videos-button-id').click()"> <i class="dripicons-chevron-right"></i> İleri </button>
                                    </div>
                                </div>


                                <div class="tab-pane" id="images-videos" role="tabpanel">
                                    <div>
                                        <button class="btn btn-primary" type="button" onclick="document.getElementById('category-features-button-id').click()"> <i class="dripicons-chevron-left"></i> Geri </button>
                                        <button class="btn btn-primary float-right" type="button" onclick="document.getElementById('other-settings-button-id').click()"> <i class="dripicons-chevron-right"></i> İleri </button>
                                    </div>
                                </div>


                                <div class="tab-pane" id="other-settings" role="tabpanel">
                                    <div>
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

        <!-- Select2 ve kategori ayarları -->
        <script>
            function changeSelectCategory(){
                // Select elementini al
                const selectElement = document.getElementById('selectCategory');

                // Seçilen tüm değerleri almak için boş bir dizi oluştur
                const selectedValues = [];

                // Seçilen option öğelerini bul ve değerlerini diziye ekle
                for (const option of selectElement.options) {
                    if (option.selected) {
                        selectedValues.push(option.value);
                    }
                }

                var pageData = {
                    page: 1,
                    showingCount: 100,
                    category_codes: selectedValues,
                }
                if(selectedValues.length>0){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('admin_shop_feature_get_data') }}',
                            data: pageData,
                            success: function(response) {
                                var items = response.items;
                                var page_count = response.page_count;
                                var key_values = Object.values(response.key_values.items);
                                var html = ``;
                                for (let i = 0; i < items.length; i++) {
                                    var keyValues = key_values.filter(value=> value.optional === items[i].code);
                                    if(keyValues.length>0){
                                        html += `
                                            <div class="mt-3">
                                                <label for="">${items[i].name}</label>
                                                <div class="mt-4 mt-lg-0">
                                                    `

                                        keyValues.forEach(element => {
                                            html += `<div class="form-check form-check-inline">
                                                        <input class="form-check-input features_inputs" type="radio" name="features['${items[i].code}']" id="${element.code}" value="${element.code}" checked="">
                                                        <label class="form-check-label" for="${element.code}">
                                                            ${element.value}
                                                        </label>
                                                    </div>
                                            `
                                        });

                                        html += `
                                                </div>
                                            </div>
                                        `
                                    }else{
                                        html += `<div class="mt-3">
                                                        <label for="${items[i].code}">${items[i].name}</label>
                                                        <input type="text" id="${items[i].code}" name="features['${items[i].code}']" class="form-control features_inputs" placeholder="Bir değer giriniz">
                                                </div>
                                                `
                                    }

                                }

                                document.getElementById('allFeaturesDiv').innerHTML = html;

                            }
                        });
                }
            }


            $(document).ready(function() {
                $('#selectCategory').select2({
                    ajax: {
                        url: '{{ route('admin_shop_category_get_data') }}', // Laravel controller endpoint'iniz
                        dataType: 'json',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token'ı ekle
                        },
                        data: function(params) {
                            return {
                                search: params.term,
                                page: 1,
                                // Diğer parametreleri burada ekleyebilirsiniz
                            };
                        },
                        processResults: function(response) {
                            return {
                                results: $.map(response.items, function(item) {
                                    return {
                                        id: item.code,
                                        name: item.name,
                                        // Diğer alanları burada ekleyebilirsiniz
                                    };
                                }),
                                pagination: {
                                    more: response.page_count > 1 // Eğer daha fazla sayfa varsa true döndürün
                                }
                            };
                        },
                        cache: true
                    },
                    placeholder: 'Kategori Ara...',
                    minimumInputLength: 3, // Minimum giriş uzunluğu
                    escapeMarkup: function(markup) {
                        return markup;
                    }, // Markdown işlemlerini önlemek için
                    templateResult: formatResult, // Sonuçları özelleştirmek için
                    templateSelection: formatResult, // Seçili öğeyi özelleştirmek için
                })

                function formatResult(item) {
                    return item.name;
                }
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
