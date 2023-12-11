<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('admin_index') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="../../../admin/assets/images/logo-dark.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="../../../admin/assets/images/logo-dark.png" alt="" height="22">
                    </span>
                </a>

                <a href="{{ route('admin_index') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="../../../admin/assets/images/logo-sm-light.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="../../../admin/assets/images/logo-light.png" alt="" height="35">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-backburger"></i>
            </button>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="mdi mdi-bell-outline"></i>
                    @if ($notificationAdminCount > 0)
                        <span class="badge badge-danger badge-pill">{{ $notificationAdminCount }}</span>
                    @endif

                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 font-weight-medium text-uppercase"> Bildirimler </h6>
                            </div>
                            <div class="col-auto">
                                <span class="badge badge-pill badge-danger">Okunmamış
                                    {{ $notificationAdminCount }}</span>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        @foreach ($notificationAdmin as $item)
                            <a href="Javascript:;"
                                onclick="readMessage('{{ $item->from_user_name . ' ' . $item->from_user_surname }}','{{ $item->notification_title }}','{{ $item->notification_text }}','{{ $item->code }}','{{ $item->from_user_code }}');"
                                class="text-reset notification-item">
                                <div class="media">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="mdi mdi-message-processing-outline"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="row">
                                            <div>
                                                <h6 class="mt-0 mb-1">{{ $item->notification_title }}</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">{{ $item->notification_text }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="p-2 border-top">
                        <a class="btn-link btn btn-block text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-down-circle mr-1"></i> Daha Fazla..
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="../../../{{ Auth::guard('admin')->user()->image }}" alt="Header Avatar">
                    <span class="d-none d-sm-inline-block ml-1">{{ Auth::guard('admin')->user()->name }}
                        {{ Auth::guard('admin')->user()->surname }}</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('admin_profile') }}"><i
                            class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i>Profil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('admin_logout') }}"><i
                            class="mdi mdi-logout font-size-16 align-middle mr-1"></i>
                        Çıkış Yap</a>
                </div>
            </div>

        </div>
    </div>
</header>

<div hidden>
    <!-- Large modal -->
    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal"
        data-target=".notificationModal" id="notificationModalButton">Modal</button>
</div>

<!--  Modal content for the above example -->
<div class="modal fade notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="notificationModalLabel">Bildirimler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="notification-modal">
                    <p id="notification_from_user"><strong>Gönderen: </strong> </p>

                    <p id="notification_from_title"><strong>Başlık: </strong> </p>

                    <p id="notification_from_message"><strong>Mesaj: </strong> </p>


                </div>
            </div>
            <div class="modal-footer" id="notification_modal_buttons">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    function readMessage(from_user, title, message, notificaiton_code, from_user_code) {
        document.getElementById("notification_from_user").innerHTML = `<strong>Gönderen: </strong>` + from_user;
        document.getElementById("notification_from_title").innerHTML = `<strong>Başlık: </strong>` + title;
        document.getElementById("notification_from_message").innerHTML = `<strong>Mesaj: </strong>` + message;
        document.getElementById("notification_modal_buttons").innerHTML = `<button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Tamam</button>
        <button class="btn btn-success" onclick="sendReadedMessage(` + notificaiton_code + `)">Okundu Olarak İşaretle</button>
        <button class="btn btn-danger" onclick="sendMessage(` + from_user_code + `,` + notificaiton_code +
            `)">Cevapla</button>`;
        document.getElementById("notificationModalButton").click();
    }

    function sendReadedMessage(notificaiton_code) {
        var html =
            `<form action='{{ route('admin_read_notification') }}' method="POST" id="readNotificationForm"> @csrf`;
        html += `<input type="text" name="code" value='` + notificaiton_code + `'>`;
        html += `</form>`

        document.getElementById('hiddenDiv').innerHTML = html;

        document.getElementById('readNotificationForm').submit();
    }

    function sendMessage(user_code, answer) {
        $('.notificationModal').modal('hide');
        Swal.fire({
            title: '<strong>Mesaj Gönder</strong>',
            icon: 'info',
            html: `
        <div class="col-lg-12 mt-2">
            <input type="text" class="form-control" id="sendMessageTitle" placeholder="Mesaj Başlığı">
        </div>
        <div class="col-lg-12 mt-2">
            <textarea class="form-control" name="sendMessage" id="sendMessage" cols="30" rows="10"
                placeholder="Mesaj"></textarea>
        </div>
        `,
            showCancelButton: true,
            confirmButtonText: 'Kaydet',
            cancelButtonText: `Vazgeç`,
        }).then((result) => {
            if (result.value) {
                var sendMessageTitle = document.getElementById("sendMessageTitle").value;
                var sendMessage = document.getElementById("sendMessage").value;

                var html =
                    `<form action='{{ route('admin_send_message') }}' method="POST" id="sendMessageForm"> @csrf`;
                html += `<input type="text" name="to_user_code" value='` + user_code + `'>`;
                html += `<input type="text" name="notification_title" value='` + sendMessageTitle + `'>`;
                html += `<input type="text" name="answer" value='` + answer + `'>`;
                html += `<textarea class="form-control" name="notification_text" id="notification_text" cols="30" rows="10"
                placeholder="Mesaj">` + sendMessage + `</textarea>`
                html += `</form>`

                document.getElementById('hiddenDiv').innerHTML = html;

                document.getElementById('sendMessageForm').submit();
            }
        })
    }
</script>
