@extends("admin.layouts.main")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body row">
                <div class="col-xl-3 col-md-4">
                    <div class="text-center card-box shadow-none border border-secoundary">
                        <div class="member-card">
                            <div class="avatar-xl member-thumb mb-3 mx-auto d-block">
                                <img src="../../../{{$user->image}}" class="rounded-circle img-thumbnail"
                                    alt="profile-image">
                                @if ($user->deleted == 0)
                                <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                                @else
                                <i class="mdi mdi-star-circle member-star text-danger" title="deleted user"></i>
                                @endif
                            </div>

                            <div class="">
                                <h5 class="font-18 mb-1">{{$user->name." ".$user->surname}}</h5>
                                @if ($user->deleted == 1)
                                <p class="text-danger">Silinmiş Kullanıcı</p>
                                @endif
                            </div>

                            @if ($user == Auth::guard('admin')->user())
                            <a class="btn btn-primary btn-sm width-sm waves-effect mt-2 waves-light"
                                href="{{route('admin_user_update_screen')}}?code={{$user->code}}">Bilgileri
                                Değiştir</a>
                            <button type="button"
                                class="btn btn-secondary btn-sm width-sm waves-effect mt-2 waves-light"
                                onclick="changePassword({{$user->code}})">Şifre
                                Güncelle</button>
                            @else
                            @if($followed==1 )
                            <button type="button" class="btn btn-danger btn-sm width-sm waves-effect mt-2 waves-light"
                                onclick="unfollowUser()">Takipten
                                Çıkar</button>
                            @else
                            <button type="button" class="btn btn-success btn-sm width-sm waves-effect mt-2 waves-light"
                                onclick="followUser()">Takip
                                Et</button>
                            @endif


                            <button type="button" class="btn btn-info btn-sm width-sm waves-effect mt-2 waves-light"
                                onclick="sendMessage('{{$user->code}}',0);">Mesaj Gönder</button>
                            @endif

                            <p class="blockquote mt-3" style="font-size: 13px">
                                {{$user->description ?? ''}}
                            </p>

                            <hr />

                            <div class="text-left ml-2 mr-2">
                                <p class="text-muted" style="font-size: 13px"><strong>Tam İsim :</strong> <span
                                        class="ml-4">{{$user->name." ".$user->surname}}</span></p>

                                <p class="text-muted" style="font-size: 12px"><strong>E-mail :</strong> <span
                                        class="ml-4" style="font-size: 12px">{{$user->email}}</span></p>

                            </div>

                            <ul class="social-links list-inline mt-4">
                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="btn btn-light" href=""
                                        data-original-title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="btn btn-light" href=""
                                        data-original-title="Twitter"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="btn btn-light" href=""
                                        data-original-title="Skype"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a title="" data-placement="top" data-toggle="tooltip" class="btn btn-light" href=""
                                        data-original-title="Skype"><i class="fab fa-discord"></i></a>
                                </li>
                            </ul>

                        </div>

                    </div>
                    <!-- end card-box -->

                </div>
                <!-- end col -->

                <div class="col-xl-9 col-md-8">

                    <div class="row">
                        <div class="col-xl-8">
                            <h5 class="header-title">Eklediği Animeler</h5>

                            <div class=" pt-2">
                                <h5 class="font-16 mb-1">Lead designer / Developer</h5>
                                <p class="mb-0">websitename.com</p>
                                <p><b>2010-2015</b></p>

                                <p class="sub-header">Lorem Ipsum is simply dummy text of the
                                    printing and typesetting industry. Lorem Ipsum has been the
                                    industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a
                                    type specimen book.
                                </p>
                            </div>

                            <hr />

                            <h5 class="header-title">Eklediği Anime Bölümleri</h5>

                            <div class=" pt-2">
                                <h5 class="font-16 mb-1">Lead designer / Developer</h5>
                                <p class="mb-0">websitename.com</p>
                                <p><b>2010-2015</b></p>

                                <p class="sub-header">Lorem Ipsum is simply dummy text of the
                                    printing and typesetting industry. Lorem Ipsum has been the
                                    industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a
                                    type specimen book.
                                </p>
                            </div>

                            <hr />

                            <h5 class="header-title">Eklediği Webtoonlar</h5>

                            <div class=" pt-2">
                                <h5 class="font-16 mb-1">Lead designer / Developer</h5>
                                <p class="mb-0">websitename.com</p>
                                <p><b>2010-2015</b></p>

                                <p class="sub-header">Lorem Ipsum is simply dummy text of the
                                    printing and typesetting industry. Lorem Ipsum has been the
                                    industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a
                                    type specimen book.
                                </p>
                            </div>

                            <hr />

                            <h5 class="header-title">Eklediği Webtoon Bölümleri</h5>

                            <div class=" pt-2">
                                <h5 class="font-16 mb-1">Lead designer / Developer</h5>
                                <p class="mb-0">websitename.com</p>
                                <p><b>2010-2015</b></p>

                                <p class="sub-header">Lorem Ipsum is simply dummy text of the
                                    printing and typesetting industry. Lorem Ipsum has been the
                                    industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a
                                    type specimen book.
                                </p>
                            </div>
                        </div>


                        <!-- end col -->

                        <div class="col-xl-4">
                            <h5 class="header-title">Takip Ettikleri</h5>

                            <div class="inbox-widget">
                                @foreach ($followed_users as $item)
                                <div>
                                    <div class="media mb-3">
                                        <img class="d-flex mr-3 avatar-md rounded-circle"
                                            src="../../../{{$item->user_image}}" alt="" height="64">
                                        <div class="media-body">
                                            <p style="text-align: left;">{{$item->user_name.' '.$item->user_surname}}
                                            </p>
                                            <div class="row">

                                                <div>
                                                    <p class="pl-2 pr-2 pt-1 text-muted"
                                                        style="text-align: left; font-size: 12px;">
                                                        {{$item->user_surname}}</p>
                                                </div>
                                                <div>
                                                    <a href="{{route('admin_profile')}}?code={{$item->user_code}}"
                                                        class="btn btn-sm btn-info">Görüntüle</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end col -->

            </div>
        </div>
    </div>
