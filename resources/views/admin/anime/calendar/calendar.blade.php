@extends("admin.layouts.main")
@section('admin_content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <button onclick="sweet_alert_deneme()" class="btn btn-primary">Deneme</button>
                <div id='calendar'></div>

            </div>
        </div>
    </div>
</div>

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
    function sweet_alert_deneme(){
Swal.fire({
title: "<strong>HTML <u>example</u></strong>",
icon: "info",
html: `
You can use <b>bold text</b>,
<a href="#">links</a>,
and other HTML tags
`,
showCloseButton: true,
showCancelButton: true,
focusConfirm: false,
confirmButtonText: `
<i class="fa fa-thumbs-up"></i> Great!
`,
confirmButtonAriaLabel: "Thumbs up, great!",
cancelButtonText: `
<i class="fa fa-thumbs-down"></i>
`,
cancelButtonAriaLabel: "Thumbs down"
});
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: "tr",
            lang: "tr",
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
                text: 'Yeni Anime Ekle',
                click: function() {
                    Swal.fire({
                        icon: "warning",
                        title: "Yükle",
                    });
                }
            }
        }
        });

        calendar.render();
    });

</script>

@endsection