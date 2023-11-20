@extends("admin.layouts.main")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" id="authGroupUpdateForm" action="{{route('admin_authgroup_update')}}"
                    method="POST">
                    @csrf
                    <div hidden>
                        <input type="text" value="{{$group->code}}" name="code" id="code">
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Yazı:</label>
                            <input type="text" class="form-control" id="text" name="text" placeholder="Yazı"
                                value="{{$group->text}}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom03">Açıklama:</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                                placeholder="Value">{{$group->description}}</textarea>

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