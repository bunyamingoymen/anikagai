@extends('admin.layouts.main')
@section('admin_content')
    @if ($update == 1)
        <!-- Summernote css -->
        <link href="{{ url('admin/assets/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <form class="needs-validation" id="pageUpdateForm" action="{{ route('admin_page_update') }}"
                            method="POST">
                            @csrf
                            <div hidden>
                                <input type="text" name="code" value="{{ $page->code }}">
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">Sayfanın İsmi:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="name" value="{{ $page->name }}" required>
                                    <input type="text" class="form-control" id="short_name" name="short_name"
                                        placeholder="name" value="{{ $page->name }}" hidden required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="text">Sayfa İçeriği:</label>
                                    <div id="summernote">{!! $page->text !!}</div>
                                    <textarea class="form-control" name="text" id="text" cols="30" rows="10" placeholder="Sayfa İçeriği"
                                        hidden required>{{ $page->text }}</textarea>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="description">Açıklama:</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="3" placeholder="Açıklama">{{ $page->description }}</textarea>
                                    <small>Bu açıklama sadece yönetici panelinde görünebilir. Normal kullanıcılar burayı
                                        göremez</small>
                                </div>
                            </div>
                            <div style="float: right;">
                                <button class="btn btn-primary" type="button"
                                    onclick="createPageFormSubmit()">Kaydet</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{ url('admin/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ url('admin/assets/libs/summernote/summernote-bs4.min.js') }}"></script>

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

            function createPageFormSubmit() {
                document.getElementById('text').value = document.getElementsByClassName('note-editable')[0].innerHTML;

                var name = document.getElementById('name').value;

                var short_name = name.replace(/[ğĞüÜşŞıİöÖçÇ\s]/g, function(match) {
                    return match === ' ' ? '-' : match.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                });

                var text = document.getElementById('text').value
                var description = document.getElementById('description').value;

                if (name == "" || text == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Lütfen Gerekli Doldurunuz!',
                    })
                } else {
                    document.getElementById('code').value = "{{ $page->code }}";
                    document.getElementById('short_name').value = short_name;
                    document.getElementById('pageUpdateForm').submit();
                }
            }
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if ($update == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
