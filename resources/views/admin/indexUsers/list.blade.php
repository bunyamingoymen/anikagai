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
                                </tr>
                            </thead>
                            <tbody id="indexUserTableTbody">
                                @foreach ($indexUsers as $item)
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
                                                    @endif
                                                    @if ($update == 1)
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin_indexuser_update_screen') }}?code={{ $item->code }}">Güncelle</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <th scope="row">{{ $item->code }}</th>
                                        <td>
                                            <img class="rounded-circle header-profile-user"
                                                src="../../../{{ $item->image ?? 'user/img/profile/default.png' }}"
                                                alt="{{ $item->name }}">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
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
                        for (let i = 0; i < indexUsers.length; i++) {
                            code += `<tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        ...
                                    </button>
                                    <div class="dropdown-menu">`
                            @if ($delete == 1)
                                code += `<a class="dropdown-item" href="javascript:;" onclick="deleteIndexUser(` +
                                    indexUsers[i].code + `)">Sil</a>`
                            @endif
                            @if ($update == 1)
                                code +=
                                    `<a class="dropdown-item" href="{{ route('admin_indexuser_update_screen') }}?code=` +
                                    indexUsers[i].code + `">Güncelle</a>`
                            @endif

                            code += `</div>
                                </div>
                            </td>
                            <th scope="row">` + indexUsers[i].code + `</th>`
                            if (indexUsers[i].image.length != 0) {
                                code += `img class="rounded-circle header-profile-user"
                                src="../../../` + indexUsers[i].image + `"
                                alt="` + indexUsers[i].name + `">`
                            } else {
                                code += `img class="rounded-circle header-profile-user"
                                src="../../../user/img/profile/default.png"
                                alt="` + indexUsers[i].name + `">`
                            }
                            code += `<td>` + indexUsers[i].name + `</td>
                            <td>` + indexUsers[i].username + `</td>
                            <td>` + indexUsers[i].email + `</td>
                        </tr>`;
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
