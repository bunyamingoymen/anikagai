@extends('admin.layouts.main')
@section('admin_content')
    @if (Auth::guard('admin')->user()->user_type == 0)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <form class="needs-validation" id="authClauseUpdateForm"
                            action="{{ route('admin_authclause_update') }}" method="POST">
                            @csrf
                            <div hidden>
                                <input type="text" value="{{ $clause->code }}" name="code" id="code">
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom01">Yazı:</label>
                                    <input type="text" class="form-control" id="text" name="text"
                                        placeholder="Yazı" value="{{ $clause->text }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03">Açıklama:</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Value">{{ $clause->description }}</textarea>

                                </div>
                            </div>
                            <div style="float: right;">
                                <button class="btn btn-primary" type="button"
                                    onclick="authClausesUpdateFormSubmit()">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function authClausesUpdateFormSubmit() {
                var text = document.getElementById('text').value;
                if (text == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Lütfen Gerekli Doldurunuz!',
                    })
                } else {
                    document.getElementById('code').value = "{{ $clause->code }}";
                    document.getElementById('authClauseUpdateForm').submit();
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
