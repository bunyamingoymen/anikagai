@extends('admin.layouts.main')
@section('admin_content')
    @if ($list == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12" style="display: inline-block;">
                            @if ($create == 1)
                                <a class="btn btn-primary mb-3" style="float: right;"
                                    href="{{ route('admin_indexuser_create_screen') }}">+
                                    Yeni</a>
                            @endif
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
            var pageCount = 1;

            function changePage(page) {
                console.log(page);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_indexuser_get_data') }}',
                    data: {
                        page: page
                    },
                    success: function(response) {
                        var id = page <= 1 ? 1 : (page - 1) * 10 + 1;
                        var indexUsers = response.indexUsers;
                        var page_count = response.pageCount;
                        rowData = [];
                        for (let i = 0; i < indexUsers.length; i++) {

                            var rowItem = {
                                id: id++,
                                code: sendData(indexUsers[i].code),
                                image: sendData(indexUsers[i].image),
                                name: sendData(indexUsers[i].name),
                                username: sendData(indexUsers[i].username),
                                email: sendData(indexUsers[i].email),
                                is_active: sendData(indexUsers[i].is_active)
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

            function prevPage() {
                if (currentPage > 1)
                    changePage(currentPage + -1)
            }

            function nextPage() {
                if (currentPage < pageCount) changePage(currentPage + 1)
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

        <script>
            @if ($delete == 1)
                function deleteIndexUser(code, name) {
                    Swal.fire({
                        title: 'Emin Misin?',
                        text: 'Bu Veriyi Silmek İstiyor musunuz(ID: ' + name + ')?',
                        icon: 'warning',
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Onayla',
                        denyButtonText: `Vazgeç`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            var html =
                                `<form action='{{ route('admin_indexuser_delete') }}' method="POST" id="deleteIndexUserForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteIndexUserForm').submit();
                        }
                    })
                }
            @endif
        </script>

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
                        headerName: "Kullanıcı Adı",
                        field: "username",
                    },
                    {
                        headerName: "E-mail",
                        field: "email",
                    },
                    {
                        headerName: "Durumu",
                        field: "is_active",
                        cellRenderer: function(params) {
                            if (params.data.is_active === 1) {
                                return `<span class = "badge badge-pill badge-success"> Aktif </span>`;
                            } else {
                                return `<span class = "badge badge-pill badge-danger"> Pasif </span>`;
                            }
                        },
                    },
                    {
                        headerName: "İşlemler",
                        field: "action",
                        cellRenderer: function(params) {
                            var html = `<div class="row" style="justify-content: center;">`
                            @if ($update == 1)
                                html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin_indexuser_update_screen') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Güncelle"><i class="fas fa-edit"></i></a>
                                    </div>`
                            @endif
                            @if ($delete == 1)
                                html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteIndexUser(${params.data.code}, '${params.data.name}')" data-toggle="tooltip" data-placement="right" title="Sil"><i class="fas fa-trash-alt"></i></a>
                                    </div>`

                                if (params.data.is_active === 1) {
                                    html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-danger btn-sm" href="{{ route('admin_indexuser_change_active') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Banla"><i class="fas fa-times-circle" ></i></a>
                                        </div>`;
                                } else {
                                    html +=
                                        `<div class="mr-2 ml-2">
                                                <a class="btn btn-success btn-sm" href="{{ route('admin_indexuser_change_active') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Banı Kaldır"><i class="fas fa-check-circle" ></i></a></div>`;
                                }
                            @endif
                            html += `</div>`;

                            return html;
                        },
                        filter: false,
                        cellEditorPopup: true,
                        cellEditor: 'agSelectCellEditor',
                        maxWidth: 250,
                        minWidth: 250,
                    },
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
