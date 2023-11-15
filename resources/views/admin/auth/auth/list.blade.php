@extends("admin.layouts.main")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" id="AuthClauseCreateForm" action="{{route('admin_auth_change')}}"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="groupSelectBox">Gruplar: </label>
                            <select name="groupSelectBox" id="groupSelectBox" class="form-control"
                                onchange="groupSelect()">
                                <option value="0">Lütfen Bir Grup Seçiniz</option>
                                @foreach ($groups as $group)
                                <option value="{{$group->code}}">{{$group->text}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-5">
                                <select id="not_selected_clauses" name="not_selected_clauses[]" class="form-control"
                                    multiple style="height: 15rem;">
                                    @foreach ($clauses as $clause)
                                    <option value="{{$clause->code}}">{{$clause->text}}</option>
                                    @endforeach
                                    <!-- Diğer seçenekleri buraya ekleyebilirsiniz -->
                                </select>
                            </div>

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

                            <div class="col-md-5">
                                <select id="selected_clauses" name="selected_clauses[]" class="form-control" multiple
                                    style="height: 15rem;">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="float-right mt-2">
                        <button class="btn btn-primary" type="button" onclick="submitForm()">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function submitForm(){
        // İlk selectbox'ı seç
        var selectBox = document.getElementById('selected_clauses');

        // Tüm seçenekleri dolaş ve her birini seç
        for (var i = 0; i < selectBox.options.length; i++) { selectBox.options[i].selected=true; } // Formu gönder
            document.getElementById('AuthClauseCreateForm').submit();
    }
    function transferClause(fromSelectID, toSelectID){
        var fromSelect = document.getElementById(fromSelectID);
        var toSelect = document.getElementById(toSelectID);
        for (var i = 0; i < fromSelect.options.length; i++) {
            if (fromSelect.options[i].selected)
            {
                var yeniOption=document.createElement('option');
                yeniOption.value=fromSelect.options[i].value;
                yeniOption.text=fromSelect.options[i].text;
                toSelect.add(yeniOption);
                fromSelect.remove(i); i--;
            }
        }
    }
    function groupSelect(){
        var group_code = document.getElementById('groupSelectBox').value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{route("admin_authclause_get_data")}}',
            data:{ group_code:group_code},
            success: function(combinedData) {
                var includeData = combinedData.includeData;
                var notIncludeData = combinedData.notIncludeData;

                for (let i = 0; i < includeData.length; i++) {
                    const element = includeData[i];
                    console.log(element.grup_code);
                    console.log(element.grup_text);
                }
            }
        });
    }
</script>
@endsection