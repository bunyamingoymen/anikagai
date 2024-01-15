@extends('admin.layouts.main')
@section('admin_content')
    @if ($list == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>



        @if ($create == 1)
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
                            <form id="addEventSubmitForm" action="{{ route('admin_animecalendar_addevent') }}"
                                method="POST">
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
                                    <select name="cycle_type" id="cycle_type" class="form-control"
                                        onchange="changeCycleType()" required>
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
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Açıklama"></textarea>
                                </div>
                                <div hidden>
                                    <input id="background_color" name="background_color" type="text" value="">
                                    <select name="fullDate[]" id="animeFullDate" multiple>
                                    </select>
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
        @endif

        @if ($update == 1)
            <div hidden>
                <!-- Large modal -->
                <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal"
                    data-target=".updateEventModal" id="updateEventModalButton">Modal demo</button>
            </div>
            <!--  Modal content for the above example -->
            <div class="modal fade updateEventModal" tabindex="-1" role="dialog"
                aria-labelledby="updateEventModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="updateEventModalLabel">Takvim Güncelle</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="changeEventSubmitForm" action="{{ route('admin_animecalendar_changeEvent') }}"
                                method="POST">
                                @csrf
                                <div class="row col-lg-12">
                                    <label for="changeAnime_code">Anime: </label>
                                    <select name="anime_code" id="changeAnime_code" class="form-control" required>
                                        <option value="" disabled selected>Bir Anime Seçiniz</option>
                                        @foreach ($animes as $anime)
                                            <option value="{{ $anime->code }}">{{ $anime->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row col-lg-12 mt-2">
                                    <label for="changeFirst_date">Başlangıç Tarihi: </label>
                                    <input type="date" name="first_date" id="changeFirst_date" class="form-control"
                                        required>
                                </div>
                                <div class="row col-lg-12 mt-2">
                                    <label for="changeCycle_type">Tekrar: </label>
                                    <select name="cycle_type" id="changeCycle_type" class="form-control"
                                        onchange="changeCycleType()" required>
                                        <option value="0" selected>Tekrarlama</option>
                                        <option value="1">Günlük</option>
                                        <option value="2">Haftalık</option>
                                        <option value="3">Aylık</option>
                                        <option value="4">Yıllık</option>
                                        <option value="5">Özel</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-2" id="changeSpecial_time_div" hidden>
                                    <div class="row">
                                        <label for="changeSpecial_type">Özel Zaman:</label>
                                        <select name="special_type" id="changeSpecial_type" class="form-control">
                                            <option value="1">Günlük</option>
                                            <option value="2">Haftalık</option>
                                            <option value="3">Aylık</option>
                                            <option value="4">Yıllık</option>
                                        </select>
                                    </div>
                                    <div class="row mt-2">
                                        <label for="changeSpecial_count">Özel Aralık Süresi:</label>
                                        <input type="number" name="special_count" id="changeSpecial_count"
                                            class="form-control" placeholder="30">
                                    </div>
                                </div>
                                <div class="row col-lg-12 mt-2" hidden id="ChangeEnd_date_div">
                                    <label for="changeEnd_date">Tekrarlama Bitiş Tarihi:</label>
                                    <input type="date" name="end_date" id="changeEnd_date" class="form-control"
                                        required>
                                </div>
                                <div class="row col-lg-12 mt-2">
                                    <label for="changeDescription">Açıklama: </label>
                                    <textarea name="description" id="changeDescription" cols="30" rows="10" class="form-control"
                                        placeholder="Açıklama"></textarea>
                                </div>
                                <div hidden>
                                    <select name="fullDate[]" id="changeAnimeFullDate" multiple>
                                    </select>
                                    <input type="text" name="anime_calendar_code" id="changeAnime_calendar_code">
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="float-right btn btn-primary ml-2 mr-2" style=""
                                        onclick="changeEventSubmitButton()">Güncelle</button>
                                    @if ($delete == 1)
                                        <button type="button" class="float-right btn btn-danger"
                                            onclick="deleteEvent()">Sil</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        @endif

        <script src="../../../admin/assets/libs/jquery/jquery.min.js"></script>

        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
        <!--CRUD İşlemleri-->
        <script>
            var options = [];
            @if ($create == 1)

                function changeCycleType() {
                    var value = document.getElementById('cycle_type').value;

                    if (value == 5) document.getElementById('special_time_div').hidden = false;
                    else document.getElementById('special_time_div').hidden = true;

                    if (value != 0) document.getElementById('end_date_div').hidden = false;
                    else document.getElementById('end_date_div').hidden = true;
                }

                function addEventSubmitButton() {
                    var anime_code = document.getElementById('anime_code').value;
                    var first_date = document.getElementById('first_date').value;
                    var end_date = document.getElementById('end_date').value;
                    var cycle_type = document.getElementById('cycle_type').value;
                    var special_type = document.getElementById('special_type').value;
                    var special_count = document.getElementById('special_count').value;

                    if (first_date != "" && end_date != "" && new Date(first_date) > new Date(end_date)) {
                        $('.addEventModal').modal('hide');
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata',
                            text: 'Başlangıç tarihi bitih tarihinden sonra olamaz!',
                        }).then((result) => {
                            $('.addEventModal').modal('show');
                        })
                    }

                    if (anime_code == "" || first_date == "" || cycle_type == "") {
                        $('.addEventModal').modal('hide');
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata',
                            text: 'Lütfen Gerekli Doldurunuz!',
                        }).then((result) => {
                            $('.addEventModal').modal('show');
                        })
                    } else {
                        var backgroundColors = ["#000", "#007BFF", "#28a745", "#6C757D", "#DC3545", "#FFC107", "#17A2B8",
                            "#800080", "#343A40",
                            "#FF0500"
                        ]
                        randomColor = Math.floor(Math.random() * backgroundColors.length);
                        background_color = backgroundColors[randomColor];
                        document.getElementById("background_color").value = background_color;
                        sendDate('animeFullDate', cycle_type, special_type, special_count, first_date, end_date,
                            'addEventSubmitForm');
                    }

                }
            @endif

            @if ($update == 1)

                function updateEventModal(code, anime_calendar_code, anime_calendar_lists_code,
                    first_date, end_date, cycle_type, special_type, special_count, description) {
                    document.getElementById('changeAnime_code').value = code;
                    document.getElementById('changeAnime_calendar_code').value = anime_calendar_code;
                    document.getElementById('changeFirst_date').value = first_date;
                    document.getElementById('changeEnd_date').value = end_date;
                    document.getElementById('changeCycle_type').value = cycle_type;
                    document.getElementById('changeSpecial_type').value = special_type;
                    document.getElementById('changeSpecial_count').value = special_count;
                    document.getElementById('changeDescription').value = description;

                    if (cycle_type == 5) document.getElementById('changeSpecial_time_div').hidden = false;
                    else document.getElementById('changeSpecial_time_div').hidden = true;

                    if (cycle_type != 0) document.getElementById('ChangeEnd_date_div').hidden = false;
                    else document.getElementById('ChangeEnd_date_div').hidden = true;

                    document.getElementById('updateEventModalButton').click();
                }

                function changeEventSubmitButton() {
                    var anime_code = document.getElementById('changeAnime_code').value;
                    var first_date = document.getElementById('changeFirst_date').value;
                    var end_date = document.getElementById('changeEnd_date').value;
                    var cycle_type = document.getElementById('changeCycle_type').value;
                    var special_type = document.getElementById('changeSpecial_type').value;
                    var special_count = document.getElementById('changeSpecial_count').value;

                    if (anime_code == "" || first_date == "" || cycle_type == "") {
                        $('.addEventModal').modal('hide');
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata',
                            text: 'Lütfen Gerekli Doldurunuz!',
                        }).then((result) => {
                            $('.updateEventModal').modal('show');
                        })
                    } else {
                        sendDate('changeAnimeFullDate', cycle_type, special_type, special_count, first_date, end_date,
                            'changeEventSubmitForm');
                    }
                }
            @endif

            @if ($delete == 1)

                function deleteEvent() {
                    var anime_calendar_code = document.getElementById('changeAnime_calendar_code').value;
                    Swal.fire({
                        title: 'Emin Misin?',
                        text: 'Bu Veriyi Silmek İstiyor musunuz(ID: ' + anime_calendar_code + ')?',
                        icon: 'warning',
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Onayla',
                        denyButtonText: `Vazgeç`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            var html =
                                `<form action='{{ route('admin_animecalendar_deleteEvent') }}' id="deleteAnimeCalendarForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + anime_calendar_code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteAnimeCalendarForm').submit();
                        }
                    })
                }
            @endif

            function GetDay(start_date, finish_date, changeDay) {
                while (start_date < finish_date) {
                    const formatted_date = start_date.getFullYear() + '-' +
                        ('0' + (start_date.getMonth() + 1)).slice(-2) + '-' +
                        ('0' + start_date.getDate()).slice(-2);
                    const elem = `<option value="` + formatted_date + `" selected></option>`
                    options.push(elem);
                    start_date.setDate(start_date.getDate() + changeDay);
                }
            }

            function GetWeek(start_date, finish_date, changeWeek) {
                while (start_date < finish_date) {
                    const formatted_date = start_date.getFullYear() + '-' +
                        ('0' + (start_date.getMonth() + 1)).slice(-2) + '-' +
                        ('0' + start_date.getDate()).slice(-2);
                    const elem = `<option value="` + formatted_date + `" selected></option>`
                    options.push(elem);
                    start_date.setDate(start_date.getDate() + changeWeek * 7);
                }
            }

            function GetMonth(start_date, finish_date, changeMonth) {
                while (start_date < finish_date) {
                    const formatted_date = start_date.getFullYear() + '-' +
                        ('0' + (start_date.getMonth() + 1)).slice(-2) + '-' +
                        ('0' + start_date.getDate()).slice(-2);
                    const elem = `<option value="` + formatted_date + `" selected></option>`
                    options.push(elem);


                    // Eğer yılı aşarsa, bir sonraki yıla geç
                    if (start_date.getMonth() + changeMonth > 12) {
                        start_date.setFullYear(start_date.getFullYear() + 1);
                    }

                    start_date.setMonth(start_date.getMonth() + changeMonth);
                }
            }

            function GetYear(start_date, finish_date, changeYear) {
                while (start_date < finish_date) {
                    const formatted_date = start_date.getFullYear() + '-' +
                        ('0' + (start_date.getMonth() + 1)).slice(-2) + '-' +
                        ('0' + start_date.getDate()).slice(-2);
                    const elem = `<option value="` + formatted_date + `" selected></option>`
                    options.push(elem);
                    // Ay değişikliği
                    start_date.setMonth(start_date.getMonth() + changeMonth);

                    // Eğer yılı aşarsa, bir sonraki yıla geç
                    if (start_date.getMonth() < changeMonth) {
                        start_date.setFullYear(start_date.getFullYear() + 1);
                    }
                }
            }

            function sendDate(selectBoxID, cycle_type, special_type, special_count, first_date, end_date, formID) {
                //0: tekrarlama, 1:günlük, 2:haftalık, 3:aylık, 4:yıllık, 5: özel
                console.log(cycle_type);
                options = [];
                var start_date = new Date(first_date);
                var finish_date = new Date(end_date);
                if (cycle_type == 0) {
                    const formatted_date = start_date.getFullYear() + '-' +
                        ('0' + (start_date.getMonth() + 1)).slice(-2) + '-' +
                        ('0' + start_date.getDate()).slice(-2);
                    const elem = `<option value="` + formatted_date + `" selected></option>`
                    options.push(elem);
                } else if (cycle_type == 1) GetDay(start_date, finish_date, 1);
                else if (cycle_type == 2) GetWeek(start_date, finish_date, 1);
                else if (cycle_type == 3) GetMonth(start_date, finish_date, 1);
                else if (cycle_type == 4) GetYear(start_date, finish_date, 1);
                else if (cycle_type == 5) {
                    if (special_type == 1) GetDay(start_date, finish_date, special_count);
                    else if (special_type == 2) GetWeek(start_date, finish_date, special_count);
                    else if (special_type == 3) GetMonth(start_date, finish_date, special_count);
                    else if (special_type == 4) GetYear(start_date, finish_date, special_count);
                    else console.log("HATA 2")
                } else {
                    console.log('HATA');
                }

                setTimeout(() => {
                    if (options.length > 0) {
                        for (var i = 0; i < options.length; i++) {
                            document.getElementById(selectBoxID).innerHTML += options[i];
                        }

                        setTimeout(() => {
                            document.getElementById(formID).submit();
                        }, 50);
                    }
                }, 50);
            }
        </script>

        <!--Kayıt Görüntüleme İşlemleri-->
        <script>
            var calendar;

            var changeMonth = 0;
            var showedMonth = 1;
            var called_start = "1970-01-01";
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: "tr",
                    selectable: true,
                    @if ($create == 1)
                        headerToolbar: {
                            center: 'addEventButton',
                            //right: 'listDay,listWeek,listMonth'
                        },
                    @endif
                    buttonText: {
                        today: 'Bugün',
                        month: 'Ay',
                        week: 'Hafta',
                        day: 'Gün',
                        listMonth: 'Ayı Listele',
                        listYear: 'Yılı Listele',
                        listWeek: 'Haftayı Listele',
                        listDay: 'Günü Listele'
                    },
                    @if ($create == 1)
                        customButtons: {
                            addEventButton: {
                                text: 'Takvime Yeni Bir Anime Ekle',
                                click: function() {
                                    document.getElementById('addEventModalButton').click();
                                }
                            }
                        },
                    @endif
                    datesSet: function(info) {
                        if (called_start == "1970-01-01") {
                            called_start = info.start;
                            createEvents();
                            return;
                        }
                        if (called_start < info.start) {
                            changeMonth++;
                            getEvents();
                            called_start = info.start;
                        } else {
                            changeMonth--;
                            called_start = info.start;
                        }

                    },
                    eventClick: function(info) {
                        // Tıklanan etkinlik nesnesine erişim
                        //console.log(info.event.title); // Etkinlik başlığı
                        //console.log(info.event.start); // Etkinlik başlangıç tarihi
                        //console.log(info.event.extendedProps.code); // Özel özellik
                        updateEventModal(info.event.extendedProps.code, info.event.extendedProps
                            .anime_calendar_code, info.event.extendedProps.anime_calendar_lists_code,
                            info.event.extendedProps.first_date, info.event.extendedProps.end_date,
                            info.event.extendedProps.cycle_type, info.event.extendedProps.special_type,
                            info.event.extendedProps.special_count, info.event.extendedProps.description
                        );
                    }
                });

                calendar.render();
            });

            function createEvents() {
                @foreach ($anime_calendar_lists as $item)
                    var event = {
                        title: '{{ $item->anime_name }}', // a property!
                        start: '{{ $item->anime_calendar_list_date }}',
                        end: '{{ $item->anime_calendar_list_date }}',
                        code: '{{ $item->anime_code }}',
                        anime_calendar_code: '{{ $item->anime_calendar_code }}',
                        anime_calendar_lists_code: '{{ $item->anime_calendar_lists_code }}',
                        first_date: '{{ $item->anime_calendar_first_date }}',
                        end_date: '{{ $item->anime_calendar_end_date }}',
                        cycle_type: '{{ $item->anime_calendar_cycle_type }}',
                        special_type: '{{ $item->anime_calendar_special_type }}',
                        special_count: '{{ $item->anime_calendar_special_count }}',
                        description: '{{ $item->anime_calendar_description }}',
                        backgroundColor: '{{ $item->anime_calendar_background_color }}',
                    };
                    calendar.addEvent(event);
                @endforeach
            }

            function getEvents() {
                if (showedMonth < changeMonth) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin_animecalendar_get_anime_calendar') }}",
                        data: {
                            changeMonth: changeMonth,
                            showedMonth: showedMonth
                        },
                        success: function(anime_calendar_lists) {
                            showedMonth = changeMonth;
                            //console.log(JSON.stringify(anime_calendar_lists));
                            var events = calendar.getEvents();


                            for (let i = 0; i < anime_calendar_lists.length; i++) {

                                var hasEventInDateRange = events.some(function(event) {

                                    const formatted_date = event.start.getFullYear() + '-' +
                                        ('0' + (event.start.getMonth() + 1)).slice(-2) + '-' +
                                        ('0' + event.start.getDate()).slice(-2);

                                    return event.extendedProps.anime_calendar_code == anime_calendar_lists[
                                            i].anime_calendar_code &&
                                        formatted_date == anime_calendar_lists[i].anime_calendar_list_date;
                                });



                                if (!hasEventInDateRange) {
                                    var newEvent = {
                                        title: anime_calendar_lists[i].anime_name, // a property!
                                        start: anime_calendar_lists[i].anime_calendar_list_date,
                                        end: anime_calendar_lists[i].anime_calendar_list_date,
                                        code: anime_calendar_lists[i].anime_code,
                                        anime_calendar_code: anime_calendar_lists[i].anime_calendar_code,
                                        anime_calendar_lists_code: anime_calendar_lists[i]
                                            .anime_calendar_lists_code,
                                        first_date: anime_calendar_lists[i].anime_calendar_first_date,
                                        end_date: anime_calendar_lists[i].anime_calendar_end_date,
                                        cycle_type: anime_calendar_lists[i].anime_calendar_cycle_type,
                                        special_type: anime_calendar_lists[i].anime_calendar_special_type,
                                        special_count: anime_calendar_lists[i].anime_calendar_special_count,
                                        description: anime_calendar_lists[i].anime_calendar_description,
                                        backgroundColor: anime_calendar_lists[i]
                                            .anime_calendar_background_color,
                                    };

                                    calendar.addEvent(newEvent);
                                }
                            }
                        }
                    });
                }
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
