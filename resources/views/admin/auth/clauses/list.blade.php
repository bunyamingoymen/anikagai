@extends('admin.layouts.main')
@section('admin_content')
    @if (Auth::guard('admin')->user()->user_type == 0)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="" style="">
                            <a class="btn btn-primary mb-3" style="float: right;"
                                href="{{ route('admin_authclause_create_screen') }}">+ Yeni</a>
                        </div>


                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">..</th>
                                    <th scope="col">#</th>
                                    <th scope="col">Yazı</th>
                                    <th scope="col">Açıklama</th>
                                </tr>
                            </thead>
                            <tbody id="AuthClauseTableTbody">
                                @foreach ($clauses as $item)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ...
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:;"
                                                        onclick="deleteAuthClause({{ $item->code }})">Sil</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin_authclause_update_screen') }}?code={{ $item->code }}">Güncelle</a>
                                                </div>
                                            </div>
                                        </td>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $item->text }}</td>
                                        <td>{{ $item->description }}</td>
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
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_authclause_get_data') }}',
                    data: {
                        page: page
                    },
                    success: function(clauses) {
                        var code = ``;
                        var id = page <= 1 ? 1 : (page - 1) * 10 + 1;
                        for (let i = 0; i < clauses.length; i++) {

                            var clauses_code = sendData(categories[i].code);
                            var clauses_text = sendData(categories[i].text);
                            var clauses_description = sendData(categories[i].description);

                            code += `<tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        ...
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:;" onclick="deleteAuthClause(` +
                                clauses_code + `)">Sil</a>
                                        <a class="dropdown-item"
                                            href="{{ route('admin_authclause_update_screen') }}?code=` +
                                clauses_code + `">Güncelle</a>
                                    </div>
                                </div>
                            </td>
                            <th scope="row">` + id++ + `</th>
                            <td>` + clauses_text + `</td>
                            <td>` + clauses_description + `</td>
                        </tr>`;
                            document.getElementById('AuthClauseTableTbody').innerHTML = code;
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
            function deleteAuthClause(code) {
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
                            `<form action='{{ route('admin_authclause_delete') }}' method="POST" id="deleteAuthClauseForm"> @csrf`;
                        html += `<input type="text" name="code" value='` + code + `'>`;
                        html += `</form>`

                        document.getElementById('hiddenDiv').innerHTML = html;

                        document.getElementById('deleteAuthClauseForm').submit();
                    }
                })
            }
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if (Auth::guard('admin')->user()->user_type != 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
