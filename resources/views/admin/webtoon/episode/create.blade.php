@extends('admin.layouts.main')
@section('admin_content')
    @if ($create == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <form class="needs-validation" id="webtoonEpisodeCreateForm" action="" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-4">
                                    <div class="progress" style="height: 30px;">
                                        <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated"
                                            role="progressbar" id="progress-bar-video" style="width: 100%;"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"> <span
                                                id="percentValue">Yüklenme
                                                Başlamadı</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="webtoon_code">Webtoon:</label>
                                    <select name="webtoon_code" id="webtoon_code" class="form-control"
                                        onchange="getSeason();" required>
                                        @foreach ($webtoons as $webtoon)
                                            <option value="{{ $webtoon->code }}">{{ $webtoon->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="name">Bölüm Adı:</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="season_short">Bulunduğu Sezon:</label>
                                    <select name="season_short" id="season_short" class="form-control">
                                        @for ($i = 1; $i <= $webtoons->first()->season_count + 1; $i++)
                                            <option value="{{ $i }}">{{ $i }}.sezon</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="episode_short">Bölüm Sırası:</label>
                                    <input type="number" id="episode_short" name="episode_short" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="publish_date">Yayınlanma Tarihi:</label>
                                    <input type="date" id="publish_date" name="publish_date" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03">Açıklama:</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Açıklama"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <div>
                                    <h4><strong>Bölüm Dosyaları</strong></h4>
                                </div>
                                <div hidden>
                                    <input type="number" name="totalFileCount" id="totalFileCount" value="1">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Webtoon Dosya Tipi:</label>
                                    <small>Yüklemek istediğiniz dosya tipini giriniz..</small>
                                    <select class="form-control" name="fileTypeSelect" id="fileTypeSelect"
                                        onchange="changeFileType()">
                                        <option value="pdf" selected>PDF</option>
                                        <option value="image">Resim</option>
                                        <option value="zip">Zip (Toplu Resim)</option>
                                    </select>
                                </div>

                                <div class="col-lg-6" id="uploadPdfFileDiv">
                                    <label for="">PDF Dosyasını Seçiniz:</label>
                                    <div class="row">
                                        <a class="btn btn-danger" style="color: #fff;">1</a>
                                        <div class="col-lg-10">
                                            <input type="file" class="form-control" id="pdf" name="pdf"
                                                placeholder="Dosya Seçiniz" accept=".pdf" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8" id="uploadImageFileDiv" hidden>
                                    <label for="">Resim / Resimleri Seçiniz:</label>
                                    <div class="mt-2" id="imageFormDiv">
                                        <div class="row" id="imageInput1Div">
                                            <a class="btn btn-danger" style="color: #fff;" id="imageInputButtonATag1">1</a>
                                            <div class="col-lg-6">
                                                <label id="imageFileLabel1" for="imageFile1">Resim:</label>
                                                <input type="file" class="form-control" id="imageFile1"
                                                    name="imageFile1" placeholder="Dosya Seçiniz" accept="image/*"
                                                    required>
                                            </div>
                                            <div class="col-lg-2">
                                                <label id="imageShortLabel1" for="imageShort1">Sıra:</label>
                                                <input type="number" id="imageShort1" class="form-control"
                                                    name="imageShort1" value="1">
                                            </div>
                                        </div>
                                        <hr id="imageInputHR1">
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-info" type="button" onclick="addImageInput()">+ Bir Resim
                                            Daha
                                            Ekleyin</button>
                                    </div>

                                </div>

                                <div class="col-lg-8" id="uploadZipFileDiv" hidden>
                                    <div class="row">
                                        <a class="btn btn-danger" style="color: #fff;">1</a>
                                        <div class="col-lg-10">
                                            <label for="zipFile">Zip Dosyasını Seçiniz:</label>
                                            <input type="file" class="form-control" id="zipFile" name="zipFile"
                                                placeholder="Dosya Seçiniz" accept=".zip" required>
                                            <br>
                                            <small>Sadece zip dosyası kabul edilmektedir. Rar ve türevleri kabul
                                                edilmemektedir.</small>
                                            <br>
                                            <small>Zip içinde dosya isimleri sıralı bir şekilde olmak zorundadır.(Örn:
                                                1.jpg,
                                                2.jpg)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="float: right;">
                                <button class="btn btn-primary" type="button" onclick="webtoonEpisodeCreateFormSubmit()"
                                    id="webtoonEpisodeCreateSubmitButton">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dosya Tipi İşlemleri -->
        <script>
            var totalFile = 1;

            function changeFileType() {
                var value = document.getElementById("fileTypeSelect").value;
                if (value === "pdf") {
                    document.getElementById('uploadPdfFileDiv').hidden = false;

                    document.getElementById('uploadZipFileDiv').hidden = true;
                    document.getElementById('uploadImageFileDiv').hidden = true;
                } else if (value === "image") {
                    document.getElementById('uploadImageFileDiv').hidden = false;

                    document.getElementById('uploadZipFileDiv').hidden = true;
                    document.getElementById('uploadPdfFileDiv').hidden = true;
                } else {
                    document.getElementById('uploadZipFileDiv').hidden = false;

                    document.getElementById('uploadImageFileDiv').hidden = true;
                    document.getElementById('uploadPdfFileDiv').hidden = true;
                }
            }

            function addImageInput() {
                totalFile++;
                var html = `<div class="row mt-3" id="imageInput` + totalFile + `Div">
            <a class="btn btn-danger" style="color: #fff;" id="imageInputButtonATag` + totalFile + `">` + totalFile + `</a>
            <div class="col-lg-6">
                <label id="imageFileLabel` + totalFile + `" for="imageFile` + totalFile + `">Resim:</label>
                <input type="file" class="form-control" id="imageFile` + totalFile + `" name="imageFile` + totalFile + `" placeholder="Dosya Seçiniz" accept="image/*"
                    required>
            </div>
            <div class="col-lg-2">
                <label id="imageShortLabel` + totalFile + `" for="imageShort` + totalFile + `">Sıra:</label>
                <input type="number" class="form-control" id="imageShort` + totalFile + `" name="imageShort` +
                    totalFile + `" value="` + totalFile + `">
            </div>
            <div class=" col-lg-2">
                <label for="">Sil:</label>
                <div>
                    <button class="btn btn-warning" type="button" id="removeImageInputButton` + totalFile +
                    `" onclick="removeImageInput('` + totalFile + `');"> <i class="far fa-trash-alt"></i>
                         Sil</button>
                </div>
            </div>
        </div>
        <hr id="imageInputHR` + totalFile + `">`;
                document.getElementById('imageFormDiv').innerHTML += html;
            }

            function removeImageInput(input_code) {

                document.getElementById("imageInput" + input_code + "Div").remove();
                document.getElementById("imageInputHR" + input_code).remove();
                if (input_code != totalFile) {
                    for (let i = parseInt(input_code) + 1; i <= parseInt(totalFile); i++) {
                        console.log(i + " ------------------------------------------------------- " + i);
                        var newOrder = i - 1;
                        //Ana div değişikliği yapılıyor
                        document.getElementById("imageInput" + i + "Div").id = "imageInput" + newOrder + "Div";

                        //yanında sırayı yazan kırmızı buton ayarlanıyor.
                        document.getElementById("imageInputButtonATag" + i).innerText = newOrder; //içerik
                        document.getElementById("imageInputButtonATag" + i).id = "imageInputButtonATag" + newOrder; //id değeri

                        //dosya alınan input değerinin label etiketi ayarlanıyor:
                        document.getElementById("imageFileLabel" + i).htmlFor = "imageFile" + newOrder;
                        document.getElementById("imageFileLabel" + i).id = "imageFileLabel" + newOrder;

                        //dosya alınan input değeri güncelleniyor:
                        document.getElementById("imageFile" + i).name = "imageFile" + newOrder;
                        document.getElementById("imageFile" + i).id = "imageFile" + newOrder;

                        //sıra numarasını belirten input değerinin label etiketi ayarlanıyor:
                        document.getElementById("imageShortLabel" + i).htmlFor = "imageShort" + newOrder;
                        document.getElementById("imageShortLabel" + i).id = "imageShortLabel" + newOrder;

                        //sıra numarasını belirten input değeri güncelleniyor:
                        document.getElementById("imageShort" + i).name = "imageShort" + newOrder;
                        document.getElementById("imageShort" + i).value = newOrder;
                        document.getElementById("imageShort" + i).id = "imageShort" + newOrder;

                        //sil butonu güncelleniyor:
                        document.getElementById("removeImageInputButton" + i).setAttribute("onClick", "removeImageInput(" +
                            newOrder + ");");
                        document.getElementById("removeImageInputButton" + i).id = "removeImageInputButton" + newOrder;

                        //hr güncelleniyor
                        document.getElementById("imageInputHR" + i).id = "imageInputHR" + newOrder;
                    }
                }
                totalFile--;
            }
        </script>

        <script>
            var is_submitted = false;

            function webtoonEpisodeCreateFormSubmit() {
                var name = document.getElementById('name').value;
                var season_short = document.getElementById('season_short').value;
                var episode_short = document.getElementById('episode_short').value;
                var publish_date = document.getElementById('publish_date').value;

                if (name == "" || season_short == "" || episode_short == "" || publish_date == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Lütfen Gerekli Doldurunuz!',
                    })
                } else if (!is_submitted) {

                    is_submitted = true;
                    document.getElementById("webtoonEpisodeCreateSubmitButton").disabled = true;
                    document.getElementById('totalFileCount').value = totalFile;
                    var formData = new FormData(document.getElementById('webtoonEpisodeCreateForm'));

                    Swal.fire({
                        title: "Yükleniyor..!",
                        text: "Webtoon Yüklenmeye Başladı. Lütfen Tamamlanana kadar bu sayfayı kapatmayınız!",
                        icon: "warning"
                    });

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.ajax({
                        url: '{{ route('admin_webtoon_episodes_create') }}', // Dosya yüklemeyi işleyen PHP dosyanızın yolunu belirtin.
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        xhr: function() {
                            var xhr = new XMLHttpRequest();

                            // İlerleme olayını dinle
                            xhr.upload.addEventListener('progress', function(e) {
                                if (e.lengthComputable) {
                                    var percent = (e.loaded / e.total) * 100;
                                    document.getElementById('percentValue').innerText = parseInt(percent) +
                                        "%"
                                    document.getElementById('progress-bar-video').style.width = percent +
                                        "%"

                                    document.getElementById('progress-bar-video').setAttribute(
                                        "aria-valuenow", percent);
                                }
                            }, false);

                            return xhr;
                        },
                        success: function(response) {
                            // Yükleme tamamlandığında yapılacak işlemler
                            console.log(response);
                            is_submitted = false;
                            document.getElementById("webtoonEpisodeCreateSubmitButton").disabled = false;
                            if (response.success) {
                                Swal.fire({
                                    title: "Başarılı",
                                    text: "Webtoon Başarılı Bir Şekilde Yüklendi. Sayfayı Kapatabilirsiniz.",
                                    icon: "success"
                                });

                                document.getElementById('percentValue').innerText = "Tamamlandı"
                            } else {
                                Swal.fire({
                                    title: "Hata",
                                    text: "Bir hata meydana geldi",
                                    icon: "error"
                                });

                                document.getElementById('percentValue').innerText = "Hata"
                            }


                            //console.log(response);
                        },
                        error: function(xhr, status, error) {
                            // Hata durumunda yapılacak işlemler
                            //console.log(error);
                            is_submitted = false;
                            document.getElementById("webtoonEpisodeCreateSubmitButton").disabled = false;
                            var error_message = "Webtoon yüklenirken bir hata meydana geldi"
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                error_message = xhr.responseJSON.message;
                            }
                            Swal.fire({
                                title: "Error",
                                text: error_message,
                                icon: "error"
                            });

                            document.getElementById('percentValue').innerText = "Hata"
                        }
                    });

                }

            }

            function getSeason() {
                var webtoon_code = document.getElementById('webtoon_code').value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_webtoon_get_season') }}',
                    data: {
                        code: webtoon_code
                    },
                    success: function(season) {
                        var code = ``;
                        //console.log(JSON.stringify(season.season_count));
                        for (let i = 1; i <= season.season_count + 1; i++) {
                            code += `<option value="${i}">${i}.sezon</option>`;
                        }

                        document.getElementById('season_short').innerHTML = code;
                    }
                });
            }
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if ($create == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
