@extends('admin.layouts.main')
@section('admin_content')
    @if ($titleData == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-3">
                            <h4>Başlık: </h4>
                            <p>Site açıkken sekmede görünen ismi buradan değiştirebilirsiniz.</p>
                            <form action="{{ route('admin_data_title') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="index_title" id="index_title"
                                            value="{{ $index_title->value }}">
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn btn-primary">Değiştir</button>
                                    </div>
                                </div>
                            </form>
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
            @if ($titleData == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
