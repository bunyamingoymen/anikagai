@extends("admin.layouts.main")
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
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        ...
                                    </button>
                                    <div class="dropdown-menu">
                                        @if ($delete == 1)
                                        <a class="dropdown-item" href="javascript:;"
                                            onclick="deleteContact({{$item->code}})">Sil</a>
                                        @endif
                                        @if ($answer == 1)
                                        @if ($item->answered == 1)
                                        <a class="dropdown-item" href="javascript:;"
                                            onclick="notAnswerContact({{$item->code}})">Cevaplanmadı Olarak İşaretle</a>
                                        @else
                                        <a class="dropdown-item" href="javascript:;"
                                            onclick="answerContact({{$item->code}})">Cevaplandı Olarak İşaretle</a>
                                        @endif
                                        @endif
                                        <a class="dropdown-item" href="javascript:;"
                                            onclick="showContact({{$item->code}})">Görüntüle</a>
                                    </div>
                                </div>
                            </td>
                            <th scope="row">{{$item->code}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->subject}}</td>
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
                        <li class="page-item">
                            <a class="page-link" href="javascript:;" onclick="prevPage();" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for ($i = 1;$i<=$pageCount; $i++) @if($i==1) <li class="page-item active" id="pagination1">
                            <a class="page-link" href="javascript:;" onclick="changePage(1)">
                                1
                            </a>
                            </li>
                            @else
                            <li class="page-item" id="pagination{{$i}}">
                                <a class="page-link " href="javascript:;" onclick="changePage({{$i}})">
                                    {{$i}}
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
    function changePage(page){
        console.log(page);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{route("admin_contact_get_data")}}',
            data:{ page:page},
            success: function(contacts) {
                var code = ``;
                for(let i = 0; i<contacts.length; i++){
                    code += `<tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        ...
                                    </button>
                                    <div class="dropdown-menu">`
                                        @if ($delete == 1)
                                            code += `<a class="dropdown-item" href="javascript:;" onclick="deleteContact(`+contacts[i].code+`)">Sil</a>`
                                        @endif
                                        @if ($answer == 1)
                                            if (contacts[i].answered == 1) {
                                                code += `<a class="dropdown-item" href="javascript:;" onclick="notAnswerContact(`+contacts[i].code+`)">Cevaplanmadı Olarak
                                                    İşaretle</a>`
                                            } else {
                                                code += `<a class="dropdown-item" href="javascript:;" onclick="answerContact(`+contacts[i].code+`)">Cevaplandı Olarak İşaretle</a>`
                                            }
                                        @endif
                            code += `</div>
                                </div>
                            </td>
                            <th scope="row">`+contacts[i].code+`</th>
                            <td>`+contacts[i].name+`</td>
                            <td>`+contacts[i].email+`</td>
                            <td>`+contacts[i].subject+`</td>
                            <td>`
                                if(contacts[i].answered == 1){
                                    code += `<span class="badge badge-pill badge-success">Cevaplandı</span>`
                                }else{
                                    code += `<span class="badge badge-pill badge-danger">Cevaplanmadı</span>`
                                }
                            `</td>
                        </tr>`;
                    document.getElementById('contactTableTbody').innerHTML = code;
                }

                currentPaginationId = 'pagination'+currentPage;
                paginationId = 'pagination'+page;

                document.getElementById(currentPaginationId).classList.remove("active");
                document.getElementById(paginationId).classList.add("active");

                currentPage = page;

            }
        });

    }

    function prevPage(){
        if(currentPage > 1 )
            changePage(currentPage + -1)
    }

    function nextPage(){
        if(currentPage < "{{$pageCount}}" ) changePage(currentPage + 1)
    }
</script>

<script>
    @if ($delete == 1)
        function deleteContact(code){
            Swal.fire({
                title: 'Emin Misin?',
                text: 'Bu Veriyi Silmek İstiyor musunuz(ID: '+code+')?',
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Onayla',
                denyButtonText: `Vazgeç`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var html = `<form action='{{route('admin_contact_delete')}}' method="POST" id="deleteContactForm"> @csrf`;
                        html += `<input type="text" name="code" value='`+code+`'>`;
                        html += `</form>`

                    document.getElementById('hiddenDiv').innerHTML = html;

                    document.getElementById('deleteContactForm').submit();
                }
            })
        }
    @endif

    @if ($answer == 1)
        function answerContact(code){
                Swal.fire({
                    title: 'Emin Misin?',
                    text: 'Bu İleitşimi Cevaplandı Olarak İşaretlemek İstiyor musunuz(ID: '+code+')?',
                    icon: 'warning',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Onayla',
                    denyButtonText: `Vazgeç`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        var html = `<form action='{{route('admin_contact_answer')}}' method="POST" id="answerContactForm"> @csrf`;
                            html += `<input type="text" name="answered" value='1'>`;
                            html += `<input type="text" name="code" value='`+code+`'>`;
                            html += `</form>`

                        document.getElementById('hiddenDiv').innerHTML = html;

                        document.getElementById('answerContactForm').submit();
                    }
            })
        }

        function notAnswerContact(code){
            Swal.fire({
                title: 'Emin Misin?',
                text: 'Bu İleitşimi Cevaplanmadı Olarak İşaretlemek İstiyor musunuz(ID: '+code+')?',
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Onayla',
                denyButtonText: `Vazgeç`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var html = `<form action='{{route('admin_contact_answer')}}' method="POST" id="answerContactForm"> @csrf`;
                        html += `<input type="text" name="answered" value='0'>`;
                        html += `<input type="text" name="code" value='`+code+`'>`;
                        html += `</form>`

                    document.getElementById('hiddenDiv').innerHTML = html;

                    document.getElementById('answerContactForm').submit();
                }
            })
        }
    @endif

    //TODO
    function showContact(code){
            Swal.fire({
            title: 'Emin Misin?',
            text: 'Bu Veriyi Silmek İstiyor musunuz(ID: '+code+')?',
            icon: 'warning',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Onayla',
            denyButtonText: `Vazgeç`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
            var html = `<form action='{{route('admin_contact_delete')}}' method="POST" id="deleteContactForm"> @csrf`;
                html += `<input type="text" name="code" value='`+code+`'>`;
                html += `</form>`

            document.getElementById('hiddenDiv').innerHTML = html;

            document.getElementById('deleteContactForm').submit();
            }
            })
    }
</script>

@endif
<script>
    // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
    window.addEventListener('DOMContentLoaded', (event) => {
        // Değişkenin değerini kontrol et
        @if ($list == 0)
            // Değişken doğru ise yönlendirme yap
            window.location.href = '{{route("admin_index")}}';
        @endif
    });
</script>

@endsection