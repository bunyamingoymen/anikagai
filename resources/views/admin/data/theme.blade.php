@extends('admin.layouts.main')
@section('admin_content')
    @if ($changeThemeSettings == 1)
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.css"
            integrity="sha512-HcfKB3Y0Dvf+k1XOwAD6d0LXRFpCnwsapllBQIvvLtO2KMTa0nI5MtuTv3DuawpsiA0ztTeu690DnMux/SuXJQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-3">
                            <h4>Tema Renkleri: </h4>
                            <p>Tema renklerini buradan değiştirebilirsniz.</p>
                            <div class="col-lg-8">
                                @if ($colorOne)
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label for="">1.Renk:</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="color" id="colorpickerColorOne" name="color"
                                                class="form-control" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                                value="{{ '#' . $colorOne->setting_value }}">
                                        </div>

                                        <div class="col-lg-3">
                                            <input type="text" class="form-control"
                                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                                value="{{ '#' . $colorOne->setting_value }}" id="hexcolorColorOne"></input>
                                        </div>

                                        <div class="col-lg-4">
                                            <button class="btn btn-info" onclick="defaultColor('one')">Varsayılan Olarak
                                                Renk Ayarla</button>
                                        </div>
                                    </div>
                                @endif

                                @if ($colorTwo)
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label for="">2.Renk:</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="color" id="colorpickerColorTwo" name="color"
                                                class="form-control" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                                value="{{ '#' . $colorTwo->setting_value }}">
                                        </div>

                                        <div class="col-lg-3">
                                            <input type="text" class="form-control"
                                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                                value="{{ '#' . $colorTwo->setting_value }}" id="hexcolorColorTwo"></input>
                                        </div>

                                        <div class="col-lg-4">
                                            <button class="btn btn-info" onclick="defaultColor('two')">Varsayılan Olarak
                                                Renk Ayarla</button>
                                        </div>
                                    </div>
                                @endif

                                @if ($colorThree)
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label for="">1.Renk:</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="color" id="colorpickerColorThree" name="color"
                                                class="form-control" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                                value="{{ '#' . $colorThree->setting_value }}">
                                        </div>

                                        <div class="col-lg-3">
                                            <input type="text" class="form-control"
                                                pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                                value="{{ '#' . $colorThree->setting_value }}"
                                                id="hexcolorColorThree"></input>
                                        </div>

                                        <div class="col-lg-4">
                                            <button class="btn btn-info">Varsayılan Olarak Renk Ayarla</button>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-lg-2 mt-3 float-right">
                                    <button class="btn btn-primary" onclick="changeColorSubmitButton()">Değiştir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="../../../admin/assets/libs/jquery/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js"
            integrity="sha512-94dgCw8xWrVcgkmOc2fwKjO4dqy/X3q7IjFru6MHJKeaAzCvhkVtOS6S+co+RbcZvvPBngLzuVMApmxkuWZGwQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $('#colorpickerColorOne').on('input', function() {
                $('#hexcolorColorOne').val(this.value);
            });
            $('#hexcolorColorOne').on('input', function() {
                $('#colorpickerColorOne').val(this.value);
            });

            $('#colorpickerColorTwo').on('input', function() {
                $('#hexcolorColorTwo').val(this.value);
            });
            $('#hexcolorColorTw').on('input', function() {
                $('#colorpickerColorTwo').val(this.value);
            });

            $('#colorpickerColorThree').on('input', function() {
                $('#hexcolorColorThree').val(this.value);
            });
            $('#hexcolorColorThree').on('input', function() {
                $('#colorpickerColorThree').val(this.value);
            });

            function defaultColor(clickColor) {
                if (clickColor == 'one') {
                    $('#hexcolorColorOne').val('#14161D');
                    $('#colorpickerColorOne').val('#14161D');
                } else if (clickColor == 'two') {
                    $('#hexcolorColorTwo').val('#111216');
                    $('#colorpickerColorTwo').val('#111216');
                }
            }

            function changeColorSubmitButton() {
                var html = ` <form id="changeColorFormID" action="{{ route('admin_data_change_theme_color') }}" method="POST">
                                @csrf

                            `
                var colorOne = document.getElementById('hexcolorColorOne');
                var colorTwo = document.getElementById('hexcolorColorTwo');
                var colorThree = document.getElementById('hexcolorColorOne');

                if (colorOne) {
                    html += `<input type="text" id="colorOne" name="colorOne" value="` + colorOne.value.replace('#', '') + `">`;
                }

                if (colorTwo) {
                    html += `<input type="text" id="colorTwo" name="colorTwo" value="` + colorTwo.value.replace('#', '') + `">`
                }

                if (colorThree) {
                    html += `<input type="text" id="colorThree" name="colorThree" value="` + colorThree.value.replace('#', '') +
                        `">`
                }

                html += `</form>`

                document.getElementById('hiddenDiv').innerHTML = html;
                document.getElementById('changeColorFormID').submit();
            }
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if ($changeThemeSettings == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
