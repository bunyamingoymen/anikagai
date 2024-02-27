@extends('admin.layouts.main')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_add_notifications') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="notification_image">Resim:</label>
                            <input type="file" id="notification_image" name="notification_image" class="form-control">
                            <small>Resim seçilmediği zaman varsayılan Resim gösterilir.</small>
                        </div>

                        <div class="mt-2">
                            <label for="notification_title">Başlık:</label>
                            <input type="text" id="notification_title" name="notification_title" class="form-control"
                                required>
                        </div>

                        <div class="mt-2">
                            <label for="notification_text">Bildirim:</label>
                            <textarea id="notification_text" name="notification_text" class="form-control" cols="30" rows="5" required></textarea>
                        </div>

                        <div class="mt-2">
                            <div class="row col-lg-12">
                                <div class="col-lg-6">
                                    <label for="notification_date">Bildirim Başlangıç tarihi: </label>
                                    <input type="date" id="notification_date" name="notification_date"
                                        class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                    <small>Bildirimin Gönderileceği tarih. Vaarsayılan olarak bugündür.</small>
                                </div>
                                <div class="col-lg-6">
                                    <label for="notification_end_date">Bildirim Bitiş tarihi: </label>
                                    <input type="date" id="notification_end_date" name="notification_end_date"
                                        class="form-control"
                                        value="{{ Carbon\Carbon::now()->addMonths(1)->format('Y-m-d') }}">
                                    <small>Eğer bitiş tarihi seçilmez ise bildirimler kısmından 1 ay içinde
                                        kaybolacaktır.</small>
                                </div>
                            </div>

                        </div>

                        <div class="mt-2">
                            <label for="notification_url">Bildirim Linki: </label>
                            <input type="text" id="notification_url" name="notification_url" class="form-control">
                            <small>Eğer link girilmez ise popup ile bildirimler gözükecektir.</small>
                        </div>

                        <div class="m-2">
                            <button class="btn btn-primary float-right" type="submit">Kaydet</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
