@extends('admin.layouts.main')
@section('admin_content')
    @if ($list == 1)
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/styles/ag-grid.css" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/styles/ag-theme-quartz.css" />

        <script src="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/dist/ag-grid-community.min.js"></script>

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

                        <div class="float-right">
                            <ul class="pagination">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="../../../admin/assets/libs/jquery/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Sayfa Değiştirme ve Arama Komutları-->
        <script>
            var currentPage = 1;
            var is_select_webtoon = false;
            var selectedWebtoonCode = 0;
            var search = -1;
            var searchData = "";
            var changePagination = false;
            var pageCount = parseInt("{{ $pageCount }}");

            function changePage(page) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_webtoon_episodes_get_data') }}',
                    data: {
                        page: page,
                        is_select_webtoon: is_select_webtoon,
                        selectedWebtoonCode: selectedWebtoonCode,
                        search: search,
                        searchData: searchData
                    },
                    success: function(response) {
                        var webtoon_episode = response.webtoon_episode
                        console.log('webtoon_episode: ' + response.webtoon_episode.length);
                        var code = ``;
                        var id = page <= 1 ? 1 : (page - 1) * 10 + 1;
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

                        gridApi.setGridOption('rowData', rowData);

                        if (search == 0) {
                            pageCount = parseInt(response.pageCount);
                        } else {
                            pageCount = parseInt("{{ $pageCount }}");
                        }

                        newPageCount(pageCount, page);


                        if (pageCount > 0) {
                            currentPaginationId = 'pagination' + currentPage;
                            paginationId = 'pagination' + page;

                            if (document.getElementById(currentPaginationId)) {
                                document.getElementById(currentPaginationId).classList.remove("active");
                            }
                            if (document.getElementById(paginationId)) {
                                document.getElementById(paginationId).classList.add("active");
                            }
                        }

                        currentPage = page;

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            }

            function prevPage() {
                if (currentPage > 1)
                    changePage(currentPage + -1)
            }

            function nextPage() {
                if (currentPage < pageCount) changePage(currentPage + 1)
            }

            //Webtoon arandığında otomatik getiren fonksiyon
            $('#selectWebtoon').on("select2:select", function(e) {
                var data = e.params.data;
                is_select_webtoon = true;
                selectedWebtoonCode = parseInt(data.id)
                document.getElementById('searchWebtoonAllButton').disabled = false;
                changePagination = true;
                search = 0;
                changePage(1);
            });

            //arama yaptında çalışmasını sağlayan fonksiyon
            function searchWebtoonEpisodeButton() {
                search = 0;
                searchData = document.getElementById('webtoonSearch').value;
                changePagination = true;
                document.getElementById('webtoonSearchButton').disabled = true;
                document.getElementById('searchWebtoonAllButton').disabled = false;
                changePage(1);
            }

            function searchWebtoonEpisodeAllButton() {
                search = -1;
                searchData = "";
                is_select_webtoon = false;
                selectedWebtoonCode = 0;
                changePagination = true;
                document.getElementById('webtoonSearch').value = "";
                $('#selectWebtoon').val(null).trigger('change');
                document.getElementById('searchWebtoonAllButton').disabled = true;
                changePage(1);
            }

            //Sayfalama kısmını yeniden düzenleyen fonksiyon
            function newPageCount(new_page_count, page) {
                if (!page) {
                    page = currentPage;
                }
                var pagination = document.getElementsByClassName('pagination')[0];
                var html = `<li class="page-item">
                                    <a class="page-link" href="javascript:;" onclick="prevPage();" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>`;
                if (new_page_count <= 10) {
                    for (let i = 1; i <= new_page_count; i++) {
                        html += `<li class="page-item" id="pagination${i}">
                                            <a class="page-link " href="javascript:;" onclick="changePage(${i})">
                                                ${i}
                                            </a>
                                        </li>`;
                    }
                } else {
                    html += `<li class="page-item" id="pagination1">
                                    <a class="page-link " href="javascript:;" onclick="changePage(1)">
                                        1
                                    </a>
                                </li>`;
                    if (page - 2 > 1) {
                        html += `<li class="page-item">
                                    <a class="page-link " href="javascript:;">
                                        ...
                                    </a>
                                </li>`;
                        for (let i = page - 2; i <= page + 2 && i < new_page_count; i++) {
                            html += `<li class="page-item" id="pagination${i}">
                                            <a class="page-link " href="javascript:;" onclick="changePage(${i})">
                                                ${i}
                                            </a>
                                        </li>`;
                        }
                    } else {
                        for (let i = 2; i <= page + 2 && i < new_page_count; i++) {
                            html += `<li class="page-item" id="pagination${i}">
                                            <a class="page-link " href="javascript:;" onclick="changePage(${i})">
                                                ${i}
                                            </a>
                                        </li>`;
                        }
                    }



                    if (page + 2 < new_page_count) {
                        html += `<li class="page-item">
                                    <a class="page-link " href="javascript:;">
                                        ...
                                    </a>
                                </li>`;
                    }

                    html += `<li class="page-item" id="pagination${new_page_count}">
                                    <a class="page-link " href="javascript:;" onclick="changePage(${new_page_count})">
                                        ${new_page_count}
                                    </a>
                                </li>`
                }


                html += `<li class="page-item">
                            <a class="page-link" href="javascript:;" onclick="nextPage();" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>`;

                pagination.innerHTML = html;
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
                                search: -99,
                                // Diğer parametreleri burada ekleyebilirsiniz
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data.webtoons, function(webtoon) {
                                    return {
                                        id: webtoon.code,
                                        text: webtoon.name,
                                        image: webtoon.image
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
                    searchWebtoonButton();
                }
            });
        </script>

        <!--Ag-gird Komutları-->
        <script>
            var rowData = [];

            const gridOptions = {
                // Row Data: The data to be displayed.
                rowData: rowData,
                // Column Definitions: Defines & controls grid columns.
                columnDefs: [{
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
                ],
                defaultColDef: {
                    //flex: 1, // Sütunların esnekliği
                    resizable: true,
                    animateRows: true,
                    cellEditor: 'agSelectCellEditor',
                },
                animateRows: true
            };

            const myGridElement = document.querySelector('#myGrid');
            var gridApi = agGrid.createGrid(myGridElement, gridOptions);
            changePage(1);
            newPageCount(`{{ $pageCount }}`, 1);
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
