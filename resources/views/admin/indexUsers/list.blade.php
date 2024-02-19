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


                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">..</th>
                                    <th scope="col">#</th>
                                    <th scope="col">Resim</th>
                                    <th scope="col">İsim</th>
                                    <th scope="col">Kullanıcı Adı</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Durumu</th>
                                </tr>
                            </thead>
                            <tbody id="indexUserTableTbody">
                                @foreach ($indexUserList as $item)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ...
                                                </button>
                                                <div class="dropdown-menu">
                                                    @if ($delete == 1)
                                                        <a class="dropdown-item" href="javascript:;"
                                                            onclick="deleteIndexUser({{ $item->code }})">Sil</a>
                                                        @if ($item->is_active == 1)
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin_indexuser_change_active') }}?code={{ $item->code }}">Pasif
                                                                Hale Getir</a>
                                                        @else
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin_indexuser_change_active') }}?code={{ $item->code }}">Aktif
                                                                Hale Getir</a>
                                                        @endif
                                                    @endif
                                                    @if ($update == 1)
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin_indexuser_update_screen') }}?code={{ $item->code }}">Güncelle</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>
                                            <img class="rounded-circle header-profile-user"
                                                src="../../../{{ $item->image ?? 'user/img/profile/default.png' }}"
                                                alt="{{ $item->name }}">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @if ($item->is_active == 1)
                                                <span class = "badge badge-pill badge-success"> Aktif </span>
                                            @else
                                                <span class = "badge badge-pill badge-danger"> Pasif </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="float-right">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="javascript:;" onclick="prevPage();" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $pageCount; $i++)
                                    @if ($i == 1)
                                        <li class="page-item active" id="pagination1">
                                            <a class="page-link" href="javascript:;" onclick="changePage(1)">
                                                1
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item" id="pagination{{ $i }}">
                                            <a class="page-link " href="javascript:;"
                                                onclick="changePage({{ $i }})">
                                                {{ $i }}
                                            </a>
                                        </li>
                                    @endif
                                @endfor

                                <li class="page-item">
                                    <a class="page-link" href="javascript:;" onclick="nextPage();" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
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
                    success: function(indexUsers) {
                        var code = ``;
                        var id = page <= 1 ? 1 : (page - 1) * 10 + 1;
                        for (let i = 0; i < indexUsers.length; i++) {

                            var indexUsers_code = sendData(indexUsers[i].code);
                            var indexUsers_image = sendData(indexUsers[i].image);
                            var indexUsers_name = sendData(indexUsers[i].name);
                            var indexUsers_username = sendData(indexUsers[i].username);
                            var indexUsers_email = sendData(indexUsers[i].email);
                            var indexUsers_is_active = sendData(indexUsers[i].is_active);

                            code += `<tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        ...
                                    </button>
                                    <div class="dropdown-menu">`
                            @if ($delete == 1)
                                code +=
                                    `<a class="dropdown-item" href="javascript:;" onclick="deleteIndexUser(${indexUsers_code})">Sil</a>`

                                if (indexUsers_is_active == 1) {
                                    code +=
                                        `<a class="dropdown-item" href="{{ route('admin_indexuser_change_active') }}?code=${indexUsers_code}">Pasif Hale Getir</a>`;
                                } else {
                                    code +=
                                        `<a class="dropdown-item" href="{{ route('admin_indexuser_change_active') }}?code=${indexUsers_code}">Aktif Hale Getir</a>`;
                                }
                            @endif
                            @if ($update == 1)
                                code +=
                                    `<a class="dropdown-item" href="{{ route('admin_indexuser_update_screen') }}?code=${indexUsers_code}">Güncelle</a>`
                            @endif

                            code += `</div>
                                </div>
                            </td>
                            <th scope="row">` + id++ + `</th>`
                            code += `<td>`
                            if (indexUsers_image.length > 0) {
                                code += `<img class="rounded-circle header-profile-user"
                                src="../../../` + indexUsers_image + `"
                                alt="` + indexUsers_name + `">`
                            } else {
                                code += `<img class="rounded-circle header-profile-user"
                                src="../../../user/img/profile/default.png"
                                alt="` + indexUsers_name + `">`
                            }
                            code += `</td>`
                            code += `<td>` + indexUsers_name + `</td>
                            <td>` + indexUsers_username + `</td>
                            <td>` + indexUsers_email + `</td>`
                            code += ` <td>`;
                            if (indexUsers_is_active == 1)
                                code += `<span class = "badge badge-pill badge-success" > Aktif </span>`
                            else
                                code += `<span class = "badge badge-pill badge-success" > Pasif </span>`
                            code += `</td>`;
                            code += `</tr>`;
                            document.getElementById('indexUserTableTbody').innerHTML = code;
                        }

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
                if (currentPage < "{{ $pageCount }}") changePage(currentPage + 1)
            }
        </script>

        <script>
            function deleteIndexUser(code) {
                @if ($delete == 1)
                    Swal.fire({
                        title: 'Emin Misin?',
                        text: 'Bu Veriyi Silmek İstiyor musunuz(ID: ' + code + ')?',
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
                @endif

            }
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
