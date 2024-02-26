@extends('admin.layouts.main')
@section('admin_content')
    @if ($homeData == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <p>Sitede gözüken bütün logo ve ikonları buradan değiştirebilirsiniz.</p>
                        <hr>
                        <p>Sitenin Teması:</p>
                        <form action="{{ route('admin_data_home') }}" method="POST">
                            @csrf
                            <div class="row">
                                @foreach ($themes as $item)
                                    <div class="form-check m-2">
                                        <div class="">
                                            @if ($selected_theme->value == $item->code)
                                                <input class="form-check-input" type="radio" name="selected_theme"
                                                    id="flexRadioDefault{{ $loop->index }}" value={{ $item->code }}
                                                    checked>
                                            @else
                                                <input class="form-check-input" type="radio" name="selected_theme"
                                                    id="flexRadioDefault{{ $loop->index }}" value={{ $item->code }}>
                                            @endif

                                            <label class="form-check-label" for="flexRadioDefault{{ $loop->index }}">
                                                <img src="{{ url($item->images) }}" alt=""
                                                    style="max-height: 150px;">
                                                <h4 class="text-center">{{ $item->themeName }}</h4>
                                            </label>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Kaydet</button>
                            </div>
                        </form>

                        <hr>
                        <p>Tema Ayarları:</p>
                        <div class="mt-5 col-lg-12">
                            <form action="{{ route('admin_data_show_content') }}" id="admin_data_show_contentForm"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="">Anime Görünürlük: </label>
                                        <select name="animeShow" id="animeShow" class="form-control">
                                            @if ($animeActive->value == 1)
                                                <option value="1" selected>Görünür</option>
                                                <option value="0">Görünmez</option>
                                            @else
                                                <option value="1">Görünür</option>
                                                <option value="0" selected>Görünmez</option>
                                            @endif

                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Webtoon Görünürlük: </label>
                                        <select name="webtoonShow" id="webtoonShow" class="form-control">
                                            @if ($webtoonActive->value == 1)
                                                <option value="1" selected>Görünür</option>
                                                <option value="0">Görünmez</option>
                                            @else
                                                <option value="1">Görünür</option>
                                                <option value="0" selected>Görünmez</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary" type="submit">Kaydet</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="mt-5 col-lg-12">
                            <form action="{{ route('admin_data_change_theme_settings') }}"
                                id="admin_data_change_theme_settingsForm" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mt-3">
                                        <label for="">Listelemede Görünecek Sayı: </label>
                                        <input type="number" class="form-control" id="listCount" name="listCount"
                                            value="{{ $listCount->setting_value }}">
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <label for="">Slider Görünürlük durumu: </label>
                                        <select name="sliderShow" id="sliderShow" class="form-control">
                                            @if ($sliderShow->setting_value == 1)
                                                <option value="1" selected>Görünür</option>
                                                <option value="0">Görünmez</option>
                                            @else
                                                <option value="1">Görünür</option>
                                                <option value="0" selected>Görünmez</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary" style="" type="submit">Kaydet</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="mt-5 col-lg-12">

                            <div class="col-lg-12">
                                <div>
                                    <label for="">Slider'daki veriler: </label>
                                </div>
                                <div class="">
                                    <button class="btn btn-primary" onclick="addSlider()">+ Yeni Slider Ekle</button>
                                </div>
                                <div id="sliderImages">
                                    @foreach ($slider_images as $item)
                                        <div class="mt-5">
                                            <form action="{{ route('admin_data_change_slider_images') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="">
                                                        <p>{{ $loop->index + 1 }} - </p>
                                                    </div>
                                                    <div hidden>
                                                        <input type="text" name="code" id="code"
                                                            value="{{ $item->code }}">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <img src="{{ url($item->optional) }}" alt=""
                                                            style="height: 100px;">
                                                    </div>
                                                    <div class="col-lg-8 ">
                                                        <div class="row col-lg-12">
                                                            <div class="col-lg-6">
                                                                <label for="">Yazı:</label>
                                                                <input type="text" class="form-control" name="value"
                                                                    id="value" value="{{ $item->value }}">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label for="">Link:</label>
                                                                <input type="text" class="form-control"
                                                                    name="optional_2" id="optional_2"
                                                                    value="{{ $item->optional_2 }}">
                                                            </div>
                                                        </div>
                                                        <div class="row col-lg-12 mt-2">
                                                            <div class="col-lg-6">
                                                                <label for="">Etiket:</label>
                                                                <input type="text" class="form-control"
                                                                    name="optional_3" id="optional_3"
                                                                    value="{{ $slider_images_alt->Where('value', $item->code)->first()->optional ?? '' }}">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label for="">Açıklama:</label>
                                                                <textarea name="optional_4" id="optional_4" class="form-control" cols="10" rows="3">{{ $slider_images_alt->Where('value', $item->code)->first()->optional_2 ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 mt-3">
                                                        <button class="btn btn-danger float-right ml-2 mr-2"
                                                            type="button"
                                                            onclick="deleteSlider('{{ $item->code }}')">Sil</button>
                                                        <button class="btn btn-primary float-right ml-2 mr-2"
                                                            type="submit">Değiştir</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
            var count = "{{ count($slider_images) }}"

            function deleteSlider(code) {
                Swal.fire({
                    title: 'Emin Misin?',
                    text: 'Bu Veriyi Silmek İstiyor musunuz(ID: ' + code + ')?',
                    icon: 'warning',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Onayla',
                    denyButtonText: `Vazgeç`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        var html =
                            `<form action='{{ route('admin_data_delete_slider_images') }}' method="POST" id="deleteSliderForm"> @csrf`;
                        html += `<input type="text" name="code" value='` + code + `'>`;
                        html += `</form>`

                        document.getElementById('hiddenDiv').innerHTML = html;

                        document.getElementById('deleteSliderForm').submit();
                    }
                })
            }

            function addSlider() {
                count++;
                var html = `<div class="mt-5" id="newSlider${count}">
            <form action="{{ route('admin_data_add_slider_images') }}" id="adminDataAddSliderImagesForm${count}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="">
                        <p>${count} - </p>
                    </div>
                    <div class="col-lg-3">
                        <input type="file" name="slider_image" id="add_slider_slider_image${count}" class="form-control">
                    </div>
                    <div class="col-lg-8 ">
                        <div class="row col-lg-12">
                            <div class="col-lg-6">
                                <label for="">Yazı:</label>
                                <input type="text" class="form-control" name="value" id="add_slider_value${count}" value="">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Link:</label>
                                <input type="text" class="form-control" name="optional_2" id="add_slider_optional_2${count}" value="" >
                            </div>
                        </div>
                        <div class="row col-lg-12 mt-2">
                            <div class="col-lg-6">
                                <label for="">Etiket:</label>
                                <input type="text" class="form-control"
                                    name="optional_3" id="add_slider_optional_3${count}"
                                    value="">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Açıklama:</label>
                                <textarea name="optional_4" id="add_slider_optional_4${count}" class="form-control" cols="10" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <button class="btn btn-danger float-right ml-2 mr-2"
                            type="button" onclick="deleteHTML('newSlider${count}')">Sil</button>
                        <button class="btn btn-primary float-right ml-2 mr-2"
                            type="button" onclick="addSliderFormSubmit(${count})">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>`;

                document.getElementById('sliderImages').innerHTML += html;


            }

            function addSliderFormSubmit(count) {
                var image = document.getElementById('add_slider_slider_image' + count).value;
                var value = document.getElementById('add_slider_value' + count).value;
                var optional2 = document.getElementById('add_slider_optional_2' + count).value;

                if (image == "" || value == "") {
                    Swal.fire({
                        title: "Hata",
                        text: "Lütfen Gerekli Yerleri Doldurunuz.",
                        icon: "error"
                    });
                } else {
                    document.getElementById('adminDataAddSliderImagesForm' + count).submit();
                }
            }

            function deleteHTML(htmlID) {
                document.getElementById(htmlID).remove();
            }

            function admin_data_change_theme_settings() {
                document.getElementById('admin_data_change_theme_settingsForm').submit();
            }
        </script>
    @endif

    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if ($homeData == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>


@endsection
