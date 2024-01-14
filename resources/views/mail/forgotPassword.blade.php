<!DOCTYPE html>
<html>

<head>
    <title>{{ $subject }}</title>
</head>

<body>
    <h1>Merhaba, {{ $name }}</h1>

    <div>
        <img src="{{ $logo }}" alt="">
        <p>Şifrenizi unuttuğunuza dair bildirim aldık.</p>
        <p>Lütfen ilk girişinizde şifrenizi değiştiriniz.</p>
        <p>Yeni Şifreniz: {{ $password }}</p>
    </div>
</body>

</html>
