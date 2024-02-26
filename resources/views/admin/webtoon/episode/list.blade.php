@extends('admin.layouts.main')
@section('admin_content')
    @if ($list == 1)
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .select2-container .select2-selection--single {
                height: 40px !important;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 40px !important;
            }
        </style>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="" style="">
                            @if ($create == 1)
                                <a class="btn btn-primary mb-3" style="float: right;"
                                    href="{{ route('admin_webtoon_episodes_create_screen') }}">+
                                    Yeni</a>
                            @endif
                        </div>
                        <div class="col-lg-10" style="">
                            <div class="row">
                                <div class="ml-2 mr-2">
                                    <select name="selectWebtoon" id="selectWebtoon" style="width: 250px;">
                                    </select>
                                </div>
                                <div class="ml-2 mr-2">
                                    <input type="text" placeholder="Bölüm İsmi Ara...." name="webtoonSearch"
                                        id="webtoonSearch" class="form-control" oninput="checkInput()">
                                </div>
                                <div class="ml-2 mr-2">
                                    <button class="btn btn-success" id="webtoonSearchButton"
                                        onclick="searchWebtoonEpisodeButton()" disabled><i class="fas fa-search"></i>
                                        Ara</button>
                                </div>
                                <div class="ml-2 mr-2">
                                    <button class="btn btn-danger" id="searchWebtoonAllButton"
                                        onclick="searchWebtoonEpisodeAllButton()" disabled> <i
                                            class="fas fa-align-center"></i>
                                        Tümünü Göster</button>
                                </div>
                            </div>
                        </div>

                        <div class="ag-theme-quartz mt-2 mb-2" style="height: 500px;" id="myGrid"></div>

                        <div id="paginate"></div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ url('admin/assets/libs/jquery/jquery.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="{{ url('admin/assets/js/pageTable.js') }}"></script>


        <!-- Sayfa Değiştirme ve Arama Komutları-->
        <script>
            var selectedWebtoonCode = 0;
            var searchData = "";

            function changePage(page) {
                var pageData = {
                    page: page,
                }
                if (selectedWebtoonCode != 0)
                    pageData.selectedWebtoonCode = selectedWebtoonCode

                if (searchData != "")
                    pageData.searchData = searchData;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_webtoon_episodes_get_data') }}',
                    data: pageData,
                    success: function(response) {
                        var webtoon_episode = response.webtoon_episode;
                        var page_count = response.page_count;
                        var id = page <= 1 ? 1 : (page - 1) * parseInt("{{ Config::get('app.showCount') }}") + 1;
                        rowData = [];
                        for (let i = 0; i < webtoon_episode.length; i++) {
                            var rowItem = {
                                id: id++,
                                code: sendData(webtoon_episode[i].code),
                                name: sendData(webtoon_episode[i].webtoon_name),
                                image: sendData(webtoon_episode[i].webtoon_image),
                                episode_name: sendData(webtoon_episode[i].name),
                                season_short: sendData(webtoon_episode[i].season_short),
                                episode_short: sendData(webtoon_episode[i].episode_short),
                            };

                            rowData.push(rowItem);
                        }

                        getOtherData(page_count, page);

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            }

            //Webtoon arandığında otomatik getiren fonksiyon
            $('#selectWebtoon').on("select2:select", function(e) {
                var data = e.params.data;
                selectedWebtoonCode = parseInt(data.id)
                document.getElementById('searchWebtoonAllButton').disabled = false;
                search = 0;
                changePage(1);
            });

            //arama yaptında çalışmasını sağlayan fonksiyon
            function searchWebtoonEpisodeButton() {
                searchData = document.getElementById('webtoonSearch').value;
                document.getElementById('webtoonSearchButton').disabled = true;
                document.getElementById('searchWebtoonAllButton').disabled = false;
                changePage(1);
            }

            function searchWebtoonEpisodeAllButton() {
                searchData = "";
                selectedWebtoonCode = 0;
                document.getElementById('webtoonSearch').value = "";
                $('#selectWebtoon').val(null).trigger('change');
                document.getElementById('searchWebtoonAllButton').disabled = true;
                changePage(1);
            }
        </script>

        <!--Silme Komutları-->
        <script>
            @if ($delete == 1)
                function deleteWebtoonEpisde(code, name) {
                    Swal.fire({
                        title: 'Emin Misin?',
                        text: 'Bu Veriyi Silmek İstiyor musunuz(' + name + ')?',
                        icon: 'warning',
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Onayla',
                        denyButtonText: `Vazgeç`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            var html =
                                `<form action='{{ route('admin_webtoon_episodes_delete') }}' method="POST" id="deleteWebtoonEpisdeForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteWebtoonEpisdeForm').submit();
                        }
                    })
                }
            @endif
        </script>

        <!--Select2 komutları-->
        <script>
            $(document).ready(function() {
                $('#selectWebtoon').select2({
                    ajax: {
                        url: '{{ route('admin_webtoon_get_data') }}', // Laravel controller endpoint'iniz
                        dataType: 'json',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token'ı ekle
                        },
                        data: function(params) {
                            return {
                                searchData: params.term,
                                page: 1,
                                // Diğer parametreleri burada ekleyebilirsiniz
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data.webtoons, function(webtoon) {
                                    return {
                                        id: webtoon.code,
                                        text: webtoon.name,
                                        image: webtoon.thumb_image_2
                                        // Diğer alanları burada ekleyebilirsiniz
                                    };
                                }),
                                pagination: {
                                    more: data.pageCount > 1 // Eğer daha fazla sayfa varsa true döndürün
                                }
                            };
                        },
                        cache: true
                    },
                    placeholder: 'Webtoon Ara...',
                    minimumInputLength: 3, // Minimum giriş uzunluğu
                    escapeMarkup: function(markup) {
                        return markup;
                    }, // Markdown işlemlerini önlemek için
                    templateResult: formatResult, // Sonuçları özelleştirmek için
                    templateSelection: formatResult, // Seçili öğeyi özelleştirmek için
                })

                function formatResult(webtoon) {
                    if (!webtoon.id) {
                        return webtoon.text;
                    }
                    // Resmi sonuçlarda göster
                    // Yan yana resim ve metni göster
                    var imageMarkup =
                        '<img class="rounded-circle header-profile-user" src="../../../../' +
                        webtoon
                        .image +
                        '" alt="webtoon_image" />';
                    var textMarkup = '<div class="select2-result-webtoon__title">' +
                        webtoon.text + '</div>';

                    var markup = '<div class="row">' +
                        '<div class="ml-2 select2-result-webtoon__image-container">' + imageMarkup + '</div>' +
                        '<div class="select2-result-webtoon__text-container">' + textMarkup + '</div>' +
                        '</div>';

                    return markup;
                }
            });
        </script>

        <!--Arama İşlemi-->
        <script>
            function checkInput() {
                var inputField = document.getElementById('webtoonSearch');
                var submitButton = document.getElementById('webtoonSearchButton');

                // Input alanının değeri varsa, butonu aktif hale getir
                if (inputField.value.trim() !== '' && inputField.value !== searchData) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            }

            // Enter tuşuna basılınca formu gönder
            document.getElementById('webtoonSearch').addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    searchWebtoonEpisodeButton();
                    if (searchData.length <= 0 && selectedWebtoonCode == 0) {
                        document.getElementById('searchWebtoonAllButton').disabled = true;
                    }
                }
            });
        </script>

        <!--Ag-gird Komutları-->
        <script>
            var columnDefs = [{
                    headerName: "#",
                    field: "id",
                    maxWidth: 75,
                },
                {
                    headerName: "Resim",
                    field: "image",
                    maxWidth: 75,
                    cellRenderer: function(params) {
                        return `<img src="../../../${params.value}" alt="user" class="avatar-xs rounded-circle" />`;
                    },
                    filter: false,
                },
                {
                    headerName: "Webtoon",
                    field: "name",
                },
                {
                    headerName: "Bölüm Adı",
                    field: "episode_name",
                },
                {
                    headerName: "Sezon",
                    field: "season_short",
                },
                {
                    headerName: "Bölüm",
                    field: "episode_short",
                },

                @if ($delete == 1 || $update == 1)
                    {
                        headerName: "İşlemler",
                        field: "action",
                        cellRenderer: function(params) {
                            var html = `<div class="row" style="justify-content: center;">`
                            @if ($update == 1)
                                html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin_webtoon_episodes_update_screen') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Güncelle"><i class="fas fa-edit"></i></a>
                                    </div>`
                            @endif
                            @if ($delete == 1)
                                html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteWebtoonEpisde(${params.data.code}, '${params.data.name}')" data-toggle="tooltip" data-placement="Sil" title="Güncelle"><i class="fas fa-trash-alt"></i></a>
                                    </div>`
                            @endif

                            html += `</div>`;

                            return html;
                        },
                        filter: false,
                        cellEditorPopup: true,
                        cellEditor: 'agSelectCellEditor',
                        maxWidth: 125,
                        minWidth: 125,
                    },
                @endif
            ];
            gridOptionsData(columnDefs);
            changePage(1);
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if ($list == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
