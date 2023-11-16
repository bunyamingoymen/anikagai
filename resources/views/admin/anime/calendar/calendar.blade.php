@extends("admin.layouts.main")
@section('admin_content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>

<div hidden>
    <!-- Large modal -->
    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal"
        data-target=".addEventModal" id="addEventModalButton">Modal demo</button>
</div>


<!--  Modal content for the above example -->
<div class="modal fade addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="addEventModalLabel">Takvim Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin_calendar_addevent')}}" method="POST">
                    @csrf
                    <div class="row col-lg-12">
                        <label for="anime_code">Anime: </label>
                        <select name="anime_code" id="anime_code" class="form-control" required>
                            <option value="" disabled selected>Bir Anime Seçiniz</option>
                            @foreach ($animes as $anime)
                            <option value="{{ $anime->code }}">{{ $anime->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row col-lg-12 mt-2">
                        <label for="first_date">Başlangıç Tarihi: </label>
                        <input type="date" name="first_date" id="first_date" class="form-control" required>
                    </div>
                    <div class="row col-lg-12 mt-2">
                        <label for="cycle_type">Tekrar: </label>
                        <select name="cycle_type" id="cycle_type" class="form-control" onchange="changeCycleType()"
                            required>
                            <option value="0" selected>Tekrarlama</option>
                            <option value="1">Günlük</option>
                            <option value="2">Haftalık</option>
                            <option value="3">Aylık</option>
                            <option value="4">Yıllık</option>
                            <option value="5">Özel</option>
                        </select>
                    </div>
                    <div class="col-lg-12 mt-2" id="special_time_div" hidden>
                        <div class="row">
                            <label for="special_type">Özel Zaman:</label>
                            <select name="special_type" id="special_type" class="form-control">
                                <option value="1">Günlük</option>
                                <option value="2">Haftalık</option>
                                <option value="3">Aylık</option>
                                <option value="4">Yıllık</option>
                            </select>
                        </div>
                        <div class="row mt-2">
                            <label for="">Özel Aralık Süresi:</label>
                            <input type="number" name="special_count" id="special_count" class="form-control"
                                placeholder="30">
                        </div>
                    </div>
                    <div class="row col-lg-12 mt-2" hidden id="end_date_div">
                        <label for="">Tekrarlama Bitiş Tarihi:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                    <div class="row col-lg-12 mt-2">
                        <label for="">Açıklama: </label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                            placeholder="Açıklama"></textarea>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="float-right btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="../../../admin/assets/libs/jquery/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
<script>
    /*
    events: [
    { // this object will be "parsed" into an Event Object
    title: 'The Title', // a property!
    start: '2023-11-11', // a property!
    end: '2023-11-12' // a property! ** see important note below about 'end' **
    }
    ],



    calendar.addEvent({
                            title: 'dynamic event',
                            start: date,
                            allDay: true
                            });
    */
</script>
<script>
    function changeCycleType() {
        var value = document.getElementById('cycle_type').value;

        if (value == 5) {
            document.getElementById('special_time_div').hidden = false;
        } else {
            document.getElementById('special_time_div').hidden = true;
        }

        if(value != 0){
            document.getElementById('end_date_div').hidden = false;
        }else{
            document.getElementById('end_date_div').hidden = true;
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: "tr",
            selectable: true,
            headerToolbar: {
                center: 'addEventButton',
                //right: 'listDay,listWeek,listMonth'
            },
            buttonText:{
                today: 'Bugün',
                month: 'Ay',
                week: 'Hafta',
                day: 'Gün',
                listMonth: 'Ayı Listele',
                listYear: 'Yılı Listele',
                listWeek: 'Haftayı Listele',
                listDay: 'Günü Listele' },
        customButtons: {
            addEventButton: {
                text: 'Takvime Yeni Bir Anime Ekle',
                click: function() {
                    document.getElementById('addEventModalButton').click();
                }
            }
        }
        });

        calendar.render();
    });

</script>

@endsection