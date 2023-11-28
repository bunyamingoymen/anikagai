var controlIsUsername = false;
var controlIsEmail = false;
function controlUsername() {
    var username = document.getElementById("registerUsername").value;
    if (username.length < 3) {
        document.getElementById("controlUsernameText").innerText =
            "Kullanılamaz";
        document.getElementById("controlUsernameText").style.color = "red";
        controlIsUsername = false;
    } else {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
        });
        $.ajax({
            type: "POST",
            url: '{{route("index_control_username")}}',
            data: { username: username },
            success: function (control) {
                if (control.control) {
                    document.getElementById("controlUsernameText").innerText =
                        "Kullanılabilir";
                    document.getElementById("controlUsernameText").style.color =
                        "green";
                } else {
                    document.getElementById("controlUsernameText").innerText =
                        "Kullanılamaz";
                    document.getElementById("controlUsernameText").style.color =
                        "red";
                }

                controlIsUsername = control.control;
            },
        });
    }
}

function controlEmail() {
    var email = document.getElementById("registerEmail");
    var value = email.value;
    if (!email.checkValidity() || value.length == 0) {
        document.getElementById("controlEmailText").innerText = "Kullanılamaz";
        document.getElementById("controlEmailText").style.color = "red";
        controlIsUsername = false;
    } else {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
        });
        $.ajax({
            type: "POST",
            url: '{{route("index_control_email")}}',
            data: { email: value },
            success: function (control) {
                if (control.control) {
                    document.getElementById("controlEmailText").innerText =
                        "Kullanılabilir";
                    document.getElementById("controlEmailText").style.color =
                        "green";
                } else {
                    document.getElementById("controlEmailText").innerText =
                        "Kullanılamaz";
                    document.getElementById("controlEmailText").style.color =
                        "red";
                }

                controlIsEmail = control.control;
            },
        });
    }
}

function registerSubmitFormButton() {
    var name = document.getElementById("registerName").value;
    var username = document.getElementById("registerUsername").value;
    var email = document.getElementById("registerEmail").value;
    var password = document.getElementById("registerPassword").value;
    var password_repeat = document.getElementById(
        "registerPassword_repeat"
    ).value;

    if (
        name.length == 0 ||
        username.length == 0 ||
        email.length == 0 ||
        password.length == 0 ||
        password_repeat.length == 0
    ) {
        document.getElementById("registerMessageText").innerText =
            "Lütfen Tüm gerekli alanları doldurunuz.";
    } else if (controlIsUsername && controlIsEmail) {
        document.getElementById("registerSubmitForm").submit();
    } else {
        if (!controlIsUsername) {
            document.getElementById("registerMessageText").innerText =
                "Bu Kullanıcı adı alınamaz";
        } else if (password != password_repeat) {
            document.getElementById("registerMessageText").innerText =
                "Şifre İle Şifre Tekrarı aynı değil.";
        } else {
            document.getElementById("registerMessageText").innerText =
                "Bu E-mail adresi alınamaz";
        }
    }
}
