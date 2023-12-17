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
                            @if ($colors_code)
                                <h4>Tema Renkleri: </h4>
                                <p>Tema renklerini buradan değiştirebilirsniz.</p>
                                <div class="col-lg-8">
                                    @foreach ($colors_code as $item)
                                        <div class="row mt-3">
                                            <div class="col-lg-2">
                                                <label for="">{{ $loop->index + 1 }}.Renk:</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="color" id="colorpicker{{ $loop->index }}" name="color"
                                                    class="form-control" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                                    value="{{ '#' . $item->setting_value }}">
                                            </div>

                                            <div class="col-lg-3">
                                                <input type="text" class="form-control hexcolors"
                                                    pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                                    value="{{ '#' . $item->setting_value }}"
                                                    id="hexcolor{{ $loop->index }}"></input>
                                            </div>

                                            <div class="col-lg-4">
                                                <button class="btn btn-info"
                                                    onclick="defaultColor({{ $loop->index }})">Varsayılan Olarak
                                                    Renk Ayarla</button>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="col-lg-2 mt-3 float-right">
                                        <button class="btn btn-primary"
                                            onclick="changeColorSubmitButton()">Değiştir</button>
                                    </div>
                                </div>
                            @endif
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
            @foreach ($colors_code as $item)
                $('#colorpicker{{ $loop->index }}').on('input', function() {
                    $('#hexcolor{{ $loop->index }}').val(this.value);
                });
            @endforeach

            function defaultColor(color_number) {

                var defaultValue = @json($colors_code_defaults->nth(1));

                $('#hexcolor' + color_number).val(
                    '#' + (defaultValue[color_number] ? defaultValue[color_number].setting_value : 'fff')
                );

                $('#colorpicker' + color_number).val(
                    '#' + (defaultValue[color_number] ? defaultValue[color_number].setting_value : 'fff')
                );
            }

            function changeColorSubmitButton() {
                var html = ` <form id="changeColorFormID" action="{{ route('admin_data_change_theme_color') }}" method="POST">
                                @csrf
                                <select name="colors[]" id="" multiple>
                            `

                var colors = document.getElementsByClassName('hexcolors');

                for (let i = 0; i < colors.length; i++) {
                    const element = colors[i].value.replace('#', '');
                    html += `<option value="` + element + `" selected></option>`;
                }

                html += `</select></form>`

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
