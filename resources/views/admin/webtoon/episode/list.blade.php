@extends('admin.layouts.main')
@section('admin_content')
    @if ($list == 1)
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .select2-container .select2-selection--single {
                height: 40px !important;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 40px !important;
            }
        </style>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="" style="">
                            @if ($create == 1)
                                <a class="btn btn-primary mb-3" style="float: right;"
                                    href="{{ route('admin_webtoon_episodes_create_screen') }}">+
                                    Yeni</a>
                            @endif
                        </div>
                        <div class="col-lg-12" style="">
                            <div class="row">
                                <div class="ml-2 mr-2">
                                    <select name="selectWebtoon" id="selectWebtoon" style="width: 250px;">
                                    </select>
                                </div>
                                <div class="ml-2 mr-2">
                                    <input type="text" placeholder="Bölüm İsmi Ara...." name="webtoonSearch"
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
                                    <th scope="col">Webtoon</th>
                                    <th scope="col">Bölüm Adı</th>
                                    <th scope="col">Sezon</th>
                                    <th scope="col">Bölüm</th>
                                </tr>
                            </thead>
                            <tbody id="webtoonTableTbody">
                                @foreach ($webtoon_episodes as $item)
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
                                                            onclick="deleteWebtoonEpisde({{ $item->code }})">Sil</a>
                                                    @endif
                                                    @if ($update == 1)
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin_webtoon_episodes_update_screen') }}?code={{ $item->code }}">Güncelle</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>
                                            <img class="rounded-circle header-profile-user"
                                                src="../../../{{ $item->webtoon_image ?? '' }}" alt="{{ $item->name }}">
                                        </td>
                                        <td>{{ $item->webtoon_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->season_short }}</td>
                                        <td>{{ $item->episode_short }}</td>
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

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Sayfa Değiştirme ve Arama Komutları-->
        <script>
            var currentPage = 1;
            var is_select_webtoon = false;
            var selectedWebtoonCode = 0;
            var search = -1;
            var searchData = "";
            var changePagination = false;

            function changePage(page) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_webtoon_episodes_get_data') }}',
                    data: {
                        page: page,
                        is_select_webtoon: is_select_webtoon,
                        selectedWebtoonCode: selectedWebtoonCode,
                        search: search,
                        searchData: searchData
                    },
                    success: function(response) {
                        var webtoon_episode = response.webtoon_episode
                        var count = response.count;
                        alert(count);
                        var code = ``;
                        var id = page <= 1 ? 1 : (page - 1) * 10 + 1;
                        for (let i = 0; i < webtoon_episode.length; i++) {
                            var episode_count = sendData(webtoon_episode[i].code);
                            var episode_webtoon_image = sendData(webtoon_episode[i].webtoon_image);
                            var episode_webtoon_name = sendData(webtoon_episode[i].webtoon_name);
                            var episode_name = sendData(webtoon_episode[i].name);
                            var episode_season_short = sendData(webtoon_episode[i].season_short);
                            var episode_episode_short = sendData(webtoon_episode[i].episode_short);

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
                                    `<a class="dropdown-item" href="javascript:;" onclick="deleteWebtoonEpisde(` +
                                    episode_count + `)">Sil</a>`
                            @endif
                            @if ($update == 1)
                                code += `<a class="dropdown-item"
                                                href="{{ route('admin_webtoon_episodes_update_screen') }}?code=` +
                                    episode_count + `">Güncelle</a>`
                            @endif
                            code += `</div>
                                </div>
                            </td>
                            <th scope="row">` + id++ + `</th>
                            <td>
                                <img class="rounded-circle header-profile-user" src="../../../` +
                                episode_webtoon_image + `" alt="` + episode_webtoon_name + `">
                                </td>
                            <td>` + episode_webtoon_name + `</td>
                            <td>` + episode_name + `</td>
                            <td>` + episode_season_short + `</td>
                            <td>` + episode_episode_short + `</td>
                        </tr>`;
                            document.getElementById('webtoonTableTbody').innerHTML = code;

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

            $('#selectWebtoon').on("select2:select", function(e) {
                var data = e.params.data;
                is_select_webtoon = true;
                selectedWebtoonCode = parseInt(data.id)
                document.getElementById('searchWebtoonAllButton').disabled = false;
                changePagination = true;
                changePage(1);
            });
        </script>

        <!--Silme Komutları-->
        <script>
            @if ($delete == 1)
                function deleteWebtoonEpisde(code) {
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
                                `<form action='{{ route('admin_webtoon_episodes_delete') }}' method="POST" id="deleteWebtoonEpisdeForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteWebtoonEpisdeForm').submit();
                        }
                    })
                }
            @endif
        </script>

        <!--Select2 komutları-->
        <script>
            $(document).ready(function() {
                $('#selectWebtoon').select2({
                    ajax: {
                        url: '{{ route('admin_webtoon_get_data') }}', // Laravel controller endpoint'iniz
                        dataType: 'json',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token'ı ekle
                        },
                        data: function(params) {
                            return {
                                searchData: params.term,
                                page: 1,
                                search: -99,
                                // Diğer parametreleri burada ekleyebilirsiniz
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data.webtoons, function(webtoon) {
                                    return {
                                        id: webtoon.code,
                                        text: webtoon.name,
                                        image: webtoon.image
                                        // Diğer alanları burada ekleyebilirsiniz
                                    };
                                }),
                                pagination: {
                                    more: data.pageCount > 1 // Eğer daha fazla sayfa varsa true döndürün
                                }
                            };
                        },
                        cache: true
                    },
                    placeholder: 'Webtoon Ara...',
                    minimumInputLength: 3, // Minimum giriş uzunluğu
                    escapeMarkup: function(markup) {
                        return markup;
                    }, // Markdown işlemlerini önlemek için
                    templateResult: formatResult, // Sonuçları özelleştirmek için
                    templateSelection: formatResult, // Seçili öğeyi özelleştirmek için
                })

                function formatResult(webtoon) {
                    if (!webtoon.id) {
                        return webtoon.text;
                    }
                    // Resmi sonuçlarda göster
                    // Yan yana resim ve metni göster
                    var imageMarkup =
                        '<img class="rounded-circle header-profile-user" src="../../../../' +
                        webtoon
                        .image +
                        '" alt="webtoon_image" />';
                    var textMarkup = '<div class="select2-result-webtoon__title">' +
                        webtoon.text + '</div>';

                    var markup = '<div class="row">' +
                        '<div class="ml-2 select2-result-webtoon__image-container">' + imageMarkup + '</div>' +
                        '<div class="select2-result-webtoon__text-container">' + textMarkup + '</div>' +
                        '</div>';

                    return markup;
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
