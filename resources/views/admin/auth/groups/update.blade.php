@extends('admin.layouts.main')
@section('admin_content')
    @if ($update == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <form class="needs-validation" id="authGroupUpdateForm" action="{{ route('admin_authgroup_update') }}"
                            method="POST">
                            @csrf
                            <div hidden>
                                <input type="text" value="{{ $group->code }}" name="code" id="code">
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom01">Grup İsmi:</label>
                                    <input type="text" class="form-control" id="text" name="text"
                                        placeholder="Grup İsmi" value="{{ $group->text }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03">Açıklama:</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Value">{{ $group->description }}</textarea>

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
            @if ($update == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
