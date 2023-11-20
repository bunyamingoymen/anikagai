@extends("admin.layouts.main")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form class="needs-validation" id="keyValueUpdateForm" action="{{route('admin_keyvalue_update')}}"
                    method="POST">
                    @csrf
                    <div hidden>
                        <input type="text" value="{{$keyValue->code}}" name="code" id="code">
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Key:</label>
                            <input type="text" class="form-control" id="key" name="key" placeholder="Key"
                                value="{{$keyValue->key}}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom03">Value:</label>
                            <textarea class="form-control" name="value" id="value" cols="30" rows="10"
                                placeholder="Value">{{$keyValue->value}}</textarea>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">İsteğe Bağlı:</label>
                            <input type="text" class="form-control" id="optional" name="optional"
                                placeholder="İsteğe Bağlı" value="{{$keyValue->optional}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">İsteğe Bağlı 2:</label>
                            <input type="text" class="form-control" id="optional_2" name="optional_2"
                                placeholder="İsteğe Bağlı" value="{{$keyValue->optional_2}}">
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
@endsection