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
                                    href="{{ route('admin_webtoon_create_screen') }}">+ Yeni</a>
                            @endif
                        </div>
                        <div class="col-lg-12" style="">
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

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">..</th>
                                    <th scope="col">#</th>
                                    <th scope="col">Resim</th>
                                    <th scope="col">İsim</th>
                                    <th scope="col">Durumu</th>
                                    <th scope="col">Bölüm Sayısı</th>
                                    <th scope="col">Tıklanma Sayısı</th>
                                </tr>
                            </thead>
                            <tbody id="webtoonTableTbody">
                                @foreach ($webtoons as $item)
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
                                                            onclick="deleteWebtoon({{ $item->code }})">Sil</a>
                                                    @endif
                                                    @if ($update == 1)
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin_webtoon_update_screen') }}?code={{ $item->code }}">Güncelle</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>
                                            <img class="rounded-circle header-profile-user"
                                                src="../../../{{ $item->thumb_image ?? '' }}" alt="{{ $item->name }}">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if ($item->plusEighteen == 1)
                                                <span class="badge badge-pill badge-dark">+18</span>
                                            @endif

                                            @if ($item->showStatus == 0)
                                                <span class="badge badge-pill badge-success">Görünür</span>
                                            @elseif ($item->showStatus == 1)
                                                <span class="badge badge-pill badge-warning">Üyelere Özel</span>
                                            @elseif($item->showStatus == 2)
                                                <span class="badge badge-pill badge-secondary">Sansürlü</span>
                                            @elseif($item->showStatus == 3)
                                                <span class="badge badge-pill badge-primary">Liste Dışı</span>
                                            @elseif($item->showStatus == 4)
                                                <span class="badge badge-pill badge-danger">Gizli</span>
                                            @else
                                                <span class="badge badge-pill badge-light"><span
                                                        style="color:red;">HATA</span></span>
                                            @endif

                                        </td>
                                        <td>{{ $item->episode_count }}</td>
                                        <td>{{ $item->click_count }}</td>
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
                            code += ` <tr>
                                    <td>
                                    <div class = "btn-group">
                                    <button type = "button"class = "btn btn-danger dropdown-toggle"
                                            data-toggle = "dropdown" aria-haspopup = "true"
                                            aria-expanded = "false" >
                                        ...
                                    </button> <div class = "dropdown-menu" > `
                            @if ($delete == 1)
                                code += ` <a class = "dropdown-item"
                                href = "javascript:;"
                                onclick = "deleteWebtoon(` +
                                    webtoons_code + `)">Sil</a>`
                            @endif
                            @if ($update == 1)
                                code +=
                                    `<a class="dropdown-item" href="{{ route('admin_webtoon_update_screen') }}?code=` +
                                    webtoons_code + `">Güncelle</a>`
                            @endif
                            code += `</div>
                                        </div>
                                    </td>
                                    <td scope="row">` + id++ + `</td>
                                    <td>
                                        <img class="rounded-circle header-profile-user" src="../../../` +
                                webtoons_image +
                                `" alt="` + webtoons_name + `">
                                        </td>
                                    <td>` + webtoons_name + `</td>`
                            code += `<td>`
                            if (webtoons_plusEighteen == 1) {
                                code += `<span class="badge badge-pill badge-dark">+18</span>`;
                            }
                            if (webtoons_showStatus == 0) {
                                code += `<span class="badge badge-pill badge-success">Görünür</span>`;

                            } else if (webtoons_showStatus == 1) {
                                code += `<span class="badge badge-pill badge-warning">Üyelere Özel</span>`;
                            } else if (webtoons_showStatus == 2) {
                                code += `<span class="badge badge-pill badge-secondary">Sansürlü</span>`;
                            } else if (webtoons_showStatus == 3) {
                                code += `<span class="badge badge-pill badge-primary">Liste Dışı</span>`;
                            } else if (webtoons_showStatus == 4) {
                                code += `<span class="badge badge-pill badge-danger">Gizli</span>`;
                            } else {
                                code +=
                                    `<span class="badge badge-pill badge-light"><span style="color:red;">HATA</span></span>`;
                            }
                            code += `</td>`
                            code += `<td> ` + webtoons_episode_count + ` </td>`
                            code += `<td> ` + webtoons_click_count + ` </td> </tr > `;

                        }
                        document.getElementById('webtoonTableTbody').innerHTML = code;

                        if (search == 0) {
                            pageCount = parseInt(response.pageCount);
                        } else {
                            pageCount = parseInt("{{ $pageCount }}");
                        }

                        if (changePagination) {
                            newPageCount(pageCount);
                            if (search == 0) vsearch = 1;

                            changePagination = false;
                        }


                        if (pageCount > 0) {
                            currentPaginationId = 'pagination' + currentPage;
                            paginationId = 'pagination' + page;

                            document.getElementById(currentPaginationId).classList.remove("active");
                            document.getElementById(paginationId).classList.add("active");
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

            function newPageCount(new_page_count) {
                var pagination = document.getElementsByClassName('pagination')[0];
                var html = `<li class="page-item">
                                    <a class="page-link" href="javascript:;" onclick="prevPage();" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>`;
                for (let i = 1; i <= new_page_count; i++) {
                    html += `<li class="page-item" id="pagination` + i + `">
                                            <a class="page-link " href="javascript:;"
                                                onclick="changePage(` + i + `)">
                                                ` + i + `
                                            </a>
                                        </li>`;
                }

                html += ` <li class="page-item">
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
                function deleteWebtoon(code) {
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
