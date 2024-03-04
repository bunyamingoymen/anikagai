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
                                    href="{{ route('admin_add_notifications_screen') }}">+ Yeni Bildirim Gönder</a>
                            @endif
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
            function changePage(page) {
                var pageData = {
                    page: page,
                }
                if (showingCount && showingCount != 10) {
                    pageData.showingCount = showingCount;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_notification_get_data') }}',
                    data: pageData,
                    success: function(response) {
                        var id = page <= 1 ? 1 : (page - 1) * showingCount + 1;
                        rowData = [];
                        var notifications = response.notifications;
                        var page_count = response.page_count;
                        for (let i = 0; i < notifications.length; i++) {
                            var rowItem = {
                                id: id++,
                                code: sendData(notifications[i].code),
                                title: sendData(notifications[i].notification_title),
                                text: sendData(notifications[i].notification_text),
                                start_date: sendData(notifications[i].notification_date),
                                end_date: sendData(notifications[i].notification_end_date),
                            }

                            rowData.push(rowItem);
                        }

                        getOtherData(page_count, page);

                    }
                });

            }
        </script>

        <!--Diğer komutlar-->
        <script>
            @if ($delete == 1)
                function deleteNotification(code, name) {
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
                                `<form action='{{ route('admin_delete_notifications') }}' method="POST" id="deleteNotificationForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteNotificationForm').submit();
                        }
                    })
                }
            @endif
        </script>

        <!--Ag-gird Komutları-->
        <script>
            var columnDefs = [{
                    headerName: "#",
                    field: "id",
                    maxWidth: 75,
                },
                {
                    headerName: "Başlık",
                    field: "title",
                },
                {
                    headerName: "Bildirim",
                    field: "text",
                },
                {
                    headerName: "Başlangıç Tarihi",
                    field: "start_date",
                },
                {
                    headerName: "Bitiş Tarihi",
                    field: "end_date",
                },
                @if ($delete == 1)
                    {
                        headerName: "İşlemler",
                        field: "action",
                        cellRenderer: function(params) {
                            return `<div class="row" style="justify-content: center;">
                                        <div class="mr-2 ml-2">
                                            <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteNotification(${params.data.code}, '${params.data.title}')" data-toggle="tooltip" data-placement="right" title="Sil"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>`;
                        },
                        filter: false,
                        cellEditorPopup: true,
                        cellEditor: 'agSelectCellEditor',
                        maxWidth: 125,
                        minWidth: 125,
                    },
                @endif
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
