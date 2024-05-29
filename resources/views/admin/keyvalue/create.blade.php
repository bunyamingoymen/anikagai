@extends('admin.layouts.main')
@section('admin_content')
    @if (Auth::guard('admin')->user()->user_type == 0)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <form class="needs-validation" id="keyValueCreateForm" action="{{ route('admin_keyvalue_create') }}"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom01">Key:</label>
                                    <input type="text" class="form-control" id="key" name="key"
                                        placeholder="Key" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03">Value:</label>
                                    <textarea class="form-control" name="value" id="value" cols="30" rows="10" placeholder="Value"></textarea>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom01">İsteğe Bağlı:</label>
                                    <input type="text" class="form-control" id="optional" name="optional"
                                        placeholder="İsteğe Bağlı">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom01">İsteğe Bağlı 2:</label>
                                    <input type="text" class="form-control" id="optional_2" name="optional_2"
                                        placeholder="İsteğe Bağlı">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom01">İsteğe Bağlı 3:</label>
                                    <input type="text" class="form-control" id="optional_3" name="optional_3"
                                        placeholder="İsteğe Bağlı">
                                </div>
                            </div>
                            <div style="float: right;">
                                <button class="btn btn-primary" type="submit">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
