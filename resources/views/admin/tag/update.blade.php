@extends('admin.layouts.main')
@section('admin_content')
    @if ($update == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <form class="needs-validation" id="tagUgpdateForm" action="{{ route('admin_tag_update') }}"
                            method="POST">
                            @csrf
                            <input type="text" name="code" id="code" value="{{ $tag->code }}" hidden>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">İsim:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="İsim" required value="{{ $tag->name }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="description">Açıklama:</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Açıklama">{{ $tag->description ?? '' }}</textarea>
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
        <script>
            function tagUgpdateFormSubmit() {
                var name = document.getElementById('name').value;

                if (name == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Lütfen Gerekli Doldurunuz!',
                    })
                } else {
                    document.getElementById('code').value = "{{ $tag->code }}";
                    document.getElementById('tagUgpdateForm').submit();
                }
            }
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if ($update == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
