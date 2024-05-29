@extends('admin.layouts.main')
@section('admin_content')
    @if (Auth::guard('admin')->user()->user_type == 0)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" id="keyValueUpdateForm" action="{{ route('admin_keyvalue_update') }}"
                            method="POST">
                            @csrf
                            <div hidden>
                                <input type="text" value="{{ $keyValue->code }}" name="code" id="code">
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="key">Key:</label>
                                    <input type="text" class="form-control" id="key" name="key"
                                        placeholder="Key" value="{{ $keyValue->key }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="value">Value:</label>
                                    <textarea class="form-control" name="value" id="value" cols="30" rows="10" placeholder="Value">{{ $keyValue->value }}</textarea>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="optional">İsteğe Bağlı:</label>
                                    <input type="text" class="form-control" id="optional" name="optional"
                                        placeholder="İsteğe Bağlı" value="{{ $keyValue->optional ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="optional_2">İsteğe Bağlı 2:</label>
                                    <input type="text" class="form-control" id="optional_2" name="optional_2"
                                        placeholder="İsteğe Bağlı" value="{{ $keyValue->optional_2 ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="optional_2">İsteğe Bağlı 3:</label>
                                    <input type="text" class="form-control" id="optional_3" name="optional_3"
                                        placeholder="İsteğe Bağlı" value="{{ $keyValue->optional_3 ?? '' }}">
                                </div>
                            </div>
                            <div style="float: right;">
                                <button class="btn btn-primary" type="button"
                                    onclick="keyValueUpdateForm()">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function keyValueUpdateForm() {
                var key = document.getElementById('key').value;
                var value = document.getElementById('value').value;

                if (key == "" || value == "") {
                    Swal.fire({
                        icon: "error",
                        title: "Hata!",
                        text: "Lütfen geçerli bir mail adresi giriniz.",
                    });
                } else {
                    document.getElementById('code').value = "{{ $keyValue->code }}"
                    document.getElementById('keyValueUpdateForm').submit();
                }
            }
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if (Auth::guard('admin')->user()->user_type != 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
