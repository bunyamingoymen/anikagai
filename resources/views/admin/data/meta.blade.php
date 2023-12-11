@extends('admin.layouts.main')
@section('admin_content')
    @if ($metaData == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Meta Etiketleri: </h4>
                        <p>
                            Meta etiketlerini buradan güncelleyip değiştirebilirsiniz. Yeni Meta etiketi ekleyebilirsiniz
                        </p>
                        <div class="mt-3">
                            <div class="row col-lg-12">
                                <div class="col-lg-9 ml-2">
                                    <div class="float-right">
                                        <button class="btn btn-primary" onclick="createNewMeta()">+ Yeni Meta Etiketi
                                            Ekle</button>
                                    </div>
                                </div>
                            </div>
                            <div id="metaDiv">
                                @foreach ($meta as $item)
                                    <div class="mt-2" style="border: solid 1px #555956a7; border-radius: 10px;">
                                        <form action="{{ route('admin_data_meta_update') }}" method="POST">
                                            @csrf
                                            <input type="text" name="code" id="code" hidden
                                                value="{{ $item->code }}">
                                            <input type="text" name="key" id="key" hidden
                                                value="{{ $item->key }}">
                                            <div class="row m-3">
                                                <div class="col-lg-3">
                                                    <label for="menu">Name: </label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        value="{{ $item->value }}">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="url">Http-equiv: </label>
                                                    <input type="text" class="form-control" name="equiv" id="equiv"
                                                        value="{{ $item->optional_2 }}">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="url">Content: </label>
                                                    <input type="text" class="form-control" name="content" id="content"
                                                        value="{{ $item->optional }}">
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn btn-primary" type="submit">Değiştir</button>
                                                    <button class="btn btn-danger" type="button"
                                                        onclick="deleteMeta({{ $item->code }})">Sil</button>
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

        <script>
            var meta_count = parseInt("{{ count($meta) }}");

            function createNewMeta() {
                var meta_key = "meta";
                if (meta_count > 0) {
                    meta_key = "{{ $meta[0]->key ?? '' }}";
                } else {
                    var path = "{{ Request::path() }}"

                    if (path == "admin/data/meta") meta_key = "meta";
                    else if (path == "admin/data/adminMeta") meta_key = "admin_meta";
                }
                meta_count += 1;
                html = `<div id='meta_count` + meta_count + `' class="mt-2" style="border: solid 1px #555956a7; border-radius: 10px;">
            <form action="{{ route('admin_data_meta_add') }}" method="POST">
                @csrf
                <input type="text" name="key" id="key" hidden value="` + meta_key + `">
                <div class="row m-3">
                    <div class="col-lg-3">
                        <label for="menu">Name: </label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="col-lg-3">
                        <label for="url">Http-equiv: </label>
                        <input type="text" class="form-control" name="equiv" id="equiv">
                    </div>
                    <div class="col-lg-3">
                        <label for="url">Content: </label>
                        <input type="text" class="form-control" name="content" id="content">
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit">Değişikliği Kaydet</button>
                        <button class="btn btn-danger" type="button" onclick="deleteHTML('meta_count` + meta_count + `')">Sil</button>
                    </div>
                </div>
            </form>
        </div>`
                $("#metaDiv").append(html);
            }

            function deleteHTML(html) {
                document.getElementById(html).remove();
            }

            function deleteMeta(code) {
                var form = `<form action="{{ route('admin_data_meta_delete') }}" method="POST" id="metaDeleteForm">
            @csrf
            <input type="text" name="code" value="` + code + `">
        </form>`

                $("#hiddenDiv").append(form);

                document.getElementById('metaDeleteForm').submit();
            }
        </script>

        <script>
            // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
            window.addEventListener('DOMContentLoaded', (event) => {
                // Değişkenin değerini kontrol et
                @if ($metaData == 0)
                    // Değişken doğru ise yönlendirme yap
                    window.location.href = '{{ route('admin_index') }}';
                @endif
            });
        </script>
    @endif
@endsection
