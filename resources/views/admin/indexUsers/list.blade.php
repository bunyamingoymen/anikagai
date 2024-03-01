@extends('admin.layouts.main')
@section('admin_content')
    @if ($list == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="" style="">
                            @if ($create == 1)
                                <a class="btn btn-primary mb-3" style="float: right;"
                                    href="{{ route('admin_indexuser_create_screen') }}">+
                                    Yeni</a>
                            @endif
                        </div>
                        <div class="col-lg-10" style="">
                            <div class="row">
                                <div class="ml-2 mr-2">
                                    <select name="userStatusSearch" id="userStatusSearch" class="form-control"
                                        onchange="searchStatus()">
                                        <option value="0">Tümü</option>
                                        <option value="1">Pasif</option>
                                        <option value="2">Aktif</option>
                                    </select>
                                </div>
                                <div class="ml-2 mr-2">
                                    <input type="text" placeholder="Üye Ara...." name="userSearch" id="userSearch"
                                        class="form-control" oninput="checkInput()">
                                </div>
                                <div class="ml-2 mr-2">
                                    <button class="btn btn-success" id="userSearchButton" onclick="searchUserButton()"
                                        disabled><i class="fas fa-search"></i> Ara</button>
                                </div>
                                <div class="ml-2 mr-2">
                                    <button class="btn btn-danger" id="searchUserAllButton" onclick="searchUserAllButton()"
                                        disabled> <i class="fas fa-align-center"></i>
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

        <script src="{{ url('admin/assets/js/pageTable.js') }}"></script>
        <!-- Sayfa Değiştirme Scripti-->

        <script>
            var is_status = 0; // 0: göstermez, 1: pasif, 2 : aktif
            var searchData = "";

            function changePage(page) {
                var pageData = {
                    page: page,
                }

                if (showingCount && showingCount != 10) pageData.showingCount = showingCount;

                if (is_status != 0) {
                    pageData.status = is_status
                };
                if (searchData.length > 0) pageData.searchData = searchData
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_indexuser_get_data') }}',
                    data: pageData,
                    success: function(response) {
                        var id = page <= 1 ? 1 : (page - 1) * showingCount + 1;
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

                        getOtherData(page_count, page);

                    },
                    error: function(error) {}
                });

            }

            function searchStatus() {
                var val = document.getElementById('userStatusSearch').value;
                if (parseInt(val) != is_status) {
                    is_status = parseInt(val);
                    changePage(1);
                    if (is_status != 0) document.getElementById('searchUserAllButton').disabled = false;
                }
            }

            function searchUserButton() {
                searchData = document.getElementById('userSearch').value;
                document.getElementById('userSearchButton').disabled = true;
                document.getElementById('searchUserAllButton').disabled = false;
                changePage(1);
            }

            function searchUserAllButton() {
                searchData = "";
                is_status = 0;
                document.getElementById('userStatusSearch').value = 0;
                document.getElementById('userSearchButton').disabled = true;
                document.getElementById('searchUserAllButton').disabled = true;
                changePage(1);
            }
        </script>

        <!--Arama İşlemi-->
        <script>
            function checkInput() {
                var inputField = document.getElementById('userSearch');
                var submitButton = document.getElementById('userSearchButton');

                // Input alanının değeri varsa, butonu aktif hale getir
                if (inputField.value.trim() !== '' && inputField.value !== searchData) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            }

            // Enter tuşuna basılınca formu gönder
            document.getElementById('userSearch').addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    searchUserButton();
                    if (searchData.length <= 0) {
                        document.getElementById('searchUserAllButton').disabled = true;
                    }
                }
            });
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
                        if (params.value.length > 0)
                            return `<img src="../../../${params.value}" alt="user" class="avatar-xs rounded-circle" />`;
                        else
                            return `<img src="../../../user/img/profile/default.png" alt="user" class="avatar-xs rounded-circle" />`;

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
                        if (params.data.is_active == 1) {
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

                            if (params.data.is_active == 1) {
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
