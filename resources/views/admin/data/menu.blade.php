@extends('admin.layouts.main')
@section('admin_content')
    @if ($menuData == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Menü Başlıkları: </h4>
                        <p>Var olan menülerin görünüp görünmeyeceğini ve ne yazacağını belirleyebilirsiniz.
                            Menüye yeni bir değer ekleyip ona istediğiniz url'i verebilirsiniz.
                        </p>
                        <div class="mt-3">
                            <div class="row col-lg-12">
                                <div class="col-lg-2">
                                    <h4>Birinci Menü: </h4>
                                </div>
                                <div class="col-lg-9 ml-2">
                                    <div class="float-right">
                                        <button class="btn btn-primary" onclick="createNewMenu()">+ Yeni Menü Ekle</button>
                                    </div>
                                </div>
                            </div>
                            <div id="menuDiv">
                                @foreach ($menus as $item)
                                    <div class="mt-2" style="border: solid 1px #555956a7; border-radius: 10px;">
                                        <form action="{{ route('admin_data_menu_update') }}" method="POST">
                                            @csrf
                                            <input type="text" name="code" id="code" hidden
                                                value="{{ $item->code }}">
                                            <input type="text" name="menu" id="menu" hidden value="menu">
                                            <div class="row m-3">
                                                <div class="col-lg-3">
                                                    <label for="menu">Menü: </label>
                                                    <input type="text" class="form-control" name="menu" id="menu"
                                                        value="{{ $item->value }}">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="url">Link: </label>
                                                    <input type="text" class="form-control" name="url" id="url"
                                                        value="{{ $item->optional_2 }}">
                                                </div>
                                                <div class="col-lg-2 mt-5">
                                                    @if ($item->optional == 1)
                                                        <input type="checkbox" name="showMenu" id="showMenu" checked>
                                                    @else
                                                        <input type="checkbox" name="showMenu" id="showMenu">
                                                    @endif
                                                    <label for="showMenu">Görünebilir</label>
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn btn-primary" type="submit">Değiştir</button>
                                                    <button class="btn btn-danger" type="button"
                                                        onclick="deleteMenu({{ $item->code }})">Sil</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="mt-5">
                            <div class="row col-lg-12">
                                <div class="col-lg-2">
                                    <h4>İkinci Menü: </h4>
                                </div>
                                <div class="col-lg-9 ml-2">
                                    <div class="float-right">
                                        <button class="btn btn-secondary" onclick="createNewAltMenu()">+ Yeni Alt Menü
                                            Ekle</button>
                                    </div>
                                </div>
                            </div>
                            <div id="menuAltDiv">
                                @foreach ($menu_alts as $item)
                                    <div class="mt-2" style="border: solid 1px #555956a7; border-radius: 10px;">
                                        <form action="{{ route('admin_data_menu_update') }}" method="POST">
                                            @csrf
                                            <input type="text" name="code" id="code" hidden
                                                value="{{ $item->code }}">
                                            <input type="text" name="menu_type" id="menu_type" hidden value="menu_alt">
                                            <div class="row m-3">
                                                <div class="col-lg-3">
                                                    <label for="menu">Menü: </label>
                                                    <input type="text" class="form-control" name="menu" id="menu"
                                                        value="{{ $item->value }}">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="url">Link: </label>
                                                    <input type="text" class="form-control" name="url" id="url"
                                                        value="{{ $item->optional_2 }}">
                                                </div>
                                                <div class="col-lg-2 mt-5">
                                                    @if ($item->optional == 1)
                                                        <input type="checkbox" name="showMenu" id="showMenu" checked>
                                                    @else
                                                        <input type="checkbox" name="showMenu" id="showMenu">
                                                    @endif
                                                    <label for="showMenu">Görünebilir</label>
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn btn-secondary">Değiştir</button>
                                                    <button class="btn btn-danger" type="button"
                                                        onclick="deleteMenu({{ $item->code }})">Sil</button>
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
            var menu_count = parseInt("{{ count($menus) }}");
            var menu_alt_count = parseInt("{{ count($menu_alts) }}");

            function createNewMenu() {
                menu_count += 1;
                var html = `<div id="menu_count` + menu_count + `" class="mt-2" style="border: solid 1px #555956a7; border-radius: 10px;">
            <form action="{{ route('admin_data_menu_add') }}" method="POST">
                @csrf
                <input type="text" name="menu_type" id="menu_type" hidden value="menu">
                <div class="row m-3">
                    <div class="col-lg-3">
                        <label for="menu">Menü: </label>
                        <input type="text" class="form-control" name="menu" id="menu">
                    </div>
                    <div class="col-lg-3">
                        <label for="url">Link: </label>
                        <input type="text" class="form-control" name="url" id="url">
                    </div>
                    <div class="col-lg-2 mt-5">
                        <input type="checkbox" name="showMenu" id="showMenu">
                        <label for="showMenu">Görünebilir</label>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit">Değişiklikleri Kaydet</button>
                        <button class="btn btn-danger" type="submit" onclick='deleteHTML("menu_count` + menu_count + `")'>vazgeç</button>
                    </div>
                </div>
            </form>
        </div>`
                $("#menuDiv").append(html);
            }

            function createNewAltMenu() {
                menu_alt_count += 1;
                var html = `<div id="menu_alt_count` + menu_alt_count + `" class="mt-2" style="border: solid 1px #555956a7; border-radius: 10px;">
            <form action="{{ route('admin_data_menu_add') }}" method="POST">
                @csrf
                <input type="text" name="menu_type" id="menu_type" hidden value="menu_alt">
                <div class="row m-3">
                    <div class="col-lg-3">
                        <label for="menu">Menü: </label>
                        <input type="text" class="form-control" name="menu" id="menu">
                    </div>
                    <div class="col-lg-3">
                        <label for="url">Link: </label>
                        <input type="text" class="form-control" name="url" id="url">
                    </div>
                    <div class="col-lg-2 mt-5">
                        @if ($item->optional == 1)
                        <input type="checkbox" name="showMenu" id="showMenu" checked>
                        @else
                        <input type="checkbox" name="showMenu" id="showMenu">
                        @endif
                        <label for="showMenu">Görünebilir</label>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-secondary" type="submit">Değişiklikleri Kaydet</button>
                        <button class="btn btn-danger" type="submit" onclick='deleteHTML("menu_alt_count` +
                    menu_alt_count + `")'>vazgeç</button>
                    </div>
                </div>
            </form>
        </div>`;

                $("#menuAltDiv").append(html);
            }

            function deleteHTML(html) {
                document.getElementById(html).remove();
            }

            function deleteMenu(code) {
                var form = `<form action="{{ route('admin_data_menu_delete') }}" method="POST" id="menuDeleteForm">
            @csrf
            <input type="text" name="code" value="` + code + `">
        </form>`

                $("#hiddenDiv").append(form);

                document.getElementById('menuDeleteForm').submit();
            }
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if ($menuData == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
