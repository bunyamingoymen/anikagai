@extends('admin.layouts.main')
@section('admin_content')
    @if ($list == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            @if ($create == 1)
                                <a class="btn btn-primary mb-3" style="float: right;"
                                    href="{{ route('admin_anime_create_screen') }}">+ Yeni</a>
                            @endif
                        </div>
                        <div class="col-lg-10" style="">
                            <div class="row">
                                <div class="ml-2 mr-2">
                                    <input type="text" placeholder="Anime Ara...." name="animeSearch" id="animeSearch"
                                        class="form-control" oninput="checkInput()">
                                </div>
                                <div class="ml-2 mr-2">
                                    <button class="btn btn-success" id="animeSearchButton" onclick="searchAnimeButton()"
                                        disabled><i class="fas fa-search"></i> Ara</button>
                                </div>
                                <div class="ml-2 mr-2">
                                    <button class="btn btn-danger" id="searchAnimeAllButton"
                                        onclick="searchAnimeAllButton()" disabled> <i class="fas fa-align-center"></i>
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

        <script src="../../../admin/assets/js/pageTable.js"></script>
        <!-- Sayfa Değiştirme Scripti-->
        <script>
            var searchData = "";

            function changePage(page) {
                var pageData = {
                    page: page,
                }

                if (searchData != "")
                    pageData.searchData = searchData;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_anime_get_data') }}',
                    data: pageData,
                    success: function(response) {
                        var id = page <= 1 ? 1 : (page - 1) * 10 + 1;
                        var animes = response.animes;
                        var page_count = response.page_count;
                        rowData = [];
                        for (let i = 0; i < animes.length; i++) {

                            var rowItem = {
                                id: id++,
                                code: sendData(animes[i].code),
                                image: sendData(animes[i].image),
                                name: sendData(animes[i].name),
                                plusEighteen: sendData(animes[i].plusEighteen),
                                showStatus: sendData(animes[i].showStatus),
                                episode_count: sendData(animes[i].episode_count),
                                click_count: sendData(animes[i].click_count)
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
                function deleteAnime(code, name) {
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
                                `<form action='{{ route('admin_anime_delete') }}' method="POST" id="deleteAnimeForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteAnimeForm').submit();
                        }
                    })
                }
            @endif
        </script>

        <!--Arama İşlemi-->
        <script>
            function searchAnimeButton() {
                searchData = document.getElementById('animeSearch').value;
                document.getElementById('animeSearchButton').disabled = true;
                document.getElementById('searchAnimeAllButton').disabled = false;
                changePage(1);
            }

            function searchAnimeAllButton() {
                searchData = "";
                document.getElementById('animeSearch').value = "";
                document.getElementById('animeSearchButton').disabled = true;
                document.getElementById('searchAnimeAllButton').disabled = true;
                changePage(1);
            }

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
                    searchAnimeButton();
                    if (searchData.length <= 0) {
                        document.getElementById('searchAnimeAllButton').disabled = true;
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
                    headerName: "İsim",
                    field: "name",
                },
                {
                    headerName: "Durumu",
                    field: "showStatus",
                    cellRenderer: function(params) {
                        var html = ``;

                        if (params.data.plusEighteen == 1) {
                            var html = `<span class="badge badge-pill badge-dark">+18</span>`;
                        }

                        if (params.data.showStatus == 0) {
                            html += `<span class = "badge badge-pill badge-success"> Görünür </span>`;
                        } else if (params.data.showStatus == 1) {
                            html += `<span class = "badge badge-pill badge-warning"> Üyelere Özel </span>`
                        } else if (params.data.showStatus == 2) {
                            html += `<span class = "badge badge-pill badge-secondary"> Sansürlü </span>`
                        } else if (params.data.showStatus == 3) {
                            html += `<span class = "badge badge-pill badge-primary"> Liste Dışı </span>`
                        } else if (params.data.showStatus == 4) {
                            html += `<span class = "badge badge-pill badge-danger"> Gizli </span>`;
                        } else {
                            html = `<span class = "badge badge-pill badge-light"> <span
                                style = "color:red;" > HATA </span></span>`;
                        }

                        return html;
                    },
                },
                {
                    headerName: "Bölüm Sayısı",
                    field: "episode_count",
                },
                {
                    headerName: "Tıklama Sayısı",
                    field: "click_count",
                },
                {
                    headerName: "İşlemler",
                    field: "action",
                    cellRenderer: function(params) {
                        var html = `<div class="row" style="justify-content: center;">`
                        @if ($update == 1)
                            html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin_anime_update_screen') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Güncelle"><i class="fas fa-edit"></i></a>
                                    </div>`
                        @endif
                        @if ($delete == 1)
                            html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteAnime(${params.data.code}, '${params.data.name}')" data-toggle="tooltip" data-placement="right" title="Sil"><i class="fas fa-trash-alt"></i></a>
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
