@extends('admin.layouts.main')
@section('admin_content')
    @if ($logoData == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <p>Sitede gözüken bütün logo ve ikonları buradan değiştirebilirsiniz.</p>
                        <hr>
                        <div class="mt-3">
                            <h4>Logo: </h4>
                            <div class="row">
                                <div style="background-color: black;">
                                    <img src="../../../{{ $logo->value }}" alt="logo" style="max-height: 155px;">
                                </div>
                                <div class="ml-5">
                                    <button class="btn btn-primary" onclick="logoChangeButton()">Değiştir</button>
                                    <div hidden>
                                        <form action="{{ route('admin_data_logo') }}" method="POST"
                                            id="logoChangeSubmitForm" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="logo" id="logoChangeInput" accept="image/*">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-5">
                            <h4>Logo Footer: </h4>
                            <div class="row">
                                <div style="background-color: black;">
                                    <img src="../../../{{ $logo_footer->value }}" alt="logo" style="max-height: 155px;">
                                </div>
                                <div class="ml-5">
                                    <button class="btn btn-primary" onclick="logoFooterChangeButton()">Değiştir</button>
                                    <div hidden>
                                        <form action="{{ route('admin_data_logo') }}" method="POST"
                                            id="logoFooterChangeSubmitForm" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="logo_footer" id="logoFooterChangeInput"
                                                accept="image/*">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-5">
                            <h4>İkon: </h4>
                            <div class="row">
                                <div>
                                    <img src="../../../{{ $icon->value }}" alt="logo" style="max-height: 155px;">
                                </div>
                                <div class="ml-5">
                                    <button class="btn btn-primary" onclick="iconChangeButton()">Değiştir</button>
                                    <div hidden>
                                        <form action="{{ route('admin_data_logo') }}" method="POST"
                                            id="iconChangeSubmitForm" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="icon" id="iconChangeInput" accept="image/*">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function logoChangeButton() {
                document.getElementById('logoChangeInput').click();
            }

            document.getElementById('logoChangeInput').addEventListener('change', function() {
                document.getElementById('logoChangeSubmitForm').submit();
            });

            function logoFooterChangeButton() {
                document.getElementById('logoFooterChangeInput').click();
            }

            document.getElementById('logoFooterChangeInput').addEventListener('change', function() {
                document.getElementById('logoFooterChangeSubmitForm').submit();
            });

            function iconChangeButton() {
                document.getElementById('iconChangeInput').click();
            }

            document.getElementById('iconChangeInput').addEventListener('change', function() {
                document.getElementById('iconChangeSubmitForm').submit();
            });
        </script>
    @endif

    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if ($logoData == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
