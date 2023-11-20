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
                <form id="addEventSubmitForm" action="{{route('admin_animecalendar_addevent')}}" method="POST">
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
                    <div hidden>
                        <input id="background_color" name="background_color" type="text" value="">
                    </div>
                    <div class="mt-2">
                        <button type="button" class="float-right btn btn-primary"
                            onclick="addEventSubmitButton()">Kaydet</button>
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

    function addEventSubmitButton() {
        var anime_code = document.getElementById('anime_code').value;
        var first_date = document.getElementById('first_date').value;
        var cycle_type = document.getElementById('cycle_type').value;
        if(anime_code == "" || first_date == "" || cycle_type == ""){
            $('.addEventModal').modal('hide');
            Swal.fire({
            icon: 'error',
            title: 'Hata',
            text: 'Lütfen Gerekli Doldurunuz!',
            }).then((result) => {
                $('.addEventModal').modal('show');
            })
        }else{
            var backgroundColors = ["#000", "#007BFF", "#28a745", "#6C757D", "#DC3545", "#FFC107", "#17A2B8", "#800080", "#343A40",
            "#FF0500"]
            randomColor = Math.floor(Math.random() * backgroundColors.length);
            background_color = backgroundColors[randomColor];
            document.getElementById("background_color").value = background_color;
            document.getElementById("addEventSubmitForm").submit();
        }

    }
</script>
<script>
    var calendar;

    var changeMonth = 0;
    var called_start = "1970-01-01";
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        calendar = new FullCalendar.Calendar(calendarEl, {
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
            },
            datesSet: function(info) {
                if(called_start == "1970-01-01"){
                    called_start = info.start;
                    createEvents();
                    return;
                }
                if(called_start<info.start){
                    changeMonth++;
                    if(changeMonth%2 == 0){
                        createEvents();
                    }
                    called_start = info.start;
                }else{
                    called_start = info.start;
                }

            }
        });

        calendar.render();
    });

    function createEvents() {

        var events = [];

        @foreach ($anime_calendars as $item)
            var start_date = new Date("{{$item->first_date}}");
            var repeat_type = parseInt("{{$item->cycle_type}}");
            var interval = 1;
            if(changeMonth != 0){
                start_date.setMonth(start_date.getMonth() + changeMonth);
                if( repeat_type == 1){
                    start_date.setDate(start_date.getDate() + 1 * (changeMonth/2));
                }else if(repeat_type == 2){ //haftalık

                    var date = new Date("{{$item->first_date}}").getDay();
                    while(start_date.getDay() !== date) start_date.setDate(start_date.getDate() + 1);
                }else if(repeat_type == 3){ //aylık
                    var date = new Date("{{$item->first_date}}").getDate();
                    start_date.setDate(date);
                    start_date.setMonth(start_date.getMonth() + (1 * (changeMonth/2)));

                }else if(repeat_type == 4 || repeat_type == 0){
                        return;
                }else{
                    repeat_type = parseInt("{{$item->special_type}}");
                    interval = parseInt("{{$item->special_count}}");

                    if( repeat_type == 1){
                        start_date.setDate(start_date.getDate() + ((interval-1) * (changeMonth/2)));
                    }else if(repeat_type == 2){ //haftalık
                        var date = new Date("{{$item->first_date}}").getDay();
                        while(start_date.getDay() !== date) start_date.setDate(start_date.getDate() + interval);
                    }else if(repeat_type == 3){ //aylık
                        var date = new Date("{{$item->first_date}}").getDate();
                        start_date.setDate(date);
                        start_date.setMonth(start_date.getMonth() + (interval * (changeMonth/2)));
                    }else if(repeat_type == 4 || repeat_type == 0){
                        return;
                    }
                }

            }
            var end_date = new Date("{{$item->end_date ?? '1970-01-01'}}");


            // İki tarih arasındaki farkı al
            var dateDifference = end_date - start_date;

            // Farkı kontrol et ve 2 aydan fazlaysa end_date'i ayarla
            if ((dateDifference > (2 * 30 * 24 * 60 * 60 * 1000)) && repeat_type != 4) {
                end_date = new Date(start_date.getTime()); // start_date'in bir kopyasını al
                end_date.setMonth(end_date.getMonth() + 2);
            }





            var anime_name = "{{$item->anime_name}}";

            if(repeat_type == 5){ //özel
                repeat_type = parseInt("{{$item->special_type}}");
                interval = parseInt("{{$item->special_count}}");
            }

            var backgroundColor = "{{$item->background_color}}";

            var anime_code = "{{$item->anime_code}}";

            addEventsRepeats(repeat_type, interval, start_date, end_date, anime_name, backgroundColor, anime_code);

        @endforeach

    }

    function addEventsRepeats(repeat_type, interval, start_date, end_date, anime_name, backgroundColor, anime_code) {
        interval = parseInt(interval);
        console.log("---------------------------------------------------------------------------")
        while (start_date <= end_date) {
                console.log('yüklenen: ' + start_date.toISOString());
                var baslangici = new Date(start_date);

                //baslangic: haftaBaslangici.toISOString().split('T')[0],
                //bitis: haftaBitisi.toISOString().split('T')[0]

                if(baslangici <= end_date){
                    var event = {
                            code: anime_code,
                            title: anime_name, // a property!
                            start: baslangici.toISOString().split('T')[0],
                            end: baslangici.toISOString().split('T')[0],
                            backgroundColor: backgroundColor,
                        };
                    calendar.addEvent(event);
                }

                if(repeat_type == 0){
                    break;
                }
                else if(repeat_type == 1){
                    start_date.setDate(start_date.getDate() + 1 * interval);
                }else if( repeat_type == 2){
                    start_date.setDate(start_date.getDate() + 7 * interval);
                    //start_date.setDate(start_date.getDate() + (5 - start_date.getDay() + 7) % 7);
                }else if( repeat_type == 3){
                    start_date.setMonth(start_date.getMonth() + interval);
                }else if(repeat_type == 4){
                    start_date.setFullYear(start_date.getFullYear() + interval);
                }

            }
    }

</script>

@endsection