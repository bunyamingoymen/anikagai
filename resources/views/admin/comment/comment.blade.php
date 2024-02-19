@extends('admin.layouts.main')
@section('admin_content')
    @if ($list == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">..</th>
                                    <th scope="col">#</th>
                                    <th scope="col">Yorum</th>
                                    <th scope="col">Yorum Sırası</th>
                                    <th scope="col">Durumu</th>
                                </tr>
                            </thead>
                            <tbody id="commentTableTbody">
                                @foreach ($comments as $item)
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
                                                            onclick="deleteComment({{ $item->code }})">Sil</a>
                                                        @if ($item->is_active == 1)
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin_comment_change_active') }}?code={{ $item->code }}">Pasif
                                                                Hale Getir</a>
                                                        @else
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin_comment_change_active') }}?code={{ $item->code }}">Aktif
                                                                Hale Getir</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $item->message }}</td>
                                        <td>{{ $item->comment_short }}</td>
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
                    url: '{{ route('admin_comment_get_data') }}',
                    data: {
                        page: page
                    },
                    success: function(comments) {
                        var code = ``;
                        var id = page <= 1 ? 1 : (page - 1) * 10 + 1;
                        for (let i = 0; i < comments.length; i++) {

                            var comments_code = sendData(comments[i].code);
                            var comments_message = sendData(comments[i].message);
                            var comments_comment_short = sendData(comments[i].comment_short);
                            var comments_is_active = sendData(comments[i].is_active);

                            code += `<tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        ...
                                    </button>
                                    <div class="dropdown-menu">`
                            @if ($delete == 1)
                                code += `<a class="dropdown-item" href="javascript:;" onclick="deleteComment(` +
                                    comments_code + `)">Sil</a>`
                                if (indexUsers_is_active == 1) {
                                    code +=
                                        `<a class="dropdown-item" href="{{ route('admin_comment_change_active') }}?code=${indexUsers_code}">Pasif Hale Getir</a>`;
                                } else {
                                    code +=
                                        `<a class="dropdown-item" href="{{ route('admin_comment_change_active') }}?code=${indexUsers_code}">Aktif Hale Getir</a>`;
                                }
                            @endif
                            code += `</div>
                                </div>
                            </td>
                            <th scope="row">` + id++ + `</th>
                            <td>` + comments_message + `</td>
                            <td>` + comments_comment_short + `</td>`
                            code += ` <td>`;
                            if (indexUsers_is_active == 1)
                                code += `<span class = "badge badge-pill badge-success" > Aktif </span>`
                            else
                                code += `<span class = "badge badge-pill badge-success" > Pasif </span>`
                            code += `</td>`;

                            code += `</tr>`;
                            document.getElementById('commentTableTbody').innerHTML = code;
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
            @if ($delete == 1)
                function deleteComment(code) {
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
                                `<form action='{{ route('admin_comment_delete') }}' method="POST" id="deleteCommentForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteCommentForm').submit();
                        }
                    })
                }
            @endif
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
