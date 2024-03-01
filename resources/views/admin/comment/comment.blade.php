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
                        <div class="col-lg-10" style="">
                            <div class="row">
                                <div class="ml-2 mr-2">
                                    <button type="button" class="btn btn-success" id="commentSearchButton"
                                        data-toggle="modal" data-target=".comment-search-modal">
                                        <i class="fas fa-search"></i>
                                        Gelişmiş Arama
                                    </button>
                                </div>
                                <div class="ml-2 mr-2">
                                    <button class="btn btn-danger" id="clearSearchButton" onclick="clearSearch()" disabled>
                                        <i class="fas fa-align-center"></i>
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

        <!--  Gelişmiş Arama Modalı -->
        <div class="modal fade comment-search-modal" tabindex="-1" role="dialog" aria-labelledby="gelismisAramaModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="gelismisAramaModalLabel">Gelişmiş Arama</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="selectWebtoon">Webtoon: </label>
                                <select name="selectWebtoon" id="selectWebtoon" style="width: 250px;">
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label for="selectAnime">Anime: </label>
                                <select name="selectAnime" id="selectAnime" style="width: 250px;">
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label for="searchStatus">Durumu: </label>
                                <select id="searchStatus" class="form-control">
                                    <option value="0">Tümü</option>
                                    <option value="1">Pasif</option>
                                    <option value="2">Aktif</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label for="searchSpoiler">Spoiler: </label>
                                <select id="searchSpoiler" class="form-control">
                                    <option value="0">Tümü</option>
                                    <option value="1">Spoiler İçermeyen</option>
                                    <option value="2">Spoiler İçeren</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-3">
                                <label for="searchUser">Kullanıcı: </label>
                                <select id="searchUser" class="form-control">
                                    <option value="0">Tümü</option>
                                    <option value="1">Spoiler İçermeyen</option>
                                    <option value="2">Spoiler İçeren</option>
                                </select>
                            </div>

                            <div class="col-lg-3">
                                <label for="searchCommentCount">Yorum Sırası: </label>
                                <select name="" id="searchCommentCount" class="form-control">
                                    <option value="0">Tümü</option>
                                    <option value="1">Ana Yorumlar</option>
                                    <option value="2">Yorum Cevapları</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="searchComment">Yorum: </label>
                                <input type="text" id="searchComment" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <button type="button" class="btn btn-success float-right ml-2 mr-2" onclick="search()">
                                <i class="fas fa-search"></i>
                                Ara
                            </button>
                            <button class="btn btn-danger float-right ml-2 mr-2" type="button"
                                onclick="clearSearch()">Sıfırla</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script src="{{ url('admin/assets/libs/jquery/jquery.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        <script src="{{ url('admin/assets/js/pageTable.js') }}"></script>
        <!-- Sayfa Değiştirme Scripti-->
        <script>
            var webtoon_code = 0,
                anime_code = 0,
                status = 0,
                spoiler = 0,
                user_code = 0,
                comment_count = 0,
                searchData = "";

            function changePage(page) {
                var pageData = {
                    page: page,
                }
                if (showingCount && showingCount != 10) pageData.showingCount = showingCount;

                if (webtoon_code != 0) pageData.webtoon_code = webtoon_code;
                if (anime_code != 0) pageData.anime_code = anime_code;
                if (status != 0) pageData.status = status;
                if (spoiler != 0) pageData.spoiler = spoiler;
                if (user_code != 0) pageData.user_code = user_code;
                if (comment_count != 0) pageData.comment_count = comment_count;
                if (searchData != "") pageData.searchData = searchData;


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_comment_get_data') }}',
                    data: pageData,
                    success: function(response) {
                        var id = page <= 1 ? 1 : (page - 1) * showingCount + 1;
                        var comments = response.comments;
                        var page_count = response.pageCount;
                        rowData = [];
                        for (let i = 0; i < comments.length; i++) {
                            var rowItem = {
                                id: id++,
                                code: sendData(comments[i].code),
                                message: sendData(comments[i].message),
                                comment_short: sendData(comments[i].comment_short),
                                is_active: sendData(comments[i].is_active),
                            }

                            rowData.push(rowItem);
                        }

                        getOtherData(page_count, page);

                    },
                    error: function(error) {}
                });

            }
        </script>

        <!--Arama Komutları-->
        <script>
            function search() {
                var is_change = false;
                var new_webtoon_code = document.getElementById('selectWebtoon').value,
                    new_anime_code = document.getElementById('selectAnime').value,
                    new_status = document.getElementById('searchStatus').value,
                    new_spoiler = document.getElementById('searchSpoiler').value,
                    new_user_code = document.getElementById('searchUser').value,
                    new_comment_count = document.getElementById('searchCommentCount').value,
                    new_searchData = document.getElementById('searchComment').value;

                if (webtoon_code != new_webtoon_code) {
                    is_change = true;
                    webtoon_code = new_webtoon_code
                }

                if (anime_code != new_anime_code) {
                    is_change = true;
                    anime_code = new_anime_code
                }

                if (status != new_status) {
                    is_change = true;
                    status = new_status
                }

                if (spoiler != new_spoiler) {
                    is_change = true;
                    spoiler = new_spoiler
                }

                if (user_code != new_user_code) {
                    is_change = true;
                    user_code = new_user_code
                }

                if (comment_count != new_comment_count) {
                    is_change = true;
                    comment_count = new_comment_count
                }

                if (searchData != new_searchData) {
                    is_change = true;
                    searchData = new_searchData
                }

                if (is_change) {
                    changePage(1);
                    $('.comment-search-modal').modal('hide');
                    document.getElementById('clearSearchButton').disabled = false;
                }


            }

            function clearSearch() {
                webtoon_code = 0;
                anime_code = 0;
                status = 0;
                spoiler = 0;
                user_code = 0;
                comment_count = 0;
                searchData = "";

                $("#selectWebtoon").empty().trigger('change');
                $("#selectAnime").empty().trigger('change');
                document.getElementById('searchStatus').value = 0;
                document.getElementById('searchSpoiler').value = 0;
                document.getElementById('searchUser').value = 0;
                document.getElementById('searchCommentCount').value = 0;
                document.getElementById('searchComment').value = "";

                changePage(1);
                $('.comment-search-modal').modal('hide');
                document.getElementById('clearSearchButton').disabled = true;
            }
        </script>

        <!--Silme Komutu-->
        <script>
            @if ($delete == 1)
                function deleteComment(code, name) {
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
                                `<form action='{{ route('admin_comment_delete') }}' method="POST" id="deleteCommentForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteCommentForm').submit();
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
                    templateResult: formatWebtoonResult, // Sonuçları özelleştirmek için
                    templateSelection: formatWebtoonResult, // Seçili öğeyi özelleştirmek için
                })

                function formatWebtoonResult(webtoon) {
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
                    templateResult: formatAnimeResult, // Sonuçları özelleştirmek için
                    templateSelection: formatAnimeResult, // Seçili öğeyi özelleştirmek için
                })

                function formatAnimeResult(anime) {
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

        <!--Ag grid-->
        <script>
            var columnDefs = [{
                    headerName: "#",
                    field: "id",
                    maxWidth: 75,
                },
                {
                    headerName: "Yorum",
                    field: "message",
                },
                {
                    headerName: "Yorum Sırası",
                    field: "comment_short",
                },
                {
                    headerName: "Durumu",
                    field: "is_active",
                    cellRenderer: function(params) {
                        if (params.data.is_active == 1) {
                            return `<span class = "badge badge-pill badge-success"> Aktif </span>`;
                        } else {
                            return `<span class = "badge badge-pill badge-danger"> Pasif </span>`;
                        }
                    },
                },
                @if ($delete == 1)
                    {
                        headerName: "İşlemler",
                        field: "action",
                        cellRenderer: function(params) {
                            var html = `<div class="row" style="justify-content: center;">`
                            html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteComment(${params.data.code}, '${params.data.id}')" data-toggle="tooltip" data-placement="right" title="Sil"><i class="fas fa-trash-alt"></i></a>
                                    </div>`

                            if (params.data.is_active == 1) {
                                html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-danger btn-sm" href="{{ route('admin_comment_change_active') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Pasif Hale Getir"><i class="fas fa-times-circle" ></i></a>
                                        </div>`;
                            } else {
                                html +=
                                    `<div class="mr-2 ml-2">
                                                <a class="btn btn-success btn-sm" href="{{ route('admin_comment_change_active') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Aktif Hale Getir"><i class="fas fa-check-circle" ></i></a></div>`;
                            }
                            html += `</div>`;

                            return html;
                        },
                        filter: false,
                        cellEditorPopup: true,
                        cellEditor: 'agSelectCellEditor',
                        maxWidth: 250,
                        minWidth: 250,
                    },
                @endif
            ]
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
