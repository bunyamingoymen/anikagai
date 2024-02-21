@extends('admin.layouts.main')
@section('admin_content')
    @if ($list == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12" style="display: inline-block;">
                            <a class="btn btn-primary mb-3" style="float: right;"
                                href="{{ route('admin_anime_episodes_create_screen') }}">+ Yeni</a>
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
            function changePage(page) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_anime_episodes_get_data') }}',
                    data: {
                        page: page
                    },
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
