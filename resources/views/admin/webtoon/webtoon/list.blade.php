@extends('admin.layouts.main')
@section('admin_content')
    @if ($list == 1)
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/styles/ag-grid.css" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/styles/ag-theme-quartz.css" />

        <script src="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/dist/ag-grid-community.min.js"></script>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="" style="">
                            @if ($create == 1)
                                <a class="btn btn-primary mb-3" style="float: right;"
                                    href="{{ route('admin_webtoon_create_screen') }}">+ Yeni</a>
                            @endif
                        </div>
                        <div class="col-lg-10" style="">
                            <div class="row">
                                <div class="ml-2 mr-2">
                                    <input type="text" placeholder="Webtoon Ara...." name="webtoonSearch"
                                        id="webtoonSearch" class="form-control" oninput="checkInput()">
                                </div>
                                <div class="ml-2 mr-2">
                                    <button class="btn btn-success" id="webtoonSearchButton" onclick="searchWebtoonButton()"
                                        disabled><i class="fas fa-search"></i> Ara</button>
                                </div>
                                <div class="ml-2 mr-2">
                                    <button class="btn btn-danger" id="searchWebtoonAllButton"
                                        onclick="searchWebtoonAllButton()" disabled> <i class="fas fa-align-center"></i>
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

        <!-- Sayfa Değiştirme Scripti-->
        <script>
            var currentPage = 1;
            var search = -1; // -1: arama değil, 0: aramaya başlandı, 1: sonuçlar getirildi
            var searchData = "";
            var changePagination = false;
            var pageCount = parseInt("{{ $pageCount }}");

            function changePage(page) {
                if (search != -1 && searchData != "") {
                    var pageData = {
                        page: page,
                        search: search,
                        searchData: searchData,
                    }
                } else {
                    search = -1
                    var pageData = {
                        page: page,
                        search: search,
                    }
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_webtoon_get_data') }}',
                    data: pageData,
                    success: function(response) {
                        var webtoons = response.webtoons;
                        rowData = [];
                        var code = ``;
                        var id = page <= 1 ? 1 : (page - 1) * 10 + 1;
                        for (let i = 0; i < webtoons.length; i++) {
                            var webtoons_code = sendData(webtoons[i].code);
                            var webtoons_name = sendData(webtoons[i].name);
                            var webtoons_image = sendData(webtoons[i].thumb_image);
                            var webtoons_plusEighteen = sendData(webtoons[i].plusEighteen);
                            var webtoons_showStatus = sendData(webtoons[i].showStatus);
                            var webtoons_episode_count = sendData(webtoons[i].episode_count);
                            var webtoons_click_count = sendData(webtoons[i].episode_count);

                            var rowItem = {
                                id: id++,
                                code: webtoons_code,
                                name: webtoons_name,
                                image: webtoons_image,
                                plusEighteen: webtoons_plusEighteen,
                                showStatus: webtoons_showStatus,
                                episode_count: webtoons_episode_count,
                                click_count: webtoons_click_count,
                            };

                            rowData.push(rowItem);
                        }

                        gridApi.setGridOption('rowData', rowData);

                        if (search == 0) {
                            pageCount = parseInt(response.pageCount);
                        } else {
                            pageCount = parseInt("{{ $pageCount }}");
                        }

                        /*if (changePagination) {

                            if (search == 0) search = 1;

                            changePagination = false;
                        }*/

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

            function searchWebtoonButton() {
                search = 0;
                searchData = document.getElementById('webtoonSearch').value;
                changePagination = true;
                document.getElementById('webtoonSearchButton').disabled = true;
                document.getElementById('searchWebtoonAllButton').disabled = false;
                changePage(1);
            }

            function searchWebtoonAllButton() {
                search = -1;
                searchData = "";
                document.getElementById('webtoonSearch').value = "";
                changePagination = true;
                document.getElementById('searchWebtoonAllButton').disabled = true;
                changePage(1);
            }

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

        <!--Silme işlemi-->
        <script>
            @if ($delete == 1)
                function deleteWebtoon(code, name) {
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
                                `<form action='{{ route('admin_webtoon_delete') }}' method="POST" id="deleteWebtoonForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteWebtoonForm').submit();
                        }
                    })
                }
            @endif
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
                        headerName: "İsim",
                        field: "name",
                    },
                    {
                        headerName: "Durum",
                        field: "showStatus",
                        cellRenderer: function(params) {
                            var code = ``;
                            if (params.data.plusEighteen == 1) {
                                code += `<span class="badge badge-pill badge-dark">+18</span>`;
                            }
                            if (params.value == 0) {
                                code += `<span class="badge badge-pill badge-success">Görünür</span>`;

                            } else if (params.value == 1) {
                                code += `<span class="badge badge-pill badge-warning">Üyelere Özel</span>`;
                            } else if (params.value == 2) {
                                code += `<span class="badge badge-pill badge-secondary">Sansürlü</span>`;
                            } else if (params.value == 3) {
                                code += `<span class="badge badge-pill badge-primary">Liste Dışı</span>`;
                            } else if (params.value == 4) {
                                code += `<span class="badge badge-pill badge-danger">Gizli</span>`;
                            } else {
                                code +=
                                    `<span class="badge badge-pill badge-light"><span style="color:red;">HATA</span></span>`;
                            }

                            return code;
                        }
                    },
                    {
                        headerName: "Bölüm Sayısı",
                        field: "episode_count",
                    },
                    {
                        headerName: "Tıklanma Sayısı",
                        field: "click_count",
                    },

                    @if ($delete == 1 || $update == 1)
                        {
                            headerName: "İşlemler",
                            field: "action",
                            cellRenderer: function(params) {
                                var html = `<div class="row" style="justify-content: center;">`
                                @if ($update == 1)
                                    html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin_webtoon_update_screen') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Güncelle"><i class="fas fa-edit"></i></a>
                                    </div>`
                                @endif
                                @if ($delete == 1)
                                    html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteWebtoon(${params.data.code}, '${params.data.name}')" data-toggle="tooltip" data-placement="right" title="Sil"><i class="fas fa-trash-alt"></i></a>
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
