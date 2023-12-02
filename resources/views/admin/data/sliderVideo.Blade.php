@extends("admin.layouts.main")
@section('admin_content')
@if ($sliderVideoData == 1)
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @foreach ($slider_images as $item)
                <form class="needs-validation" id="sliderVideo{{$item->code}}" action="" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div hidden>
                        <input type="text" name="slider_image_code" value="{{$item->code}}">
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3 mt-4">
                            <div>
                                <p>Kaydet butonuna basıldığında video kaydedilmeye başlanacaktır. Lütfen tamamlanmadan
                                    sayfayı kapatmayınız.</p>
                            </div>
                            <div class="progress" style="height: 15px;">
                                <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated"
                                    role="progressbar" id="progress-bar-video{{$item->code}}" style="width: 25%;"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    <span id="percentValue{{$item->code}}">Yüklenme
                                        Başlamadı</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <img src="../../../{{$item->optional}}" alt="" style="max-height: 150px;">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Bölüm(Video):</label>
                            <small>Sadece video dosyası kabul edilmektedir.</small>
                            <input type="file" class="form-control" id="video{{$item->code}}" name="video"
                                placeholder="Dosya Seçiniz" accept="video/*" required>
                        </div>
                    </div>
                    <div style="">
                        <button class="btn btn-primary" type="button"
                            onclick="sliderVideoSubmit('{{$item->code}}')">Kaydet</button>
                    </div>
                </form>
                <hr>
                @endforeach

            </div>
        </div>
    </div>
</div>
<script>
    function sliderVideoSubmit(slider_video_code){
        var video = document.getElementById('video'+slider_video_code).value;

        if(video == ""){
            Swal.fire({
                icon: 'error',
                title: 'Hata',
                text: 'Lütfen Gerekli Doldurunuz!',
            })
        }else{
            var formData = new FormData(document.getElementById('sliderVideo'+slider_video_code));

            Swal.fire({
                title: "Yükleniyor..!",
                text: "Video Yüklenmeye Başladı. Lütfen Tamamlanana kadar bu sayfayı kapatmayınız!",
                icon: "warning"
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: '{{route("admin_data_slider_video")}}', // Dosya yüklemeyi işleyen PHP dosyanızın yolunu belirtin.
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function () {
                    var xhr = new XMLHttpRequest();

                    // İlerleme olayını dinle
                    xhr.upload.addEventListener('progress', function (e) {
                        if (e.lengthComputable) {
                            var percent = (e.loaded / e.total) * 100;
                            document.getElementById('percentValue'+slider_video_code).innerText = parseInt(percent) + "%"
                            document.getElementById('progress-bar-video'+slider_video_code).style.width = percent + "%"

                            document.getElementById('progress-bar-video'+slider_video_code).setAttribute("aria-valuenow", percent);
                        }
                    }, false);

                    return xhr;
                },
                success: function (response) {
                // Yükleme tamamlandığında yapılacak işlemler
                //console.log(response);
                    Swal.fire({
                        title: "Başarılı",
                        text: "Video Başarılı Bir Şekilde Yüklendi. Sayfayı Kapatabilirsiniz.",
                        icon: "success"
                    });

                    document.getElementById('percentValue'+slider_video_code).innerText = "Tamamlandı"
                },
                error: function (error) {
                // Hata durumunda yapılacak işlemler
                //console.log(error);
                    Swal.fire({
                        title: "Error",
                        text: "Video yüklenirken bir hata meydana geldi.",
                        icon: "error"
                    });

                    document.getElementById('percentValue'+slider_video_code).innerText = "Hata"
                    console.log('hata: ' + JSON.stringify(error));
                }
            });
        }
    }
</script>
@endif
<script>
    // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
    window.addEventListener('DOMContentLoaded', (event) => {
        // Değişkenin değerini kontrol et
        @if ($sliderVideoData == 0)
            // Değişken doğru ise yönlendirme yap
            window.location.href = '{{route("admin_index")}}';
        @endif
    });
</script>
@endsection