@extends('admin.layouts.main')
@section('admin_content')
    @if ($list == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="ag-theme-quartz mt-2 mb-2" style="height: 500px;" id="myGrid"></div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">..</th>
                                    <th scope="col">#</th>
                                    <th scope="col">İsim</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Konu</th>
                                    <th scope="col">Cevaplanma Durumu</th>
                                </tr>
                            </thead>
                            <tbody id="contactTableTbody">
                                @foreach ($contacts as $item)
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
                                                            onclick="deleteContact({{ $item->code }})">Sil</a>
                                                    @endif
                                                    @if ($answer == 1)
                                                        @if ($item->answered == 1)
                                                            <a class="dropdown-item" href="javascript:;"
                                                                onclick="notAnswerContact({{ $item->code }})">Cevaplanmadı
                                                                Olarak İşaretle</a>
                                                        @else
                                                            <a class="dropdown-item" href="javascript:;"
                                                                onclick="answerContact({{ $item->code }})">Cevaplandı
                                                                Olarak İşaretle</a>
                                                        @endif
                                                    @endif
                                                    <a class="dropdown-item" href="javascript:;"
                                                        onclick="showContact(`{{ $item->name }}`,`{{ $item->email }}`,`{{ $item->subject }}`,`{{ $item->message }}`)">Görüntüle</a>
                                                </div>
                                            </div>
                                        </td>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->subject }}</td>
                                        <td>
                                            @if ($item->answered == 1)
                                                <span class="badge badge-pill badge-success">Cevaplandı</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Cevaplanmadı</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="float-right">
                            <ul class="pagination">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div hidden>
            <!-- Large modal -->
            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal"
                data-target=".showContact" id="showContactButton">Modal demo</button>
        </div>
        <!--  Modal content for the above example -->
        <div class="modal fade showContact" tabindex="-1" role="dialog" aria-labelledby="showContactLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="showContactLabel">İletişim</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <h3>Kişi Bilgileri:</h3>
                            <p>İsim: <strong id="showContactName"></strong></p>
                            <p>E-mail: <strong id="showContactMail"></strong></p>
                        </div>
                        <hr>
                        <div>
                            <div>
                                <p style="font-size: 1.5em; font-weight: bold;">&emsp; <span id="showContactSubject"></span>
                                </p>
                            </div>
                            <hr>
                            <p>&nbsp;&emsp;
                                <span id="showContactMessage" style="word-wrap: break-word;">

                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                            Kapat
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script src="../../../admin/assets/libs/jquery/jquery.min.js"></script>
        <!-- Sayfa Değiştirme Scripti-->
        <script>
            var currentPage = 1;
            var pageCount = 1;

            function changePage(page) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_contact_get_data') }}',
                    data: {
                        page: page
                    },
                    success: function(response) {
                        var id = page <= 1 ? 1 : (page - 1) * 10 + 1;
                        var contacts = response.contacts;
                        var page_count = response.pageCount;
                        rowData = [];
                        for (let i = 0; i < contacts.length; i++) {

                            var rowItem = {
                                id: id++,
                                code: sendData(contacts[i].code),
                                answered: sendData(contacts[i].answered),
                                name: sendData(contacts[i].name),
                                email: sendData(contacts[i].email),
                                subject: sendData(contacts[i].subject),
                                message: sendData(contacts[i].message)
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
                function deleteContact(code, name) {
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
                                `<form action='{{ route('admin_contact_delete') }}' method="POST" id="deleteContactForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteContactForm').submit();
                        }
                    })
                }
            @endif

            @if ($answer == 1)
                function answerContact(code) {
                    Swal.fire({
                        title: 'Emin Misin?',
                        text: 'Bu İleitşimi Cevaplandı Olarak İşaretlemek İstiyor musunuz(ID: ' + code + ')?',
                        icon: 'warning',
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Onayla',
                        denyButtonText: `Vazgeç`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            var html =
                                `<form action='{{ route('admin_contact_answer') }}' method="POST" id="answerContactForm"> @csrf`;
                            html += `<input type="text" name="answered" value='1'>`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('answerContactForm').submit();
                        }
                    })
                }

                function notAnswerContact(code) {
                    Swal.fire({
                        title: 'Emin Misin?',
                        text: 'Bu İleitşimi Cevaplanmadı Olarak İşaretlemek İstiyor musunuz(ID: ' + code + ')?',
                        icon: 'warning',
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Onayla',
                        denyButtonText: `Vazgeç`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            var html =
                                `<form action='{{ route('admin_contact_answer') }}' method="POST" id="answerContactForm"> @csrf`;
                            html += `<input type="text" name="answered" value='0'>`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('answerContactForm').submit();
                        }
                    })
                }
            @endif

            function showContact(name, email, subject, message) {
                document.getElementById('showContactName').innerText = name;
                document.getElementById('showContactMail').innerText = email;
                document.getElementById('showContactSubject').innerText = subject;
                document.getElementById('showContactMessage').innerText = message;
                document.getElementById('showContactButton').click();

            }
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
                        headerName: "İsim",
                        field: "name",
                    },
                    {
                        headerName: "E-mail",
                        field: "email",
                    },
                    {
                        headerName: "Konu",
                        field: "subject",
                    },
                    {
                        headerName: "Durumu",
                        field: "answered",
                        cellRenderer: function(params) {
                            if (params.data.answered === 1) {
                                return `<span class = "badge badge-pill badge-success"> Cevaplandı </span>`;
                            } else {
                                return `<span class = "badge badge-pill badge-danger"> Cevaplanmadı </span>`;
                            }
                        },
                    },
                    @if ($answer == 1 || $delete == 1)
                        {
                            headerName: "İşlemler",
                            field: "action",
                            cellRenderer: function(params) {
                                var html = `<div class="row" style="justify-content: center;">`
                                @if ($answer == 1)
                                    if (params.data.answered === 1) {
                                        html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-danger btn-sm" href="javascript:;"
                                                onclick="notAnswerContact(${params.data.code})"
                                                data-toggle="tooltip" data-placement="right" title="Cevaplanmadı olarak işaretle"><i class="fas fa-times-circle" ></i></a>
                                        </div>`;
                                    } else {
                                        html +=
                                            `<div class="mr-2 ml-2">
                                                <a class="btn btn-success btn-sm"href="javascript:;"
                                                onclick="answerContact(${params.data.code})"
                                                data-toggle="tooltip" data-placement="right" title="Cevaplandı Olarak İşaretle"><i class="fas fa-check-circle" ></i></a></div>`;
                                    }
                                @endif
                                @if ($delete == 1)
                                    html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteContact(${params.data.code}, '${params.data.name}')" data-toggle="tooltip" data-placement="right" title="Sil"><i class="fas fa-trash-alt"></i></a>
                                    </div>`
                                @endif
                                html += `<div class="mr-2 ml-2">
                                            <a class="btn btn-info btn-sm" href="javascript:;"
                                            onclick="showContact('${params.data.name}','${params.data.email}','${params.data.subject}',\`${params.data.message}\`)" data-toggle="tooltip" data-placement="right" title="Görüntüle"><i class="fas fa-eye"></i></a>
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
                    @endif
                ],
                defaultColDef: {
                    flex: 1, // Sütunların esnekliği
                    resizable: true,
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
