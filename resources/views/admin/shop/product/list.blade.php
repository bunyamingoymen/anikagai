@extends('admin.layouts.main')
@section('admin_content')
    @if ($list)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12" style="display: inline-block;">
                            @if ($create == 1)
                                <a class="btn btn-primary mb-3" style="float: right;"
                                    href="{{ route('admin_shop_product_create') }}">+ Yeni</a>
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
                    type: '{{$type}}'
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
                    url: '{{ route('admin_shop_product_get_data') }}',
                    data: pageData,
                    success: function(response) {
                        var id = page <= 1 ? 1 : (page - 1) * showingCount + 1;
                        rowData = [];
                        var items = response.items;
                        var page_count = response.page_count;
                        for (let i = 0; i < items.length; i++) {
                            var rowItem = {
                                id: id++,
                                code: sendData(items[i].code),
                                name: sendData(items[i].name),
                                price: sendData(items[i].price),
                                priceType: sendData(items[i].priceType),
                                is_approved: sendData(items[i].is_approved),
                                is_active: sendData(items[i].is_active),
                                description: sendData(items[i].description),
                            }

                            rowData.push(rowItem);
                        }

                        getOtherData(page_count, page);

                    }
                });

            }
        </script>

        <script>
            @if ($delete == 1)
                function deleteValue(code, name) {
                    Swal.fire({
                        title: 'Emin Misin?',
                        text: 'Bu Veriyi Silmek İstiyor musunuz( ' + name + ' )?',
                        icon: 'warning',
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Onayla',
                        denyButtonText: `Vazgeç`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            var html =
                                `<form action='{{ route('admin_shop_product_delete') }}' method="POST" id="deleteForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteForm').submit();
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
                    headerName: "Ürün İsmi",
                    field: "name",
                },
                {
                    headerName: "Ücret",
                    field: "price",
                    cellRenderer: function(params){
                        return params.data.price + ' ' + params.data.priceType;
                    }
                },
                {
                    headerName: "Onay Durumu",
                    field: "is_approved",
                    cellRenderer: function(params) {
                        if(params.data.is_approved == 1) return `<span class = "badge badge-pill badge-success"> Onaylı </span>`;
                        else return `<span class = "badge badge-pill badge-danger"> Onaylı Değil </span>`;
                    }
                },
                {
                    headerName: "Aktiflik Durumu",
                    field: "is_active",
                    cellRenderer: function(params) {
                        if(params.data.is_active == 1) return `<span class = "badge badge-pill badge-success"> Aktif </span>`;
                        else return `<span class = "badge badge-pill badge-danger"> Pasif </span>`;
                    }
                },
                @if ($update || $delete || $changeApproval || $changeActive)
                    {
                        headerName: "İşlemler",
                        field: "action",
                        cellRenderer: function(params) {
                            var html = `<div class="row" style="justify-content: center;">`
                            @if ($changeApproval)
                                if(params.data.is_approved == 1){
                                    html += `<div class="mr-2 ml-2">
                                                <a class="btn btn-danger btn-sm" href="{{ route('admin_shop_product_change_approval') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Ürünün Onayını Kaldır"><i class="fab fa-centos"></i></a>
                                            </div>`
                                }else{
                                    html += `<div class="mr-2 ml-2">
                                                <a class="btn btn-success btn-sm" href="{{ route('admin_shop_product_change_approval') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Ürünü Onayla"><i class="fas fa-certificate"></i></a>
                                            </div>`
                                }
                            @endif
                            @if ($changeActive)
                                if(params.data.is_active == 1){
                                    html += `<div class="mr-2 ml-2">
                                            <a class="btn btn-danger btn-sm" href="{{ route('admin_shop_product_change_active') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Ürünü Pasif Yap"><i class="fas fa-times-circle"></i></a>
                                        </div>`
                                }else{
                                    html += `<div class="mr-2 ml-2">
                                            <a class="btn btn-success btn-sm" href="{{ route('admin_shop_product_change_active') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Ürünü Aktif Yap"><i class="fas fa-check-circle"></i></a>
                                        </div>`
                                }
                            @endif
                            @if ($update)
                                html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin_shop_product_update') }}?code=${params.data.code}" data-toggle="tooltip" data-placement="right" title="Güncelle"><i class="fas fa-edit"></i></a>
                                    </div>`
                            @endif
                            @if ($delete)
                                html += `<div class="mr-2 ml-2">
                                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteValue('${params.data.code}', '${params.data.name}')" data-toggle="tooltip" data-placement="right" title="Sil"><i class="fas fa-trash-alt"></i></a>
                                    </div>`
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
            @if (!$list)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
