@extends("admin.layouts.main")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="" style="">
                    <h4 class="header-title">Kullanıcılar </h4>
                    <a class="btn btn-primary mb-3" style="float: right;" href="{{route('admin_user_create_screen')}}">+
                        Yeni</a>
                </div>


                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">..</th>
                            <th scope="col">#</th>
                            <th scope="col">İsim</th>
                            <th scope="col">Soyisim</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Kullanıcı Grubu</th>
                        </tr>
                    </thead>
                    <tbody id="userTableTbody">
                        @foreach ($users as $item)
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        ...
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:;"
                                            onclick="deleteUser({{$item->code}})">Sil</a>
                                        <a class="dropdown-item"
                                            href="{{route('admin_user_update_screen')}}?code={{$item->code}}">Güncelle</a>
                                    </div>
                                </div>
                            </td>
                            <th scope="row">{{$item->code}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->surname}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->user_type}}</td>
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
            url: '{{route("admin_user_get_data")}}',
            data:{ page:page},
            success: function(users) {
                var code = ``;
                for(let i = 0; i<users.length; i++){
                    code += `<tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        ...
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:;" onclick="deleteUser(`+users[i].code+`)">Sil</a>
                                        <a class="dropdown-item"
                                            href="{{route('admin_user_update_screen')}}?code=`+users[i].code+`">Güncelle</a>
                                    </div>
                                </div>
                            </td>
                            <th scope="row">`+users[i].code+`</th>
                            <td>`+users[i].name+`</td>
                            <td>`+users[i].surname+`</td>
                            <td>`+users[i].email+`</td>
                            <td>`+users[i].user_type+`</td>
                        </tr>`;
                    document.getElementById('userTableTbody').innerHTML = code;
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
    function deleteUser(code){
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
                var html = `<form action='{{route('admin_user_delete')}}' method="POST" id="deleteUserForm"> @csrf`;
                    html += `<input type="text" name="code" value='`+code+`'>`;
                    html += `</form>`

                document.getElementById('hiddenDiv').innerHTML = html;

                document.getElementById('deleteUserForm').submit();
            }
        })
    }
</script>

@endsection