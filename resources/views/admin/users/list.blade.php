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
                                    href="{{ route('admin_user_create_screen') }}">+
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

        <script src="{{ url('admin/assets/libs/jquery/jquery.min.js') }}"></script>

        <script src="{{ url('admin/assets/js/pageTable.js') }}"></script>
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
                    url: '{{ route('admin_user_get_data') }}',
                    data: {
                        page: page
                    },
                    success: function(response) {
                        var id = page <= 1 ? 1 : (page - 1) * parseInt("{{ Config::get('app.showCount') }}") + 1;
                        var users = response.users;
                        var page_count = response.pageCount;
                        rowData = [];
                        for (let i = 0; i < users.length; i++) {
                            var rowItem = {
                                id: id++,
                                code: sendData(users[i].code),
                                image: sendData(users[i].image),
                                name: sendData(users[i].name),
                                surname: sendData(users[i].surname),
                                email: sendData(users[i].email),
                                user_type: sendData(users[i].user_type)
                            }

                            rowData.push(rowItem);
                        }

                        getOtherData(page_count, page);

                    }
                });

            }
        </script>

        <!--Diğer İşlemler-->
        <script>
            function deleteUser(code, name) {
                @if ($delete == 1)
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
                                `<form action='{{ route('admin_user_delete') }}' method="POST" id="deleteUserForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteUserForm').submit();
                        }
                    })
                @endif

            }

            function changePassword(code) {
                @if ($update == 1 || Auth::guard('admin')->user()->code == $item->code)
                    Swal.fire({
                        title: '<strong>Şifre Değiştir</strong>',
                        icon: 'warning',
                        html: `
                <div class="col-lg-12 mt-2">
                    <input type="password" class="form-control" id="changePassword" placeholder="Şifre">
                </div>
                <div class="col-lg-12 mt-2">
                    <input type="password" class="form-control" id="changePasswordRepeat" placeholder="Şifre Tekrarı">
                </div>
                `,
                        showCancelButton: true,
                        confirmButtonText: 'Kaydet',
                        cancelButtonText: `Vazgeç`,
                    }).then((result) => {
                        if (result.value) {
                            var password = document.getElementById("changePassword").value;
                            var password_repeat = document.getElementById("changePasswordRepeat").value;
                            if (password != password_repeat) {
                                swal.close();
                                Swal.fire({
                                    title: 'Hata',
                                    icon: "error",
                                    text: 'Şifre ile şifre tekrarı aynı değil. Lütfen tekrar giriniz.',
                                    showCancelButton: false,
                                }).then((result) => {
                                    changePassword(code);
                                })
                            } else {
                                var html =
                                    `<form action='{{ route('admin_user_change_password') }}' method="POST" id="changePasswordUserForm"> @csrf`;
                                html += `<input type="text" name="code" value='` + code + `'>`;
                                html += `<input type="password" name="password" value='` + password + `'>`;
                                html += `</form>`

                                document.getElementById('hiddenDiv').innerHTML = html;

                                document.getElementById('changePasswordUserForm').submit();
                            }
                        }
                    })
                @endif
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
                    headerName: "İsim",
                    field: "name",
                },
                {
                    headerName: "Soyisim",
                    field: "surname",
                },
                {
                    headerName: "E-mail",
                    field: "email",
                },
                {
                    headerName: "Kullanıcı Grubu",
                    field: "user_type",
                },
                {
                    headerName: "İşlemler",
                    field: "action",
                    cellRenderer: function(params) {
                        var html = `<div class="row" style="justify-content: center;">`
                        @if ($update == 1 || Auth::guard('admin')->user()->code == $item->code)
                            html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin_user_update_screen') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Güncelle"><i class="fas fa-edit"></i></a>
                                    </div>
                                    <div class="mr-2 ml-2">
                                        <a class="btn btn-success btn-sm" href="javascript:;" onclick="changePassword(${params.data.code})" data-toggle="tooltip" data-placement="right" title="Şifre Değiştir"><i class="fas fa-key"></i></a>
                                    </div>`
                        @endif
                        @if ($delete == 1)
                            html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteUser(${params.data.code}, '${params.data.name}')" data-toggle="tooltip" data-placement="right" title="Sil"><i class="fas fa-trash-alt"></i></a>
                                    </div>`
                        @endif

                        html += `
                            <div class="mr-2 ml-2">
                                <a class="btn btn-info btn-sm" href="{{ route('admin_profile') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Görüntüle"><i class="fas fa-eye"></i></a>
                            </div>
                            <div class="mr-2 ml-2">
                                <a class="btn btn-secondary btn-sm" href="Javascript:;" onclick="sendMessage('${params.data.code}',0);" data-toggle="tooltip" data-placement="right" title="Mesaj Gönder"><i class="fas fa-envelope"></i></a>
                            </div>`
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
