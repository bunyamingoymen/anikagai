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

                        <div>
                            @if ($create == 1)
                                <a class="btn btn-primary mb-3" style="float: right;"
                                    href="{{ route('admin_anime_episodes_create_screen') }}">+ Yeni</a>
                            @endif
                        </div>
                        <div class="col-lg-10" style="">
                            <div class="row">
                                <div class="ml-2 mr-2">
                                    <select name="selectAnime" id="selectAnime" style="width: 250px;">
                                    </select>
                                </div>
                                <div class="ml-2 mr-2">
                                    <input type="text" placeholder="Bölüm İsmi Ara...." name="animeSearch"
                                        id="animeSearch" class="form-control" oninput="checkInput()">
                                </div>
                                <div class="ml-2 mr-2">
                                    <button class="btn btn-success" id="animeSearchButton"
                                        onclick="searchAnimeEpisodeButton()" disabled><i class="fas fa-search"></i>
                                        Ara</button>
                                </div>
                                <div class="ml-2 mr-2">
                                    <button class="btn btn-danger" id="searchAnimeAllButton"
                                        onclick="searchAnimeEpisodeAllButton()" disabled> <i
                                            class="fas fa-align-center"></i>
                                        Tümünü Göster</button>
                                </div>
                            </div>
                        </div>
                        <div class="ag-theme-quartz mt-2 mb-2" style="height: 500px;" id="myGrid"></div>

                        <div class="float-right">
                            <ul class="pagination">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ url('admin/assets/libs/jquery/jquery.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="{{ url('admin/assets/js/pageTable.js') }}"></script>
        <!-- Sayfa Değiştirme Scripti-->
        <script>
            var selectedAnimeCode = 0;
            var searchData = "";

            function changePage(page) {
                var pageData = {
                    page: page,
                }
                if (selectedAnimeCode != 0)
                    pageData.selectedAnimeCode = selectedAnimeCode

                if (searchData != "")
                    pageData.searchData = searchData;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_anime_episodes_get_data') }}',
                    data: pageData,
                    success: function(response) {
                        var id = page <= 1 ? 1 : (page - 1) * 10 + 1;
                        var anime_episode = response.anime_episode;
                        var page_count = response.page_count;
                        rowData = [];
                        for (let i = 0; i < anime_episode.length; i++) {

                            var rowItem = {
                                id: id++,
                                code: sendData(anime_episode[i].code),
                                image: sendData(anime_episode[i].anime_image),
                                anime_name: sendData(anime_episode[i].anime_name),
                                name: sendData(anime_episode[i].name),
                                season_short: sendData(anime_episode[i].season_short),
                                episode_short: sendData(anime_episode[i].episode_short)
                            }
                            rowData.push(rowItem);

                        }

                        gridApi.setGridOption('rowData', rowData);

                        newPageCount(page_count, page);
                        pageCount = page_count;

                        currentPaginationId = 'pagination' + currentPage;
                        paginationId = 'pagination' + page;

                        document.getElementById(currentPaginationId).classList.remove("active");
                        document.getElementById(paginationId).classList.add("active");

                        currentPage = page;

                    }
                });
            }
        </script>

        <script>
            @if ($delete == 1)
                function deleteAnimeEpisde(code, name) {
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
                                `<form action='{{ route('admin_anime_episodes_delete') }}' method="POST" id="deleteAnimeEpisdeForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteAnimeEpisdeForm').submit();
                        }
                    })
                }
            @endif
        </script>

        <!--Select2 komutları-->
        <script>
            $(document).ready(function() {
                $('#selectAnime').select2({
                    ajax: {
                        url: '{{ route('admin_anime_get_data') }}', // Laravel controller endpoint'iniz
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
                                results: $.map(data.animes, function(anime) {
                                    return {
                                        id: anime.code,
                                        text: anime.name,
                                        image: anime.thumb_image_2
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
                    placeholder: 'Anime Ara...',
                    minimumInputLength: 3, // Minimum giriş uzunluğu
                    escapeMarkup: function(markup) {
                        return markup;
                    }, // Markdown işlemlerini önlemek için
                    templateResult: formatResult, // Sonuçları özelleştirmek için
                    templateSelection: formatResult, // Seçili öğeyi özelleştirmek için
                })

                function formatResult(anime) {
                    if (!anime.id) {
                        return anime.text;
                    }
                    // Resmi sonuçlarda göster
                    // Yan yana resim ve metni göster
                    var imageMarkup =
                        '<img class="rounded-circle header-profile-user" src="../../../../' +
                        anime
                        .image +
                        '" alt="anime_image" />';
                    var textMarkup = '<div class="select2-result-anime__title">' +
                        anime.text + '</div>';

                    var markup = '<div class="row">' +
                        '<div class="ml-2 select2-result-anime__image-container">' + imageMarkup + '</div>' +
                        '<div class="select2-result-anime__text-container">' + textMarkup + '</div>' +
                        '</div>';

                    return markup;
                }
            });
        </script>

        <!--Arama İşlemi-->
        <script>
            function checkInput() {
                var inputField = document.getElementById('animeSearch');
                var submitButton = document.getElementById('animeSearchButton');

                // Input alanının değeri varsa, butonu aktif hale getir
                if (inputField.value.trim() !== '' && inputField.value !== searchData) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            }

            // Enter tuşuna basılınca formu gönder
            document.getElementById('animeSearch').addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    searchAnimeEpisodeButton();
                    if (searchData.length <= 0 && selectedAnimeCode == 0) {
                        document.getElementById('searchAnimeAllButton').disabled = true;
                    }
                }
            });

            //Webtoon arandığında otomatik getiren fonksiyon
            $('#selectAnime').on("select2:select", function(e) {
                var data = e.params.data;
                selectedAnimeCode = parseInt(data.id)
                document.getElementById('searchAnimeAllButton').disabled = false;
                changePage(1);
            });

            //arama yaptında çalışmasını sağlayan fonksiyon
            function searchAnimeEpisodeButton() {
                searchData = document.getElementById('animeSearch').value;
                //selectedAnimeCode = document.getElementById('selectAnime').value;
                document.getElementById('animeSearchButton').disabled = true;
                document.getElementById('searchAnimeAllButton').disabled = false;
                changePage(1);
            }

            function searchAnimeEpisodeAllButton() {
                searchData = "";
                selectedAnimeCode = 0;
                document.getElementById('animeSearch').value = "";
                $('#selectAnime').val(null).trigger('change');
                document.getElementById('searchAnimeAllButton').disabled = true;
                changePage(1);
            }
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
                    headerName: "Anime",
                    field: "anime_name",
                },
                {
                    headerName: "Bölüm Adı",
                    field: "name",
                },
                {
                    headerName: "Sezon",
                    field: "season_short",
                },
                {
                    headerName: "Bölüm",
                    field: "episode_short",
                },
                {
                    headerName: "İşlemler",
                    field: "action",
                    cellRenderer: function(params) {
                        var html = `<div class="row" style="justify-content: center;">`
                        @if ($update == 1)
                            html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin_anime_episodes_update_screen') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Güncelle"><i class="fas fa-edit"></i></a>
                                    </div>`
                        @endif
                        @if ($delete == 1)
                            html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteAnimeEpisde(${params.data.code}, '${params.data.anime_name}')" data-toggle="tooltip" data-placement="right" title="Sil"><i class="fas fa-trash-alt"></i></a>
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
