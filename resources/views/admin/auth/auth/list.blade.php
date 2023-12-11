@extends('admin.layouts.main')
@section('admin_content')
    @if ($list == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <form class="needs-validation" id="AuthClauseCreateForm" action="{{ route('admin_auth_change') }}"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="groupSelectBox">Gruplar: </label>
                                    <select name="groupSelectBox" id="groupSelectBox" class="form-control"
                                        onchange="groupSelect()">
                                        <option value="0">Lütfen Bir Grup Seçiniz</option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->code }}">{{ $group->text }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="groupSelectBoxes" class="container mt-5" hidden>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Seçili Olmayan:</label>
                                        <select id="not_selected_clauses" name="not_selected_clauses[]" class="form-control"
                                            multiple style="height: 15rem;">
                                            @foreach ($clauses as $clause)
                                                <option value="{{ $clause->code }}">{{ $clause->text }}</option>
                                            @endforeach
                                            <!-- Diğer seçenekleri buraya ekleyebilirsiniz -->
                                        </select>
                                    </div>
                                    @if ($update == 1)
                                        <div class="col-md-2">
                                            <div class="d-flex flex-column align-items-center mt-3">
                                                <button type="button"
                                                    onclick=" transferClause('not_selected_clauses', 'selected_clauses')"
                                                    class="btn btn-primary mb-2"> >
                                                </button>
                                                <button type="button"
                                                    onclick=" transferClause('selected_clauses', 'not_selected_clauses')"
                                                    class="btn btn-primary">
                                                    < </button>
                                            </div>
                                        </div>
                                    @endif


                                    <div class="col-md-5">
                                        <label for="">Seçili Olan:</label>
                                        <select id="selected_clauses" name="selected_clauses[]" class="form-control"
                                            multiple style="height: 15rem;">
                                        </select>
                                    </div>
                                </div>
                                @if ($update == 1)
                                    <div class="float-right mt-2">
                                        <button class="btn btn-primary" type="button"
                                            onclick="submitForm()">Kaydet</button>
                                    </div>
                                @endif

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            @if ($update == 1)
                function submitForm() {
                    // İlk selectbox'ı seç
                    var selectBox = document.getElementById('selected_clauses');

                    // Tüm seçenekleri dolaş ve her birini seç
                    for (var i = 0; i < selectBox.options.length; i++) {
                        selectBox.options[i].selected = true;
                    } // Formu gönder
                    document.getElementById('AuthClauseCreateForm').submit();
                }
            @endif

            function transferClause(fromSelectID, toSelectID) {
                var fromSelect = document.getElementById(fromSelectID);
                var toSelect = document.getElementById(toSelectID);
                for (var i = 0; i < fromSelect.options.length; i++) {
                    if (fromSelect.options[i].selected) {
                        var yeniOption = document.createElement('option');
                        yeniOption.value = fromSelect.options[i].value;
                        yeniOption.text = fromSelect.options[i].text;
                        toSelect.add(yeniOption);
                        fromSelect.remove(i);
                        i--;
                    }
                }
            }

            function groupSelect() {
                var group_code = document.getElementById('groupSelectBox').value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_authgroup_get_data') }}',
                    data: {
                        group_code: group_code
                    },
                    success: function(includeData) {
                        document.getElementById('groupSelectBoxes').hidden = false;

                        var selected = document.getElementById('selected_clauses');
                        var nonSelected = document.getElementById('not_selected_clauses');

                        var options = Array.from(selected.options);

                        options.forEach(function(option) {
                            var newOption = document.createElement("option");
                            newOption.value = option.value;
                            newOption.text = option.text;
                            nonSelected.add(newOption);
                            selected.remove(yeniOption)
                        });

                        for (let i = 0; i < includeData.length; i++) {
                            const element = includeData[i];
                            var yeniOption = document.createElement('option');
                            yeniOption.value = includeData[i].clause_code;
                            yeniOption.text = includeData[i].clause_text;
                            //nonSelected.remove(yeniOption)
                            nonSelected.querySelector('option[value="' + includeData[i].clause_code + '"]').remove()
                            selected.add(yeniOption);
                        }

                    }
                });
            }
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if ($list == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