</div>
<script>
    function changePassword(code){
        Swal.fire({
            title: '<strong>Şifre Değiştir</strong>',
            icon: 'warning',
            html:
            `
            <div class="col-lg-12 mt-2">
                <input type="password" class="form-control" id="changePassword" placeholder="Şifre">
            </div>
            <div class="col-lg-12 mt-2">
                <input type="password" class="form-control" id="changePasswordRepeat" placeholder="Şifre Tekrarı">
            </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Kaydet',
            cancelButtonText: `Vazgeç`,
        }).then((result) => {
            if(result.value){
                var password = document.getElementById("changePassword").value;
                var password_repeat = document.getElementById("changePasswordRepeat").value;
                if(password != password_repeat){
                swal.close();
                Swal.fire({
                    title: 'Hata',
                    icon:"error",
                    text: 'Şifre ile şifre tekrarı aynı değil. Lütfen tekrar giriniz.',
                    showCancelButton: false,
                }).then((result) => {
                    changePassword(code);
                })
                }else{
                    var html = `<form action='{{route("admin_user_change_password")}}' method="POST" id="changePasswordUserForm"> @csrf`;
                        html += `<input type="text" name="code" value='`+code+`'>`;
                        html += `<input type="password" name="password" value='`+password+`'>`;
                        html += `</form>`

                    document.getElementById('hiddenDiv').innerHTML = html;

                    document.getElementById('changePasswordUserForm').submit();
                }
            }
        })
    }

    function followUser() {
        var html = `<form action='{{route("admin_follow_user")}}' method="POST" id="followUserChangeForm"> @csrf`;
            html += `<input type="text" name="followed_user_code" value='{{$user->code ?? ''}}'>`;
            html += `</form>`

        document.getElementById('hiddenDiv').innerHTML = html;

        document.getElementById('followUserChangeForm').submit();
    }

    function unfollowUser() {
        var html = `<form action='{{route("admin_unfollow_user")}}' method="POST" id="unfollowUserChangeForm"> @csrf`;
            html += `<input type="text" name="followed_user_code" value='{{$user->code ?? ''}}'>`;
            html += `</form>`

        document.getElementById('hiddenDiv').innerHTML = html;

        document.getElementById('unfollowUserChangeForm').submit();
    }
</script>
@endsection