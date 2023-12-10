var isHomere,
    isMobile = !1;
(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(
    navigator.userAgent
) ||
    /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
        navigator.userAgent.substr(0, 4)
    )) &&
    (isMobile = !0);
var router = new Navigo($("#router").data("homepage"), !1, "#!"),
    moreRequest = {};
function addChat() {
    $(".fnc_addChat");
    var e = $("#messageData")
            .data("emojioneArea")
            .getText()
            .replace(":)", ":slight_smile:")
            .replace(":(", ":frowning2:")
            .replace(":S", ":dizzy_face:")
            .replace(":D", ":smiley:")
            .replace(":O", ":astonished:")
            .replace(":P", ":stuck_out_tongue_winking_eye:")
            .replace(":/", ":confused:")
            .replace(":S", ":dizzy_face:")
            .replace("<3", ":heart:"),
        t = $("#messageData").data("room");
    e &&
        ($(".chat-box #chatbox-scroll").append(
            '<div class="chat-item room-owner"><div class="ci-message"><p>' +
                emojione.toImage(e) +
                "</p></div></div>"
        ),
        $("#chatbox-scroll").scrollTop($("#chatbox-scroll")[0].scrollHeight),
        $("#messageData").data("emojioneArea").setText(""),
        $.ajaxQueue({
            url: "/ajax/service",
            type: "POST",
            data: { type: "add_chat", room: t, data: emojione.toShort(e) },
            async: !0,
        }));
}
function goLetter(e) {
    return (
        $("html,body").animate(
            { scrollTop: $("#go-" + e).offset().top },
            "fast"
        ),
        !1
    );
}
function deleteComment() {
    var e = $(this),
        t = e.data("delete");
    e.data("type");
    swal({
        title: "Yorumun Silinecek",
        text: "Bu işlemi yapmak istediğinden emin misin?",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yorumu Sil",
        cancelButtonText: "Kapat",
    }).then((e) => {
        e.value &&
            $.ajax({
                type: "POST",
                url: "/ajax/service",
                dataType: "json",
                data: { status: 1, data: t, type: "actionData" },
                success: function (e) {
                    e &&
                        (e.error
                            ? getNotification("error", e.error)
                            : e.success
                            ? (getNotification("success", e.success),
                              $(".comment-item#comment_" + t).fadeOut(),
                              setTimeout(function () {
                                  $(".comment-item#comment_" + t).remove();
                              }, 1e3))
                            : e.session && (window.location.href = "/"));
                },
            });
    });
}
function spoilerComment() {
    var e = $(this),
        t = e.data("spoiler");
    e.data("type");
    swal({
        title: "Spoiler Yapılacak",
        text: "Bu işlemi yapmak istediğinden emin misin?",
        type: "info",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Spoiler Yap",
        cancelButtonText: "Kapat",
    }).then((e) => {
        e.value &&
            $.ajax({
                type: "POST",
                url: "/ajax/service",
                dataType: "json",
                data: { status: 99, data: t, type: "actionData" },
                success: function (e) {
                    e &&
                        (e.error
                            ? getNotification("error", e.error)
                            : e.success
                            ? getNotification("success", e.success)
                            : e.session && (window.location.href = "/"));
                },
            });
    });
}
function addReport(e) {
    swal({
        title: "Hata Bildir",
        html: '\t\t\t<input class="swal2-radio" type="radio" name="reason[]" value="1"> FV1text<br>\t\t\t<input class="swal2-radio" type="radio" name="reason[]" value="FV2"> FV2text<br>',
        textAlign: "left",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Gönder",
        cancelButtonText: "Kapat",
    }).then((e) => {
        e.value;
    });
}
function addComment() {
    var e = $(".fnc_addComment"),
        t = $("#review-count").text(),
        a = $("#commentSpoiler").is(":checked") ? 1 : 0,
        i = $("#commentData")
            .data("emojioneArea")
            .getText()
            .replace(":)", ":slight_smile:")
            .replace(":(", ":frowning2:")
            .replace(":D", ":smiley:")
            .replace(":O", ":astonished:")
            .replace(":P", ":stuck_out_tongue_winking_eye:")
            .replace(":/", ":confused:")
            .replace(":S", ":dizzy_face:")
            .replace("<3", ":heart:"),
        o = $("#commentData").data("episode"),
        s = $("#commentData").data("forum"),
        r = $("#commentData").data("series"),
        n = $("#commentData").data("topic"),
        l = $("#commentData").data("cast"),
        c = $("#commentData").data("type"),
        d = $("#commentData").data("cl"),
        u = $("#commentFix").is(":checked") ? 1 : 0;
    if (i) {
        var p = e.html();
        e.html("Yükleniyor"),
            e.prop("disabled", !0),
            $("#commentData").data("emojioneArea").disable(),
            $("#commentData").prop("disabled", !1),
            $.ajax({
                type: "POST",
                url: "/ajax/service",
                dataType: "json",
                data: {
                    color: "",
                    fix: u,
                    topic: n,
                    series: r,
                    forum: s,
                    episode: o,
                    cl_id: d,
                    cast: l,
                    comment: emojione.toShort(i),
                    ctype: c,
                    spoiler: a,
                    type: "addComment",
                },
                success: function (e) {
                    e &&
                        (e.error
                            ? getNotification("error", e.error)
                            : e.success
                            ? (s && r
                                  ? e.data && $(".alert-danger").remove()
                                  : 5 == c
                                  ? ($(e.data)
                                        .appendTo(".user-reviews #review-list")
                                        .hide()
                                        .fadeIn(600),
                                    $("html,body").animate(
                                        {
                                            scrollTop:
                                                $("#comment_" + e.c_id).offset()
                                                    .top - 100,
                                        },
                                        "slow"
                                    ))
                                  : $(e.data)
                                        .prependTo(".user-reviews #review-list")
                                        .hide()
                                        .fadeIn(600),
                              $("#review-count").text(parseInt(t) + 1),
                              getNotification("success", e.success))
                            : e.session && (window.location.href = "/"));
                },
                error: function (e) {},
                complete: function () {
                    $("#commentData").data("emojioneArea").setText(""),
                        $("#commentData").data("emojioneArea").enable(),
                        e
                            .removeClass("disabled")
                            .prop("disabled", !1)
                            .attr("disabled", !1),
                        $("#commentSpoiler")
                            .prop("disabled", !1)
                            .prop("checked", !1),
                        e.html(p),
                        $(".ui.dropdown").dropdown(),
                        $("body")
                            .off("click", "[data-delete]")
                            .on("click", "[data-delete]", deleteComment);
                },
            });
    }
}
function comolokko(e, t, a) {
    var i = new Date();
    i.setTime(i.getTime() + a),
        (document.cookie =
            e + "=" + t + "; expires=" + i.toGMTString() + "; path=/");
}
function getNotification(e, t) {
    $("body").overhang({
        type: e,
        message: t,
        duration: 3,
        html: !0,
        overlay: !1,
        closeConfirm: !0,
    });
}
function getCookie(e) {
    for (
        var t = e + "=", a = document.cookie.split(";"), i = 0;
        i < a.length;
        i++
    ) {
        for (var o = a[i]; " " == o.charAt(0); ) o = o.substring(1, o.length);
        if (0 == o.indexOf(t)) return o.substring(t.length, o.length);
    }
    return null;
}
function checkepisodesofthisSeason(e) {
    var t = e.data("tab"),
        a = $(".fnc_allofthisSeason input");
    $(".tab[data-tab=" + t + "] .fnc_addWatch input:checked").length ==
    $(".tab[data-tab=" + t + "] .fnc_addWatch input").length
        ? a.prop("checked", !0)
        : a.prop("checked", !1);
}
function arrayCompare(e, t) {
    if (e.length != t.length) return !1;
    for (var a = t.length, i = 0; i < a; i++) if (e[i] !== t[i]) return !1;
    return !0;
}
function inArray(e, t) {
    for (var a = t.length, i = 0; i < a; i++)
        if ("object" == typeof t[i]) {
            if (arrayCompare(t[i], e)) return !0;
        } else if (t[i] == e) return !0;
    return !1;
}
function getInputSelection(t) {
    return void 0 !== t
        ? ((s = t[0].selectionStart),
          (e = t[0].selectionEnd),
          t.val().substring(s, e))
        : "";
}
function lightoff() {
    $("div.light-off").attr(
        "style",
        "position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0,0,0,1);z-index: 50;display: none;"
    ),
        $("#sinemaModu").attr("style", "color:#fff;"),
        $("body")
            .off("click", "#sinemaModu, .light-off")
            .on("click", "#sinemaModu, .light-off", function (e) {
                $("#sinemaModu").hasClass("sinemaOn")
                    ? ($("#sinemaModu").removeClass("sinemaOn"),
                      $("#playersol").attr("style", ""),
                      $("#playersag, #review-form").show(),
                      $(".light-off").hide())
                    : ($("#playersag, #review-form").hide(),
                      $(".light-off").show(),
                      $("#playersol").attr(
                          "style",
                          "z-Index:56;width: 100%!important;position:absolute;left:-11%;"
                      ),
                      $("html,body").animate(
                          { scrollTop: $("#video-area").offset().top - 130 },
                          "slow"
                      ),
                      $("#sinemaModu").addClass("sinemaOn"));
            });
}
function toggleFullScreen(e) {
    e = document.querySelector(e);
    document.fullscreenElement ||
    document.mozFullScreenElement ||
    document.webkitFullscreenElement
        ? (console.log("çık"),
          document.cancelFullScreen
              ? document.cancelFullScreen()
              : document.mozCancelFullScreen
              ? document.mozCancelFullScreen()
              : document.webkitCancelFullScreen &&
                document.webkitCancelFullScreen())
        : (e.requestFullscreen
              ? e.requestFullscreen()
              : e.mozRequestFullScreen
              ? e.mozRequestFullScreen()
              : e.webkitRequestFullscreen &&
                e.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT),
          console.log("gir"));
}
function scalePages(e, t, a) {
    var i, o;
    (i = t > e.outerWidth(!0) ? 1 : t / (e.outerWidth(!0) + 15)),
        (o = a > e.outerHeight(!0) ? 1 : a / (e.outerHeight(!0) + 15)),
        (scale = i > o ? o : i),
        scale < 1 && ($(".rek-by").hide(), $(".rek-gecilecek").hide());
}
function movies_view() {
    if (0 != $("#not-loaded").length) {
        var e = $("#not-loaded"),
            t = e.data("whatwehave"),
            a = e.data("lang");
        $.ajax({
            type: "POST",
            url: "/ajax/service",
            data: { e_id: t, v_lang: a, type: "get_whatwehave" },
            success: function (e) {
                $(".player").html(
                    "<iframe" +
                        e.attr +
                        ' src="' +
                        e.api_iframe +
                        '" scrolling="no" allowfullscreen="true"></iframe>'
                ),
                    lightoff();
            },
            error: function (e) {
                console.log(e);
            },
        });
    }
    if (0 != $("#player_container").length) {
        var i = $("#player_container");
        (t = i.data("e_id")), (a = i.data("v_lang"));
        $.ajax({
            type: "POST",
            url: "/ajax/service",
            data: { e_id: t, v_lang: a, type: "get_stream" },
            success: function (e) {
                do_player(e);
            },
            error: function (e) {
                console.log(e);
            },
        });
    }
}
function series_view() {
    $.loadScript("/mofy/js/swiper.min.js", function () {
        var e = new Swiper("#season-episode-silder", {
            init: !1,
            spaceBetween: 0,
            noSwiping: !1,
            freeMode: !0,
            freeModeMomentum: !0,
            freeModeMomentumRatio: 0.5,
            freeModeMomentumVelocityRatio: 1,
            freeModeMomentumBounce: !1,
            freeModeSticky: !1,
            watchSlidesProgress: !0,
            touchStartPreventDefault: !0,
            touchStartForcePreventDefault: !0,
            mousewheel: { invert: !1, sensitivity: 1 },
            slidesPerView: "auto",
            simulateTouch: !0,
        });
        if (
            (e.on("init", function (t, a) {
                $(".ss-episode").each(function (e, t) {
                    $(this).attr("data-index", e);
                }),
                    $(".season-info ul li").each(function (e, t) {
                        var a = $(this).attr("data-season"),
                            i = $(
                                "[data-season=" +
                                    a +
                                    "][data-status=season_start]"
                            ).attr("data-index");
                        $(this).attr("data-index", i);
                    }),
                    $("body").on("click", ".season-info ul li", function (t) {
                        var a = $(this).attr("data-index");
                        $(".season-info li.active").removeClass("active"),
                            $(this).addClass("active"),
                            e.slideTo(a, 0, !1);
                    });
                var i = $(".just-watching").attr("data-episode"),
                    o = $(".just-watching").attr("data-season"),
                    s = $(
                        ".ss-episode[data-season=" +
                            o +
                            "][data-episode=" +
                            i +
                            "]"
                    ).attr("data-index");
                $(".season-info li[data-season=" + o + "]").addClass("active"),
                    $(
                        ".ss-episode[data-season=" +
                            o +
                            "][data-episode=" +
                            i +
                            "]"
                    ).addClass("active"),
                    e.slideTo(s, 0, !1);
            }),
            e.init(),
            e.on("progress", function (t) {
                this.activeIndex;
                var a = $(".season-info li.active").attr("data-season"),
                    i = $(".ss-episode[data-index=" + e.activeIndex + "]").attr(
                        "data-season"
                    );
                a != i &&
                    ($(".season-info li.active").removeClass("active"),
                    $('.season-info li[data-season="' + i + '"]').addClass(
                        "active"
                    ));
            }),
            e.on("transitionEnd", function (t, a) {
                this.activeIndex;
                var i = $(".season-info li.active").attr("data-season"),
                    o = $(".ss-episode[data-index=" + e.activeIndex + "]").attr(
                        "data-season"
                    );
                i != o &&
                    ($(".season-info li.active").removeClass("active"),
                    $('.season-info li[data-season="' + o + '"]').addClass(
                        "active"
                    ));
            }),
            0 != $("#not-loaded").length)
        ) {
            var t = $("#not-loaded"),
                a = t.data("lang"),
                i = t.data("whatwehave");
            $.ajax({
                type: "POST",
                url: "/ajax/service",
                data: { e_id: i, v_lang: a, type: "get_whatwehave" },
                success: function (e) {
                    var t = $("#autoplay"),
                        a = !1;
                    $(".player").html(
                        "<iframe" +
                            e.attr +
                            ' src="' +
                            e.api_iframe +
                            '" scrolling="no" allowfullscreen="false" allow="autoplay"></iframe>'
                    ),
                        $(".player iframe").hasClass("streamloaded") &&
                            $("#h_user_data").length > 0 &&
                            (t.is(":checked") &&
                                streamloaded
                                    .initPlayer()
                                    .then(() => {
                                        console.log("ready"),
                                            streamloaded.play();
                                    })
                                    .catch((e) => {
                                        console.log(e);
                                    }),
                            $("[data-fullscreen]").on("click", function (e) {
                                toggleFullScreen(".player");
                            }),
                            streamloaded.on("fullscreen", function (e) {
                                $("[data-fullscreen]").trigger("click");
                            }),
                            streamloaded.on("time", function (i) {
                                var o = $("#skip_intro");
                                if (
                                    (i > e.intro[0] && i < e.intro[1]
                                        ? 0 == o.length &&
                                          $(".player-wrapper .player").append(
                                              '<button class="ui button primary" id="skip_intro">İntroyu Geç</button>'
                                          )
                                        : 0 != o.length && o.remove(),
                                    t.is(":checked"))
                                ) {
                                    $(".page-title > a").text(),
                                        $(".navigate-next").attr("href");
                                    var s = $(".navigate-next").data("enum"),
                                        r = $(".navigate-next").data("snum"),
                                        n = $(".navigate-next").data("epath"),
                                        l = $(".navigate-next").data("edesc");
                                    if (
                                        (n &&
                                            (n =
                                                ' style="background-image:url(https://image.tmdb.org/t/p/w780' +
                                                n +
                                                ')"'),
                                        e.outro && i > e.outro)
                                    )
                                        if (!1 === a) {
                                            a = !0;
                                            var c =
                                                '\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="next-ep-holder"' +
                                                n +
                                                '>\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="next-ep-wrapper">\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="title-quaternary">Sonraki Bölüm</div>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="title-secondary">' +
                                                r +
                                                ". Sezon " +
                                                s +
                                                ". Bölüm (" +
                                                next_ename +
                                                ')</div>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="autoplay-icon">\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<svg height="92px" version="1.1" viewBox="0 0 98 98" width="92px"><circle class="apc" cx="49" cy="49" fill="rgba(0,0,0,.15)" r="38"></circle><circle class="apr" cx="-49" cy="49" fill-opacity="0" r="35" stroke="#FFFFFF" stroke-dasharray="293" stroke-dashoffset="293" stroke-width="4" transform="rotate(-90)"></circle><path transform="translate(13,13)" fill="#fff" d="M 24,48 41,36 24,24 V 48 z M 44,24 v 24 h 4 V 24 h -4 z"></path></svg>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class="description-primary">' +
                                                l +
                                                '</p>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<button class="ui button secondary wedsb">İptal</button>\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\t\t</div>';
                                            0 == $(".next-ep-holder").length &&
                                                $(
                                                    ".player-wrapper .player"
                                                ).append(c);
                                            var d = 9;
                                            window.cnt = setInterval(
                                                function () {
                                                    if (
                                                        (--d >= 0 &&
                                                            $(".apr").animate(
                                                                {
                                                                    "stroke-dashoffset": 0,
                                                                },
                                                                12e3
                                                            ),
                                                        0 === d)
                                                    ) {
                                                        clearInterval(
                                                            window.cnt
                                                        );
                                                        var e = !1;
                                                        streamloaded
                                                            .getFullscreen()
                                                            .then(
                                                                (t) => (e = t)
                                                            );
                                                        if (!e) {
                                                            var t =
                                                                $(
                                                                    ".navigate-next"
                                                                ).attr("href");
                                                            router.navigate(
                                                                t,
                                                                !0
                                                            );
                                                        }
                                                    }
                                                },
                                                1e3
                                            );
                                        } else clearInterval(window.cnt);
                                }
                            }),
                            streamloaded.once("ended", function () {
                                if ((console.log("ended"), t.is(":checked"))) {
                                    streamloaded.pause();
                                    $(".page-title > a").text();
                                    var e = $(".navigate-next").attr("href"),
                                        i = $(".navigate-next").data("ename"),
                                        o = $(".navigate-next").data("enum"),
                                        s = $(".navigate-next").data("snum"),
                                        r = $(".navigate-next").data("epath"),
                                        n = $(".navigate-next").data("edesc");
                                    if (
                                        (r &&
                                            (r =
                                                ' style="background-image:url(https://image.tmdb.org/t/p/w780' +
                                                r +
                                                ')"'),
                                        0 == a)
                                    ) {
                                        a = !0;
                                        var l =
                                            '\t\t\t\t\t\t\t\t\t\t\t<div class="next-ep-holder"' +
                                            r +
                                            '>\t\t\t\t\t\t\t\t\t\t\t\t<div class="next-ep-wrapper">\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="title-quaternary">Sonraki Bölüm</div>\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="title-secondary">' +
                                            s +
                                            ". Sezon " +
                                            o +
                                            ". Bölüm (" +
                                            i +
                                            ')</div>\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="autoplay-icon">\t\t\t\t\t\t\t\t\t\t\t\t\t\t<svg height="92px" version="1.1" viewBox="0 0 98 98" width="92px"><circle class="apc" cx="49" cy="49" fill="rgba(0,0,0,.15)" r="38"></circle><circle class="apr" cx="-49" cy="49" fill-opacity="0" r="35" stroke="#FFFFFF" stroke-dasharray="293" stroke-dashoffset="293" stroke-width="4" transform="rotate(-90)"></circle><path transform="translate(13,13)" fill="#fff" d="M 24,48 41,36 24,24 V 48 z M 44,24 v 24 h 4 V 24 h -4 z"></path></svg>\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\t\t<p class="description-primary">' +
                                            n +
                                            '</p>\t\t\t\t\t\t\t\t\t\t\t\t\t<button class="ui button secondary wedsb">İptal</button>\t\t\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t</div>';
                                        0 == $(".next-ep-holder").length &&
                                            $(".player-wrapper .player").append(
                                                l
                                            );
                                        var c = 9;
                                        window.cnt = setInterval(function () {
                                            if (
                                                (--c >= 0 &&
                                                    $(".apr").animate(
                                                        {
                                                            "stroke-dashoffset": 0,
                                                        },
                                                        12e3
                                                    ),
                                                0 === c)
                                            ) {
                                                var t = !1;
                                                streamloaded
                                                    .getFullscreen()
                                                    .then((e) => (t = e));
                                                t || router.navigate(e, !0),
                                                    console.log("redirected"),
                                                    clearInterval(window.cnt);
                                            }
                                        }, 1e3);
                                    }
                                }
                            }),
                            $("body")
                                .off("click", ".autoplay-icon")
                                .on("click", ".autoplay-icon", function (e) {
                                    clearInterval(window.cnt);
                                    var t = $(".navigate-next").attr("href");
                                    router.navigate(t, !0);
                                }),
                            $("body")
                                .off("click", "#skip_intro")
                                .on("click", "#skip_intro", function (t) {
                                    streamloaded.seekTo(e.intro[1]);
                                }),
                            $("body")
                                .off("click", ".wedsb")
                                .on("click", ".wedsb", function (e) {
                                    clearInterval(window.cnt),
                                        $(".next-ep-holder").remove();
                                })),
                        lightoff();
                },
                error: function (e) {
                    console.log(e);
                },
            });
        }
        if (0 != $("#player_container").length) {
            var o = $("#player_container");
            (i = o.data("e_id")), (a = o.data("v_lang"));
            $.ajax({
                type: "POST",
                url: "/ajax/service",
                data: { e_id: i, v_lang: a, type: "get_stream" },
                success: function (e) {
                    do_player(e);
                },
                error: function (e) {
                    console.log(e);
                },
                complete: function () {},
            });
        }
    });
}
function profile_view() {
    $.loadScript("/mofy/js/swiper.min.js", function () {
        $('.item[data-tab="watch-history"]').on("click", function (e) {
            new Swiper("[data-swiper]", {
                spaceBetween: 0,
                noSwiping: !1,
                freeMode: !0,
                freeModeMomentum: !0,
                freeModeMomentumRatio: 0.5,
                freeModeMomentumVelocityRatio: 1,
                freeModeMomentumBounce: !1,
                freeModeSticky: !1,
                watchSlidesProgress: !0,
                touchStartPreventDefault: !0,
                touchStartForcePreventDefault: !0,
                pagination: { el: ".swiper-pagination" },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                mousewheel: { invert: !1, sensitivity: 1 },
                slidesPerView: "auto",
                simulateTouch: !0,
            });
        });
    });
}
function room_player() {
    if (
        ($(".player > video").hide(),
        $("#chatbox-scroll").scrollbar({ debug: !1 }),
        $("#chatbox-scroll").scrollTop($("#chatbox-scroll")[0].scrollHeight),
        0 != $("#player_container").length)
    ) {
        var e = $("#player_container"),
            t = e.data("e_id"),
            a = e.data("owner"),
            i = $("#messageData").data("room"),
            o = $("#h_user_data").data("u_id");
        (window.playerInstance = !1),
            $.ajax({
                type: "POST",
                url: "/ajax/service",
                data: {
                    e_id: t,
                    e_id_type: "normal",
                    room: a,
                    type: "get_stream",
                },
                success: function (t) {
                    videojs.getPlayers().player_container
                        ? (videojs("player_container").dispose(),
                          window.changingtime)
                        : (window.playerSet = !0);
                    var i = t.api,
                        s = "";
                    t.success
                        ? ($.each(i.src.sources, function (e, t) {
                              s +=
                                  1 == e
                                      ? '<source src="' +
                                        t.src +
                                        '" res="' +
                                        t.label.replace("p", "") +
                                        '" label="' +
                                        t.label +
                                        '" default type="' +
                                        t.type +
                                        '">'
                                      : '<source src="' +
                                        t.src +
                                        '" res="' +
                                        t.label.replace("p", "") +
                                        '" label="' +
                                        t.label +
                                        '" type="' +
                                        t.type +
                                        '">';
                          }),
                          e.html(s),
                          (window.playerInstance = videojs(
                              "player_container",
                              nuevo,
                              function () {
                                  window.playerInstance.nuevoPlugin({
                                      relatedMenu: !1,
                                      shareMenu: !1,
                                      rateMenu: !1,
                                      zoomMenu: !1,
                                  });
                              }
                          )),
                          window.playerInstance.ready(function () {
                              (window.jwstate = t.state),
                                  this.currentTime(t.time),
                                  $("#player_container video").show(),
                                  $("#player_container").show(),
                                  this.one("timeupdate", function (e) {
                                      console.log("timeupdate"),
                                          this.paused() || this.pause(),
                                          clearInterval(window.changingtime);
                                  }),
                                  o == a
                                      ? (this.on("play", function () {
                                            console.log("playing");
                                            var e = this.currentTime(),
                                                t = this.paused()
                                                    ? "paused"
                                                    : "playing";
                                            $.ajaxQueue({
                                                url: "/ajax/service",
                                                type: "POST",
                                                data: {
                                                    type: "set_position",
                                                    time: e,
                                                    state: t,
                                                },
                                                async: !0,
                                            }),
                                                (window.changingtime =
                                                    setInterval(function () {
                                                        (e =
                                                            window.playerInstance.currentTime()),
                                                            (t = "time"),
                                                            $.ajaxQueue({
                                                                url: "/ajax/service",
                                                                type: "POST",
                                                                data: {
                                                                    type: "set_position",
                                                                    time: e,
                                                                    state: t,
                                                                },
                                                                async: !0,
                                                            }),
                                                            console.log(t + e);
                                                    }, 5e3));
                                        }),
                                        this.on("waiting", function (e) {
                                            console.log("waiting");
                                            var t = this.currentTime();
                                            $.ajaxQueue({
                                                url: "/ajax/service",
                                                type: "POST",
                                                data: {
                                                    type: "set_position",
                                                    time: t,
                                                    state: "paused",
                                                },
                                                async: !0,
                                            }),
                                                clearInterval(
                                                    window.changingtime
                                                ),
                                                window.playerInstance.one(
                                                    "timeupdate",
                                                    function () {
                                                        var e =
                                                                this.currentTime(),
                                                            t = this.paused()
                                                                ? "paused"
                                                                : "playing";
                                                        "playing" == t &&
                                                            $.ajaxQueue({
                                                                url: "/ajax/service",
                                                                type: "POST",
                                                                data: {
                                                                    type: "set_position",
                                                                    time: e,
                                                                    state: t,
                                                                },
                                                                async: !0,
                                                            });
                                                    }
                                                );
                                        }),
                                        this.on("pause", function () {
                                            console.log("pause");
                                            var e = this.currentTime(),
                                                t = this.paused()
                                                    ? "paused"
                                                    : "playing";
                                            $.ajaxQueue({
                                                url: "/ajax/service",
                                                type: "POST",
                                                data: {
                                                    type: "set_position",
                                                    time: e,
                                                    state: t,
                                                },
                                                async: !0,
                                            }),
                                                clearInterval(
                                                    window.changingtime
                                                );
                                        }))
                                      : ($(".video-js .vjs-tech").css({
                                            pointerEvents: "none",
                                        }),
                                        $(".vjs-play-control").css({
                                            pointerEvents: "none",
                                        }),
                                        $(".vjs-progress-control").css({
                                            pointerEvents: "none",
                                        }),
                                        $(".vjs-big-play-button").css({
                                            pointerEvents: "none",
                                        })),
                                  this.on("fullscreenchange", function () {
                                      if (this.isFullscreen()) {
                                          var e = $(".wt-box").html();
                                          $("#player_container").append(
                                              '<div class="wt-box fullscreen">' +
                                                  e +
                                                  "</div>"
                                          ),
                                              $(
                                                  ".wt-box.fullscreen #messageData-container"
                                              ).html(""),
                                              $(
                                                  ".wt-box.fullscreen #messageData"
                                              ).emojioneArea({
                                                  container:
                                                      ".wt-box.fullscreen #messageData-container",
                                                  hideSource: !0,
                                                  autocomplete: !1,
                                                  events: {
                                                      keypress: function (
                                                          e,
                                                          t
                                                      ) {
                                                          var a = $(
                                                              ".wt-box.fullscreen #messageData"
                                                          ).data(
                                                              "emojioneArea"
                                                          ).disabled;
                                                          if (
                                                              13 == t.which &&
                                                              !t.shiftKey
                                                          )
                                                              return (
                                                                  t.preventDefault(),
                                                                  1 != a &&
                                                                      addChat(),
                                                                  !1
                                                              );
                                                      },
                                                  },
                                              }),
                                              scrollable.scrollbar({
                                                  debug: !1,
                                              }),
                                              $("#chatbox-scroll").scrollTop(
                                                  $("#chatbox-scroll")[0]
                                                      .scrollHeight
                                              );
                                      } else $(".wt-box.fullscreen").remove();
                                  });
                          }))
                        : getNotification("error", "Video bilgisi bulunamadı.");
                },
                error: function (e) {
                    console.log(e);
                },
            }),
            (window.playerState = window.drone.subscribe(
                "playerState-" + a + "-" + i
            )),
            (window.newEpisode = window.drone.subscribe(
                "newEpisode-" + a + "-" + i
            )),
            (window.chatState = window.drone.subscribe(
                "chatState-" + a + "-" + i
            )),
            (window.userTyping = window.drone.subscribe(
                "userIsTypingEvent-" + a + "-" + i
            )),
            window.drone.on("authenticate", function (e) {
                (window.presenceRoom =
                    window.drone.subscribe("observable-room")),
                    window.presenceRoom.on("member_join", function (e) {
                        !(function (e) {
                            1 != $("#user-" + e.authData.uid).length &&
                                $(".friends-who-watching > div").append(
                                    '<div class="item" id="user-' +
                                        e.authData.uid +
                                        '" data-tooltip="' +
                                        e.authData.username +
                                        '" data-inverted=""><img class="ui avatar image loading" src="' +
                                        ("avatar.jpg" != e.authData.avatar
                                            ? "uploads/users/" +
                                              e.authData.avatar
                                            : "https://api.adorable.io/avatars/285/" +
                                              e.authData.username) +
                                        '"></div>'
                                );
                            clearInterval(window.roomownerleave);
                        })(e);
                    }),
                    window.presenceRoom.on("member_leave", function (e) {
                        !(function (e) {
                            window.playerInstance.paused();
                            e.authData.room == i &&
                                ((window.roomownerleave = setInterval(
                                    function () {
                                        "playing" ==
                                            (window.playerInstance.paused()
                                                ? "paused"
                                                : "playing") &&
                                            window.playerInstance.pause();
                                    },
                                    100
                                )),
                                getNotification(
                                    "error",
                                    "Oda sahibi odayı terk etti."
                                ));
                            $("#user-" + e.authData.uid)
                                .fadeOut("200")
                                .remove();
                        })(e);
                    });
            }),
            window.chatState.on("data", function (e) {
                o != e.u_id &&
                    ($(".chat-box #chatbox-scroll").append(
                        '<div class="chat-item" id="' +
                            e.rc_id +
                            '"><div class="ci-message"><div class="ci-author">' +
                            (e.u_name ? e.u_name : "@" + e.u_username) +
                            "</div><p>" +
                            e.m_message +
                            "</p></div></div>"
                    ),
                    $("#chatbox-scroll").scrollTop(
                        $("#chatbox-scroll")[0].scrollHeight
                    ));
            }),
            window.userTyping.on("data", function (e) {
                var t;
                $("#h_user_data").data("u_id");
                $("#h_user_data").data("u_username") != e.username &&
                    ($(".user-typing").text(e.username + " yazıyor"),
                    clearTimeout(t),
                    (t = setTimeout(function () {
                        $(".user-typing").html("");
                    }, 2e3)));
            }),
            o != a &&
                (window.newEpisode.on("data", function (e) {
                    var t = window.location.pathname,
                        a = $("title").text();
                    router.navigate(
                        t + "?rel=episodeChanged_" + e.new_episode,
                        !0
                    ),
                        history.replaceState(null, a, t);
                }),
                window.playerState.on("data", function (e) {
                    var t = window.playerInstance.paused()
                            ? "paused"
                            : "playing",
                        a = window.playerInstance.currentTime();
                    switch (e.state) {
                        case "time":
                            "paused" == t
                                ? (window.playerInstance.currentTime(e.time),
                                  window.playerInstance.play())
                                : (a < e.time - 4 || a > e.time + 4) &&
                                  (window.playerInstance.currentTime(e.time),
                                  "playing" != t &&
                                      window.playerInstance.play());
                            break;
                        case "paused":
                            window.playerInstance.currentTime(e.time),
                                "paused" != t && window.playerInstance.pause();
                            break;
                        case "playing":
                            window.playerInstance.currentTime(e.time),
                                window.playerInstance.muted() &&
                                    (window.onfocus = function () {
                                        window.playerInstance.muted(!1);
                                    }),
                                "playing" != t && window.playerInstance.play();
                            break;
                        case "seek":
                            "playing" != t && window.playerInstance.play();
                    }
                }));
    }
}
function publishUserTyping(e) {
    return $.post("/ajax/service", {
        type: "publishUserTyping",
        username: e,
        room: $("#r_id").val(),
    });
}
function $id(e) {
    return document.getElementById(e);
}
function see_notification(e = 0) {
    $.ajax({
        type: "POST",
        url: "/ajax/service",
        dataType: "json",
        data: { type: "see_notifications" },
        success: function (t) {
            t && 0 == e
                ? t.error
                    ? getNotification("error", t.error)
                    : t.success
                    ? getNotification("success", t.success)
                    : t.session && (window.location.href = "/")
                : 1 == e &&
                  $(".ui.top.right.pointing.dropdown").removeAttr("onclick");
        },
    });
}
(window.currentRequest = !1),
    (window.currentSearch = !1),
    (jQuery.loadScript = function (e, t) {
        jQuery.ajax({ url: e, dataType: "script", success: t, async: !0 });
    }),
    comolokko("udys", Date.now(), 18e6),
    (function (e) {
        var t = e({});
        e.ajaxQueue = function (a) {
            var i = a.complete;
            t.queue(function (t) {
                (a.complete = function () {
                    i && i.apply(this, arguments), t();
                }),
                    e.ajax(a);
            });
        };
    })(jQuery),
    (function () {
        "use strict";
        $("#h_user_data").length;
        var e = e || {};
        (e.init = function () {
            e.UIEvents(), e.FormEvents(), e.WidgetEvents(), e.BaseEvents();
            var t = 0;
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            ) && (t = 1),
                $.getJSON("/v/?m=" + t, function (e) {
                    $("[data-gets]").each(function () {
                        var t = $(this).data("type");
                        e.hasOwnProperty(t) && $(this).show().html(e[t]);
                    });
                }),
                $(window).scroll(function () {
                    $(this).scrollTop() > 100
                        ? $(".yukariCik").css("display", "block")
                        : $(".yukariCik").css("display", "none");
                }),
                $(".yukariCik")
                    .mouseover(function () {
                        $(this)
                            .find("span.yukariYazi")
                            .stop(1)
                            .animate({ width: "70px" });
                    })
                    .mouseout(function () {
                        $(this)
                            .find("span.yukariYazi")
                            .stop(1)
                            .delay(200)
                            .animate({ width: 0 });
                    })
                    .click(function () {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    }),
                "/" == window.location.pathname
                    ? (isHomere = setTimeout(function () {
                          window.location.reload();
                      }, 1e5))
                    : clearTimeout(isHomere);
        }),
            (e.UIEvents = function () {
                swal.setDefaults({
                    buttonsStyling: !1,
                    confirmButtonClass: "ui button primary mr-xs",
                    cancelButtonClass: "ui button secondary ml-xs",
                }),
                    0 === $("#h_user_data").length &&
                        ($("body")
                            .off("click", "[onlyusers]")
                            .on("click", "[onlyusers]", function (e) {
                                e.preventDefault(),
                                    $.loadScript(
                                        "https://www.google.com/recaptcha/api.js",
                                        function () {}
                                    ),
                                    swal({
                                        title: '<div id="logo" class="hidden-xs"><a href="/" data-navigo=""></a></div>',
                                        html: '<a href="/facebooklogin" type="button" class="fluid ui facebook button" id="facebook-login" type="button">Facebook ile giriş yap</a><br /><div class="ore">VEYA</div><form autocomplete="on"><input type="text" id="swusername" placeholder="Kullanıcı Adı" class="swal2-input" autocomplete="on"><input type="password" id="swpassword" placeholder="Şifre" class="swal2-input" autocomplete="on"></form><br/><div class="g-recaptcha" data-sitekey="6LdR9dkZAAAAAJZ1DT_QLOOmWqwIhLeULQX9mIi-" render="explicit"></div><br/><a id="reset-password" class="ui button secondary ml-xs">Şifre Sıfırla</a><a id="user-register" class="ui button secondary ml-xs">Kayıt Ol</a><style>.g-recaptcha div { margin: 0 auto }</style>',
                                        confirmButtonColor: "#3085d6",
                                        confirmButtonText: "Giriş Yap",
                                        showCloseButton: !0,
                                        showCancelButton: !1,
                                        showLoaderOnConfirm: !0,
                                        preConfirm: (e) => {
                                            var t = {
                                                username:
                                                    $("#swusername").val(),
                                                password:
                                                    $("#swpassword").val(),
                                                remember: "1",
                                                type: "login",
                                                gCat: grecaptcha.getResponse(),
                                            };
                                            return $.ajax({
                                                type: "POST",
                                                url: "/ajax/service",
                                                dataType: "json",
                                                data: t,
                                                success: function (e) {
                                                    e
                                                        ? e.success
                                                            ? (getNotification(
                                                                  "success",
                                                                  e.success
                                                              ),
                                                              window.location.reload(
                                                                  1
                                                              ))
                                                            : (swal.showValidationError(
                                                                  "Hata: " +
                                                                      e.error
                                                              ),
                                                              grecaptcha.reset())
                                                        : (swal.showValidationError(
                                                              "Hata: Lütfen formu boş bırakmayınız."
                                                          ),
                                                          grecaptcha.reset());
                                                },
                                            });
                                        },
                                        allowOutsideClick: () =>
                                            !swal.isLoading(),
                                    }).then((e) => {}),
                                    $(".swal2-input")
                                        .off("keypress")
                                        .on("keypress", function (e) {
                                            13 == e.which &&
                                                Swal.clickConfirm();
                                        });
                            }),
                        $("body")
                            .off("click", "a#user-register")
                            .on("click", "a#user-register", function (e) {
                                e.preventDefault(),
                                    $.loadScript(
                                        "https://www.google.com/recaptcha/api.js",
                                        function () {}
                                    ),
                                    swal({
                                        title: '<div id="logo" class="hidden-xs"><a href="/" data-navigo=""></a></div>',
                                        html: '<a href="/facebooklogin" type="button" class="fluid ui facebook button" id="facebook-login" type="button">Facebook ile giriş yap</a><br /><div class="ore">VEYA</div><form autocomplete="on"><input type="text" id="swrusername" placeholder="Kullanıcı Adı" class="swal2-input" autocomplete="on"><input type="text" id="swremail" placeholder="E-posta Adresin" class="swal2-input" autocomplete="on"><input type="password" id="swrpassword" placeholder="Şifre" class="swal2-input" autocomplete="on"><input type="password" id="swrrpassword" placeholder="Şifre Tekrar" class="swal2-input" autocomplete="on"></form><br/><div class="g-recaptcha" data-sitekey="6LdR9dkZAAAAAJZ1DT_QLOOmWqwIhLeULQX9mIi-" render="explicit"></div><br/><a id="reset-password" class="ui button secondary ml-xs">Şifre Sıfırla</a><a class="ui button secondary ml-xs" onlyusers>Giriş Yap</a><style>.g-recaptcha div { margin: 0 auto }</style>',
                                        showCancelButton: !0,
                                        confirmButtonColor: "#3085d6",
                                        confirmButtonText: "Kayıt Ol",
                                        showCloseButton: !0,
                                        showCancelButton: !1,
                                        showLoaderOnConfirm: !0,
                                        preConfirm: (e) => {
                                            var t = {
                                                email: $("#swremail").val(),
                                                username:
                                                    $("#swrusername").val(),
                                                password:
                                                    $("#swrpassword").val(),
                                                password_try:
                                                    $("#swrrpassword").val(),
                                                type: "register",
                                                gCat: grecaptcha.getResponse(),
                                            };
                                            return $.ajax({
                                                type: "POST",
                                                url: "/ajax/service",
                                                dataType: "json",
                                                data: t,
                                                success: function (e) {
                                                    e
                                                        ? e.success
                                                            ? (getNotification(
                                                                  "success",
                                                                  e.success
                                                              ),
                                                              window.location.reload(
                                                                  1
                                                              ))
                                                            : (swal.showValidationError(
                                                                  "Hata: " +
                                                                      e.error
                                                              ),
                                                              grecaptcha.reset())
                                                        : (swal.showValidationError(
                                                              "Hata: Lütfen formu boş bırakmayınız."
                                                          ),
                                                          grecaptcha.reset());
                                                },
                                            });
                                        },
                                        allowOutsideClick: () =>
                                            !swal.isLoading(),
                                    }).then((e) => {}),
                                    $(".swal2-input")
                                        .off("keypress")
                                        .on("keypress", function (e) {
                                            13 == e.which &&
                                                Swal.clickConfirm();
                                        });
                            }));
                var e = new LazyLoad({ elements_selector: ".lazy-wide" });
                if (
                    ($().dropdown && $(".ui.dropdown").dropdown(),
                    $().checkbox && $(".ui.checkbox").checkbox(),
                    $().sticky &&
                        $(".ui.sticky").sticky({ context: "#context" }),
                    $(".ydslider").length &&
                        $(".ydslider").slick({
                            prevArrow:
                                '<div class="slickprev" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"></div>',
                            nextArrow:
                                '<div class="slicknext" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"></div>',
                            dots: !0,
                            infinite: !0,
                            speed: 500,
                            lazyLoad: "ondemand",
                            slidesToShow: 4,
                            slidesToScroll: 3,
                            variableWidth: !0,
                            autoplay: !0,
                            autoplaySpeed: 3e3,
                            responsive: [
                                {
                                    breakpoint: 1024,
                                    settings: {
                                        slidesToShow: 3,
                                        slidesToScroll: 2,
                                        infinite: !0,
                                        dots: !0,
                                        lazyLoad: "ondemand",
                                    },
                                },
                                {
                                    breakpoint: 600,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 1,
                                        infinite: !0,
                                        dots: !0,
                                        lazyLoad: "ondemand",
                                    },
                                },
                            ],
                        }),
                    $().modal &&
                        $("body")
                            .off("click", ".media-trailer")
                            .on("click", ".media-trailer", function (e) {
                                e.preventDefault();
                                var t = $(this).data("yt");
                                $(".ui.modal iframe").attr(
                                    "src",
                                    "https://www.youtube.com/embed/" + t
                                ),
                                    $("#fragman.ui.modal")
                                        .modal({
                                            onHide: function () {
                                                $(".ui.modal iframe").attr(
                                                    "src",
                                                    ""
                                                );
                                            },
                                        })
                                        .modal("show");
                            }),
                    $("body")
                        .off("click", ".watched-episodes-more-link")
                        .on(
                            "click",
                            ".watched-episodes-more-link",
                            function (e) {
                                if (!moreRequest.more) {
                                    moreRequest.more = !0;
                                    var t = $(this),
                                        a = t.data("sid"),
                                        i = t.data("uid"),
                                        o = t.data("eid");
                                    "cat-tags" != t.parent().attr("class") &&
                                        ($("span.watched-episodes-more-link")
                                            .removeClass("teal")
                                            .removeClass("grey")
                                            .addClass("grey"),
                                        t.addClass("teal").removeClass("grey")),
                                        $(".watched-episodes-" + a + "-" + o)
                                            .length < 1
                                            ? ($(
                                                  ".watched-episodes-more"
                                              ).removeClass("active"),
                                              $("#h_user_data").length > 0
                                                  ? (t
                                                        .find(".icon")
                                                        .prop(
                                                            "class",
                                                            "icon animate-spin icon-spinner"
                                                        ),
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "/ajax/service",
                                                        dataType: "json",
                                                        data: {
                                                            sid: a,
                                                            uid: i,
                                                            eid: o,
                                                            type: "get_watch_more",
                                                        },
                                                        success: function (e) {
                                                            if (
                                                                1 == e.success
                                                            ) {
                                                                t.find(
                                                                    ".icon"
                                                                ).prop(
                                                                    "class",
                                                                    "icon icon-down-dir"
                                                                );
                                                                var i =
                                                                    t.closest(
                                                                        ".grid.container"
                                                                    );
                                                                $(
                                                                    ".watched-episodes-more"
                                                                )
                                                                    .stop(
                                                                        !0,
                                                                        !0
                                                                    )
                                                                    .fadeOut(
                                                                        "fast"
                                                                    ),
                                                                    i.append(
                                                                        e.return
                                                                    ),
                                                                    $(
                                                                        ".watched-episodes-" +
                                                                            a +
                                                                            "-" +
                                                                            o
                                                                    )
                                                                        .fadeIn(
                                                                            "fast"
                                                                        )
                                                                        .addClass(
                                                                            "active"
                                                                        );
                                                            }
                                                        },
                                                        complete: function () {
                                                            moreRequest.more =
                                                                !1;
                                                        },
                                                    }))
                                                  : (t.prop(
                                                        "disabled",
                                                        "disabled"
                                                    ),
                                                    (moreRequest.more = !1)))
                                            : ($(
                                                  ".watched-episodes-" +
                                                      a +
                                                      "-" +
                                                      o
                                              ).not(".active").length
                                                  ? ($(".watched-episodes-more")
                                                        .stop(!0, !0)
                                                        .fadeOut("fast")
                                                        .removeClass("active"),
                                                    $(
                                                        ".watched-episodes-" +
                                                            a +
                                                            "-" +
                                                            o
                                                    ).fadeIn("fast"),
                                                    $(
                                                        ".watched-episodes-" +
                                                            a +
                                                            "-" +
                                                            o
                                                    ).addClass("active"))
                                                  : "cat-tags" !=
                                                        t
                                                            .parent()
                                                            .attr("class") &&
                                                    ($(".watched-episodes-more")
                                                        .stop(!0, !0)
                                                        .fadeOut("fast")
                                                        .removeClass("active"),
                                                    $(
                                                        "span.watched-episodes-more-link"
                                                    )
                                                        .removeClass("teal")
                                                        .addClass("grey")),
                                              (moreRequest.more = !1));
                                }
                                return e.preventDefault, !1;
                            }
                        ),
                    $("body")
                        .off("click", "[data-ytid]")
                        .on("click", "[data-ytid]", function (e) {
                            e.preventDefault();
                            var t = $(this).data("ytid");
                            $(".this-episode-not-ready > div").remove(),
                                $("#fragman-now").remove(),
                                $("#fragman-now-youtube").attr(
                                    "src",
                                    "https://www.youtube.com/embed/" +
                                        t +
                                        "?autoplay=1&rel=0"
                                );
                        }),
                    $().tab &&
                        ($("#series-tabs .item").tab(),
                        $(".tabular.menu .item").tab()),
                    $().fitVids && $("body").fitVids(),
                    $("body").on("click", "[data-modal]", function (e) {
                        e.preventDefault();
                        var t = $(this).data("modal");
                        $("#" + t + ".modal").modal("show");
                    }),
                    $("body")
                        .off("click", "[data-report]")
                        .on("click", "[data-report]", function (e) {
                            e.preventDefault();
                            var t = $(this).data("report"),
                                a = $(this).data("report-type");
                            $(".comment-item").css({
                                backgroundColor: "transparent",
                            }),
                                "comment" == a &&
                                    $("#comment_" + t).css({
                                        backgroundColor: "#4a1f1d",
                                    }),
                                $(
                                    '#modal-report-user [name="episode"]:checked'
                                ).prop("checked", !1),
                                $(
                                    '#modal-report-user [name="comment"]:checked'
                                ).prop("checked", !1),
                                $(
                                    '#modal-report-user [name="report-reason"]'
                                ).val(""),
                                $(
                                    '#modal-report-user [name="report_type"]'
                                ).val(a),
                                $(
                                    '#modal-report-user [name="reporting_id"]'
                                ).val(t),
                                $(
                                    "#modal-report-user [data-report-type]"
                                ).hide(),
                                $(
                                    "#modal-report-user [data-report-type=" + a
                                ).show(),
                                $("#modal-report-user.modal").modal("show");
                        }),
                    $("body")
                        .off("click", ".collection-delete")
                        .on("click", ".collection-delete", function (e) {
                            e.preventDefault();
                            var t = $(this).data("id");
                            swal({
                                title: "Koleksiyonun Silinecek",
                                text: "Bu işlemi yapmak istediğinden emin misin?",
                                type: "warning",
                                showCancelButton: !0,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Koleksiyonu Sil",
                                cancelButtonText: "Kapat",
                            }).then((e) => {
                                e.value &&
                                    $.ajax({
                                        type: "POST",
                                        url: "/ajax/service",
                                        dataType: "json",
                                        data: {
                                            status: 4,
                                            data: t,
                                            type: "actionData",
                                        },
                                        success: function (e) {
                                            e &&
                                                (e.error
                                                    ? getNotification(
                                                          "error",
                                                          e.error
                                                      )
                                                    : e.success
                                                    ? (getNotification(
                                                          "success",
                                                          e.success
                                                      ),
                                                      (window.location.href =
                                                          "/koleksiyon"))
                                                    : e.session &&
                                                      (window.location.href =
                                                          "/"));
                                        },
                                    });
                            });
                        }),
                    $("body")
                        .off("submit", "#reportThis")
                        .on("submit", "#reportThis", function (e) {
                            e.preventDefault();
                            var t = $('[name="report_type"]', this).val(),
                                a = $('[name="episode"]:checked', this).val(),
                                i = $('[name="reporting_id"]', this).val(),
                                o = $('[name="comment"]:checked', this).val(),
                                s = $('[name="report-reason"]', this).val();
                            "comment" == t &&
                                $("#comment_" + i).css({
                                    backgroundColor: "transparent",
                                }),
                                (("comment" == t && o) ||
                                    ("episode" == t && a)) &&
                                    $.ajax({
                                        type: "POST",
                                        url: "/ajax/service",
                                        dataType: "json",
                                        data: {
                                            report_type: t,
                                            episode: a,
                                            comment: o,
                                            reporting_id: i,
                                            report_reason: s,
                                            type: "reportThis",
                                        },
                                        success: function (e) {
                                            e &&
                                                (e.error
                                                    ? getNotification(
                                                          "error",
                                                          e.error
                                                      )
                                                    : e.success
                                                    ? ($(
                                                          "#modal-report-user.modal"
                                                      ).modal("hide"),
                                                      getNotification(
                                                          "success",
                                                          "Şikayetin bize ulaştı, en kısa sürede ilgilenip seni bilgilendireceğiz."
                                                      ))
                                                    : e.session &&
                                                      (window.location.href =
                                                          "/"));
                                        },
                                        error: function (e) {},
                                    });
                        }),
                    $("body")
                        .off("click", "[data-block]")
                        .on("click", "[data-block]", function (e) {
                            e.preventDefault();
                            var t = $(this).data("block"),
                                a = window.location.pathname,
                                i = $(this);
                            i.hasClass("profile-block-modal") &&
                                $("#modal-block-user.modal").modal("hide"),
                                t &&
                                    $.ajax({
                                        type: "POST",
                                        url: "/ajax/service",
                                        dataType: "json",
                                        data: { u_id: t, type: "blockUser" },
                                        success: function (e) {
                                            e &&
                                                (e.error
                                                    ? getNotification(
                                                          "error",
                                                          e.error
                                                      )
                                                    : e.success
                                                    ? i.hasClass(
                                                          "profile-block-modal"
                                                      ) &&
                                                      router.navigate(
                                                          a +
                                                              "#ref=blocked_" +
                                                              t,
                                                          !0
                                                      )
                                                    : e.session &&
                                                      (window.location.href =
                                                          "/"));
                                        },
                                        error: function (e) {},
                                    });
                        }),
                    $("body")
                        .off("click", "[data-lango]")
                        .on("click", "[data-lango]", function (e) {
                            e.preventDefault();
                            var t = $(this),
                                a = t.data("type"),
                                i = t.data("eid");
                            if (t.hasClass("active")) return !1;
                            $("[data-lango]").removeClass("active"),
                                t.addClass("active"),
                                $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: {
                                        lang: a,
                                        episode: i,
                                        type: "langTab",
                                    },
                                    success: function (e) {
                                        e &&
                                            (e.success
                                                ? ($(
                                                      ".alternatives-for-this"
                                                  ).html(e.data),
                                                  $(
                                                      ".alternatives-for-this div:first-child"
                                                  ).trigger("click"))
                                                : getNotification(
                                                      "error",
                                                      e.error
                                                  ));
                                    },
                                });
                        }),
                    $("body")
                        .off("click", "[data-unblock]")
                        .on("click", "[data-unblock]", function (e) {
                            e.preventDefault();
                            var t = $(this).data("unblock"),
                                a = window.location.pathname,
                                i = $(this);
                            t &&
                                $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: { u_id: t, type: "removeBlockUser" },
                                    success: function (e) {
                                        if (e)
                                            if (e.error)
                                                getNotification(
                                                    "error",
                                                    e.error
                                                );
                                            else if (e.success) {
                                                if (
                                                    ((i.hasClass(
                                                        "profile-dropdown"
                                                    ) ||
                                                        i.hasClass(
                                                            "profile-follow"
                                                        )) &&
                                                        router.navigate(
                                                            a +
                                                                "#ref=unblocked_" +
                                                                t,
                                                            !0
                                                        ),
                                                    i.hasClass(
                                                        "profile-blocked-modal"
                                                    ))
                                                ) {
                                                    var o = parseInt(
                                                        $(
                                                            "#modal-blocked-users .generic-header span"
                                                        ).text()
                                                    );
                                                    $(
                                                        "#modal-blocked-users .generic-header span"
                                                    ).text(o - 1),
                                                        $(
                                                            "#blocked-users-count a.count"
                                                        ).text(o - 1),
                                                        i
                                                            .parents(".item")
                                                            .fadeOut(),
                                                        o - 1 == 0 &&
                                                            ($(
                                                                "#modal-blocked-users.modal"
                                                            ).modal("hide"),
                                                            $(
                                                                "#blocked-users-count"
                                                            ).remove());
                                                }
                                            } else
                                                e.session &&
                                                    (window.location.href =
                                                        "/");
                                    },
                                    error: function (e) {},
                                });
                        }),
                    $().emojioneArea)
                ) {
                    $("#commentData").emojioneArea({
                        container: "#commentData-container",
                        hideSource: !0,
                        autocomplete: !1,
                        events: {
                            keypress: function (e, t) {
                                var a =
                                    $("#commentData").data(
                                        "emojioneArea"
                                    ).disabled;
                                if (13 == t.which && !t.shiftKey)
                                    return (
                                        t.preventDefault(),
                                        1 != a && addComment(),
                                        !1
                                    );
                            },
                            emojibtn_click: function (e, t) {
                                e.closest(".emojionearea")
                                    .find(".emojionearea-button-close")
                                    .click();
                            },
                        },
                    });
                    var t = !0,
                        a = !1;
                    $("#messageData").emojioneArea({
                        container: "#messageData-container",
                        hideSource: !0,
                        autocomplete: !1,
                        events: {
                            keypress: function (e, i) {
                                var o =
                                    $("#messageData").data(
                                        "emojioneArea"
                                    ).disabled;
                                if (13 == i.which && !i.shiftKey)
                                    return (
                                        i.preventDefault(),
                                        1 != o && addChat(),
                                        !1
                                    );
                                clearTimeout(a),
                                    (a = window.setTimeout(function () {
                                        (t = !0), $(".user-typing").text("");
                                    }, 2e3)),
                                    t &&
                                        (publishUserTyping(
                                            $("#h_user_data").data("u_username")
                                        ),
                                        (t = !1),
                                        (a = window.setTimeout(function () {
                                            (t = !0),
                                                $(".user-typing").text("");
                                        }, 2e3)));
                            },
                            emojibtn_click: function (e, t) {
                                e.closest(".emojionearea")
                                    .find(".emojionearea-button-close")
                                    .click();
                            },
                        },
                    });
                }
                if ($("#h_user_data").length > 0) {
                    $("body")
                        .off("click", ".fnc_addComment")
                        .on("click", ".fnc_addChat", addChat),
                        $("body")
                            .off("click", ".fnc_addComment")
                            .on("click", ".fnc_addComment", addComment),
                        $("body")
                            .off("click", ".fnc_addFollow")
                            .on("click", ".fnc_addFollow", function (e) {
                                var t = $(this),
                                    a = $(this).data("series"),
                                    i = $(this).data("status"),
                                    o = $(this).data("type");
                                if (a && i) {
                                    $(this)
                                        .addClass("disabled")
                                        .prop("disabled", !0)
                                        .attr("disabled", !0);
                                    $(this).html();
                                    $(this).html("Yükleniyor"),
                                        $.ajax({
                                            type: "POST",
                                            url: "/ajax/service",
                                            dataType: "json",
                                            data: {
                                                data: a,
                                                tp: i,
                                                type: "addFollow",
                                            },
                                            success: function (e) {
                                                e &&
                                                    (e.error
                                                        ? getNotification(
                                                              "error",
                                                              e.error
                                                          )
                                                        : e.success &&
                                                          (getNotification(
                                                              "success",
                                                              e.success
                                                          ),
                                                          1 == e.status
                                                              ? o
                                                                  ? $(val).html(
                                                                        checkedIco
                                                                    )
                                                                  : (t
                                                                        .removeClass(
                                                                            "secondary"
                                                                        )
                                                                        .addClass(
                                                                            "primary"
                                                                        ),
                                                                    t.text(
                                                                        e._t
                                                                    ))
                                                              : 2 == e.status
                                                              ? o ||
                                                                (t
                                                                    .removeClass(
                                                                        "primary"
                                                                    )
                                                                    .addClass(
                                                                        "secondary"
                                                                    ),
                                                                t.text(e._t))
                                                              : e.session &&
                                                                (window.location.href =
                                                                    "/")));
                                            },
                                            error: function (e) {},
                                            complete: function () {
                                                t.removeClass("disabled")
                                                    .prop("disabled", !1)
                                                    .attr("disabled", !1);
                                            },
                                        });
                                }
                                e.preventDefault();
                            });
                    var i = 0;
                    $("body")
                        .off("change", ".fnc_addWatch input:checkbox")
                        .on(
                            "change",
                            ".fnc_addWatch input:checkbox",
                            function () {
                                if ($("#h_user_data").length < 0) return !1;
                                var e = $(this)
                                        .parents(".fnc_addWatch")
                                        .data("episode"),
                                    t = $(this);
                                e &&
                                    $.ajax({
                                        type: "POST",
                                        url: "/ajax/service",
                                        dataType: "json",
                                        data: {
                                            episode: e,
                                            type: "addWatchList",
                                        },
                                        success: function (a) {
                                            a &&
                                                (a.success
                                                    ? (getNotification(
                                                          "success",
                                                          a.success
                                                      ),
                                                      ++i >= 3 &&
                                                          $(
                                                              "[data-episode=" +
                                                                  e +
                                                                  "] input"
                                                          ).attr({
                                                              disabled: !0,
                                                              checked: a.add,
                                                          }),
                                                      1 == a.add
                                                          ? ($(
                                                                "[data-episode=" +
                                                                    e +
                                                                    "] input"
                                                            )
                                                                .attr({
                                                                    checked:
                                                                        a.add,
                                                                })
                                                                .parent("div")
                                                                .addClass(
                                                                    "checked"
                                                                ),
                                                            $(
                                                                "[data-episode=" +
                                                                    e +
                                                                    "] label div"
                                                            )
                                                                .removeClass(
                                                                    "red green"
                                                                )
                                                                .addClass(
                                                                    "green"
                                                                ))
                                                          : ($(
                                                                "[data-episode=" +
                                                                    e +
                                                                    "] input"
                                                            )
                                                                .attr({
                                                                    checked:
                                                                        a.add,
                                                                })
                                                                .parent("div")
                                                                .removeClass(
                                                                    "checked"
                                                                ),
                                                            $(
                                                                "[data-episode=" +
                                                                    e +
                                                                    "] label div"
                                                            )
                                                                .removeClass(
                                                                    "red green"
                                                                )
                                                                .addClass(
                                                                    "red"
                                                                )))
                                                    : a.session
                                                    ? (window.location.href =
                                                          "/")
                                                    : (t.prop("checked", !1),
                                                      getNotification(
                                                          "error",
                                                          a.error
                                                      )));
                                        },
                                        complete: function () {},
                                    });
                            }
                        ),
                        checkepisodesofthisSeason($("#seasons-menu .active")),
                        $("body")
                            .off("click", "#seasons-menu > .menu > a")
                            .on(
                                "click",
                                "#seasons-menu > .menu > a",
                                function () {
                                    var e = $(this).data("season");
                                    $("#season-episode-list-title > span").text(
                                        e
                                    ),
                                        checkepisodesofthisSeason($(this));
                                }
                            ),
                        $("body")
                            .off("change", "#autoplay")
                            .on("change", "#autoplay", function () {
                                var e;
                                (e = $(this).is(":checked") ? "checked" : ""),
                                    $.ajax({
                                        type: "POST",
                                        url: "/ajax/service",
                                        dataType: "json",
                                        data: {
                                            autoplay: e,
                                            type: "autoplaySet",
                                        },
                                    });
                            }),
                        $("body")
                            .off("click", ".cl_add_item")
                            .on("click", ".cl_add_item", function (e) {
                                e.preventDefault();
                                var t = $(this).data("clid"),
                                    a = $(this).data("series");
                                t &&
                                    a &&
                                    $.ajax({
                                        type: "POST",
                                        url: "/ajax/service",
                                        dataType: "json",
                                        data: {
                                            col_id: t,
                                            s_id: a,
                                            type: "add_cols",
                                        },
                                        success: function (e) {
                                            e &&
                                                (e.success
                                                    ? getNotification(
                                                          "success",
                                                          e.success
                                                      )
                                                    : e.session
                                                    ? (window.location.href =
                                                          "/")
                                                    : getNotification(
                                                          "error",
                                                          e.error
                                                      ));
                                        },
                                    });
                            });
                    var o = 0;
                    $("body")
                        .off("click", ".fnc_allofthisSeason")
                        .on("click", ".fnc_allofthisSeason", function () {
                            if ($("#h_user_data").length < 0) return !1;
                            var e = $(this).data("series"),
                                t = $(".season-list-column .active").data(
                                    "season"
                                );
                            if ($("input[name='all-episodes']").is(":disabled"))
                                return !1;
                            if (e && t) {
                                var a = $("input[name='all-episodes']").is(
                                    ":checked"
                                );
                                $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: {
                                        types: a,
                                        s_id: e,
                                        season: t,
                                        type: "addSeasonList",
                                    },
                                    success: function (e) {
                                        e &&
                                            (e.success
                                                ? (o++,
                                                  getNotification(
                                                      "success",
                                                      e.success
                                                  ),
                                                  o >= 2 &&
                                                      $(
                                                          "input[name='all-episodes']"
                                                      ).attr({
                                                          disabled: !0,
                                                          checked: e.add,
                                                      }),
                                                  $(
                                                      ".season_" + t + " input"
                                                  ).attr({ checked: e.add }))
                                                : e.session
                                                ? (window.location.href = "/")
                                                : getNotification(
                                                      "error",
                                                      e.error
                                                  ));
                                    },
                                    complete: function () {},
                                });
                            } else getNotification("error", "Bölüm yok");
                        }),
                        $("body")
                            .off("click touchstart", "[data-clap]")
                            .on(
                                "click touchstart",
                                "[data-clap]",
                                function (e) {
                                    e.preventDefault();
                                    var t = $(this),
                                        a = $(this).data("clap"),
                                        i = $(".clap-count").text();
                                    a &&
                                        (t.prop("disabled", !0),
                                        $.ajax({
                                            type: "POST",
                                            url: "/ajax/service",
                                            dataType: "json",
                                            data: { clap: a, type: "addClap" },
                                            success: function (e) {
                                                e &&
                                                    (e.error
                                                        ? getNotification(
                                                              "error",
                                                              e.error
                                                          )
                                                        : e.success
                                                        ? (t.addClass(
                                                              "clapped"
                                                          ),
                                                          $(".clap-count").html(
                                                              parseInt(i) + 1
                                                          ))
                                                        : e.session &&
                                                          (window.location.href =
                                                              "/"));
                                            },
                                            error: function (e) {},
                                            complete: function () {
                                                t.removeClass("disabled")
                                                    .prop("disabled", !1)
                                                    .attr("disabled", !1);
                                            },
                                        }));
                                }
                            ),
                        $("body")
                            .off("click", ".fnc_addFeel")
                            .on("click", ".fnc_addFeel", function (e) {
                                e.preventDefault();
                                var t = $(this).attr("data-id"),
                                    a = $(this).attr("data-type"),
                                    i = $(this).attr("data-status"),
                                    o = $(this),
                                    s = $("span", this).text(),
                                    r = $(this).attr("data-comment");
                                t &&
                                    a &&
                                    (o.prop("disabled", !0),
                                    $.ajax({
                                        type: "POST",
                                        url: "/ajax/service",
                                        dataType: "json",
                                        data: {
                                            key: t,
                                            status: a,
                                            fe: i,
                                            cm: r,
                                            type: "addFeel",
                                        },
                                        success: function (e) {
                                            e &&
                                                (e.error
                                                    ? getNotification(
                                                          "error",
                                                          e.error
                                                      )
                                                    : e.success
                                                    ? 1 != e.success
                                                        ? 1 == e.status
                                                            ? (o
                                                                  .removeClass(
                                                                      "secondary"
                                                                  )
                                                                  .addClass(
                                                                      "primary"
                                                                  ),
                                                              o
                                                                  .children(
                                                                      "span"
                                                                  )
                                                                  .html(
                                                                      parseInt(
                                                                          s
                                                                      ) + 1
                                                                  ))
                                                            : 2 == e.status &&
                                                              (o
                                                                  .removeClass(
                                                                      "secondary"
                                                                  )
                                                                  .addClass(
                                                                      "red"
                                                                  ),
                                                              o
                                                                  .children(
                                                                      "span"
                                                                  )
                                                                  .html(
                                                                      parseInt(
                                                                          s
                                                                      ) + 1
                                                                  ))
                                                        : 1 == e.success &&
                                                          (o
                                                              .removeClass(
                                                                  "secondary"
                                                              )
                                                              .addClass(
                                                                  "text-red"
                                                              ),
                                                          o
                                                              .children("span")
                                                              .html(
                                                                  parseInt(s) +
                                                                      1
                                                              ))
                                                    : e.session &&
                                                      (window.location.href =
                                                          "/"));
                                        },
                                        error: function (e) {},
                                        complete: function () {
                                            o.removeClass("disabled")
                                                .prop("disabled", !1)
                                                .attr("disabled", !1);
                                        },
                                    }));
                            }),
                        $("body")
                            .off("click", ".reply-link")
                            .on("click", ".reply-link", function (e) {
                                e.preventDefault();
                                var t = $(this).attr("data-comment"),
                                    a = $("span", this),
                                    i = $.trim(a.text()),
                                    o = $(
                                        ".review-reply[data-comment=" + t + "]"
                                    ),
                                    s = $(
                                        ".review-reply[data-comment=" +
                                            t +
                                            "] .fnc_commentReply"
                                    ),
                                    r = s.html(),
                                    n = $(
                                        ".review-reply[data-comment=" +
                                            t +
                                            "] .replyCommentData"
                                    );
                                (i = i.match(/(\d+)/gi)),
                                    o.show(),
                                    n.focus(),
                                    $("body")
                                        .off(
                                            "submit",
                                            ".review-reply[data-comment=" +
                                                t +
                                                "]"
                                        )
                                        .on(
                                            "submit",
                                            ".review-reply[data-comment=" +
                                                t +
                                                "]",
                                            function (e) {
                                                e.preventDefault();
                                                var o = $(
                                                        ".review-reply[data-comment=" +
                                                            t +
                                                            "]"
                                                    ).data("ctype"),
                                                    l = $(
                                                        ".review-reply[data-comment=" +
                                                            t +
                                                            "]"
                                                    ).data("series"),
                                                    c = $(
                                                        ".review-reply[data-comment=" +
                                                            t +
                                                            "]"
                                                    ).data("episode"),
                                                    d = $(
                                                        ".review-reply[data-comment=" +
                                                            t +
                                                            "]"
                                                    ).data("forum"),
                                                    u = n.val();
                                                s.prop("disabled", !0),
                                                    n.prop("disabled", !0),
                                                    s.text("Yükleniyor");
                                                u &&
                                                    t &&
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "/ajax/service",
                                                        dataType: "json",
                                                        data: {
                                                            comment: u,
                                                            ctype: o,
                                                            owner: t,
                                                            episode: c,
                                                            series: l,
                                                            forum: d,
                                                            spoiler: 0,
                                                            type: "addComment",
                                                        },
                                                        success: function (e) {
                                                            e &&
                                                                (e.error
                                                                    ? getNotification(
                                                                          "error",
                                                                          e.error
                                                                      )
                                                                    : e.success
                                                                    ? (e.data &&
                                                                          ($(
                                                                              e.data
                                                                          )
                                                                              .prependTo(
                                                                                  ".sub-reviews[data-comment=" +
                                                                                      t +
                                                                                      "]"
                                                                              )
                                                                              .hide()
                                                                              .fadeIn(
                                                                                  600
                                                                              ),
                                                                          a.html(
                                                                              parseInt(
                                                                                  i
                                                                              ) +
                                                                                  1
                                                                          )),
                                                                      getNotification(
                                                                          "success",
                                                                          e.success
                                                                      ))
                                                                    : e.session &&
                                                                      (window.location.href =
                                                                          "/"));
                                                        },
                                                        error: function (e) {},
                                                        complete: function () {
                                                            n.val(""),
                                                                s.prop(
                                                                    "disabled",
                                                                    !1
                                                                ),
                                                                n.prop(
                                                                    "disabled",
                                                                    !1
                                                                ),
                                                                $(
                                                                    ".sub-reviews[data-comment=" +
                                                                        t +
                                                                        "]"
                                                                ).is(
                                                                    ":hidden"
                                                                ) &&
                                                                    $(
                                                                        ".sub-reviews[data-comment=" +
                                                                            t +
                                                                            "]"
                                                                    ).show(),
                                                                s.html(r);
                                                        },
                                                    });
                                            }
                                        ),
                                    event.preventDefault();
                            });
                    $("body")
                        .off("click", "[data-delete]")
                        .on("click", "[data-delete]", deleteComment),
                        $("body")
                            .off("click", "[data-spoiler]")
                            .on("click", "[data-spoiler]", spoilerComment),
                        $("body")
                            .off("click touchstart", ".fnc_followUser")
                            .on(
                                "click touchstart",
                                ".fnc_followUser",
                                function () {
                                    var e = $(this).data("userid");
                                    if (e) {
                                        var t = $(this),
                                            a = t.html(),
                                            i = "error";
                                        t.prop("disabled", !0),
                                            t.html("Yükleniyor..."),
                                            $.ajax({
                                                type: "POST",
                                                url: "/ajax/service",
                                                dataType: "json",
                                                data: {
                                                    data: e,
                                                    type: "following",
                                                },
                                                success: function (e) {
                                                    if (e)
                                                        if (e.error)
                                                            t.html(a),
                                                                getNotification(
                                                                    i,
                                                                    e.error
                                                                );
                                                        else if (e.success) {
                                                            var o = parseInt(
                                                                $(
                                                                    "#follower_count"
                                                                ).text()
                                                            );
                                                            "follow" == e.type
                                                                ? ($(
                                                                      "#follower_count"
                                                                  ).text(o + 1),
                                                                  (i =
                                                                      "success"),
                                                                  t.html(
                                                                      "Takip ediliyor"
                                                                  ),
                                                                  t
                                                                      .removeClass(
                                                                          "secondary"
                                                                      )
                                                                      .addClass(
                                                                          "primary"
                                                                      ))
                                                                : ($(
                                                                      "#follower_count"
                                                                  ).text(o - 1),
                                                                  (i =
                                                                      "success"),
                                                                  t.html(
                                                                      "Takip et"
                                                                  ),
                                                                  t
                                                                      .removeClass(
                                                                          "primary"
                                                                      )
                                                                      .addClass(
                                                                          "secondary"
                                                                      )),
                                                                getNotification(
                                                                    i,
                                                                    e.success
                                                                );
                                                        } else
                                                            e.session &&
                                                                (window.location.href =
                                                                    "/");
                                                    else
                                                        getNotification(
                                                            i,
                                                            "Bir hata oluştu!"
                                                        );
                                                },
                                                error: function (e) {
                                                    getNotification(
                                                        i,
                                                        "Bir hata oluştu!"
                                                    );
                                                },
                                                complete: function () {
                                                    t.removeClass("disabled")
                                                        .prop("disabled", !1)
                                                        .attr("disabled", !1);
                                                },
                                            });
                                    }
                                }
                            ),
                        $("body")
                            .off("click", "#audioOptionSet")
                            .on("click", "#audioOptionSet", function (e) {
                                e.preventDefault(), e.stopPropagation();
                                window.location.pathname;
                                var t = $(this).attr("href"),
                                    a = $(this).data("changeto"),
                                    i = Math.floor(Date.now() / 1e3);
                                $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: {
                                        type: "audioOptionSet",
                                        changeto: a,
                                    },
                                    beforeSend: function () {
                                        (document.body.scrollTop =
                                            document.documentElement.scrollTop =
                                                0),
                                            $("#search-results").hide(),
                                            $("#router-view").addClass(
                                                "loading"
                                            ),
                                            $("#router-view").html(
                                                '<div class="skeleton-loading"><div class="skeleton-bac-animation"></div><div class="row" style="justify-content: start; padding-bottom: 15px;"><div class="square-list"><div class="square" style="background-color: #181924; width: 70px; height: 15px; margin-top: 10px; margin-bottom: 0px;"></div><div class="square" style="background-color: #181924; width: 150px; height: 32px; margin-top: 10px; margin-bottom: 0px;"></div><div class="square" style="background-color: #181924; width: 100%; height: 45px; margin-top: 30px; margin-bottom: 0px;"></div></div></div><div class="row" style="justify-content: start; padding-top: 0px; padding-bottom: 0px;"><div class="col" style="width: 300px; padding: 0px;"><div class="circle" style="background-color: #181924; width: 100%; height: 450px;"></div></div><div class="col" style="width: 600px; padding-left: 30px;"><div class="square-list"><div class="square" style="background-color: #181924; width: 70px; height: 26px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 100%; height: 15px; margin-top: 30px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 100%; height: 15px; margin-top: 5px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 100%; height: 15px; margin-top: 5px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 100%; height: 15px; margin-top: 5px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 50%; height: 15px; margin-top: 5px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 50px; height: 15px; margin-top: 30px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 50px; height: 15px; margin-top: 10px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 100%; height: 70px; margin-top: 30px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 100%; height: 100px; margin-top: 15px; margin-bottom: 0px;"></div></div></div></div></div>'
                                            );
                                    },
                                    complete: function () {
                                        router.navigate(
                                            t + "#rel=audiochanged_" + i,
                                            !0
                                        );
                                    },
                                });
                            }),
                        $("body")
                            .off("click touchstart", "#room-settings")
                            .on(
                                "click touchstart",
                                "#room-settings",
                                function (e) {
                                    $("title").text();
                                    var t = window.location.pathname,
                                        a = $(
                                            ".playing-now .poster-xxs h2"
                                        ).text(),
                                        i = $(
                                            ".playing-now .poster-xxs span"
                                        ).text();
                                    swal({
                                        title: "Oda Ayarları",
                                        html:
                                            "Şuanda Oynatılan: <strong>" +
                                            a +
                                            "</strong>" +
                                            ("" !== i ? " - " + i : ""),
                                        showCancelButton: !0,
                                        confirmButtonText: "Odayı Sıfırla",
                                        cancelButtonText: "Tamam",
                                        confirmButtonColor: "#d33",
                                        showLoaderOnConfirm: !0,
                                        preConfirm: (e) =>
                                            $.post(
                                                "/ajax/service",
                                                { type: "clearMyRoom" },
                                                function (e) {
                                                    console.log(e);
                                                },
                                                "json"
                                            ),
                                        allowOutsideClick: () =>
                                            !swal.isLoading(),
                                    }).then((e) => {
                                        e.value.success &&
                                            (router.navigate(
                                                t +
                                                    "#ref=clear_" +
                                                    e.value.time,
                                                !0
                                            ),
                                            swal({
                                                title: "Oda Temizlendi",
                                                type: "success",
                                            }));
                                    });
                                }
                            ),
                        $("body")
                            .off("click touchstart", "#add-participants")
                            .on(
                                "click touchstart",
                                "#add-participants",
                                function (e) {
                                    $("title").text();
                                    var t = window.location.pathname;
                                    $(".playing-now .poster-xxs h2").text(),
                                        $(
                                            ".playing-now .poster-xxs span"
                                        ).text();
                                    swal({
                                        title: "Katılımcı Ekle",
                                        html: 'Birlikte izlemek istediğin takipçilerini davet et<div class="ui fluid big input pt-lg" id="search-for-room"><input type="text" placeholder="Anahtar kelime girin"></div><input type="hidden" name="user_ids" id="addtoroom" value="[]"><div class="ui left aligned segment" style="height:200px;overflow:scroll;"><div class="ui middle aligned divided list" id="results-for-collection"></div></div>',
                                        showCancelButton: !0,
                                        confirmButtonText: "Odayı Sıfırla",
                                        cancelButtonText: "Tamam",
                                        confirmButtonColor: "#d33",
                                        showLoaderOnConfirm: !0,
                                        preConfirm: (e) =>
                                            $.post(
                                                "/ajax/service",
                                                { type: "clearMyRoom" },
                                                function (e) {
                                                    console.log(e);
                                                },
                                                "json"
                                            ),
                                        allowOutsideClick: () =>
                                            !swal.isLoading(),
                                    }).then((e) => {
                                        e.value.success &&
                                            (router.navigate(
                                                t +
                                                    "#ref=clear_" +
                                                    e.value.time,
                                                !0
                                            ),
                                            swal({
                                                title: "Oda Temizlendi",
                                                type: "success",
                                            }));
                                    }),
                                        $("body")
                                            .off("input", "#search-for-room")
                                            .on(
                                                "input",
                                                "#search-for-room",
                                                function () {
                                                    var e = $(
                                                            "input",
                                                            this
                                                        ).val(),
                                                        t = null;
                                                    $("#results-for-room").html(
                                                        ""
                                                    ),
                                                        (t = $.ajax({
                                                            type: "POST",
                                                            url:
                                                                "/search?qr=" +
                                                                e,
                                                            dataType: "json",
                                                            data: {},
                                                            beforeSend:
                                                                function () {
                                                                    null != t &&
                                                                        (t.abort(),
                                                                        $(
                                                                            "#results-for-room"
                                                                        ).html(
                                                                            ""
                                                                        ));
                                                                },
                                                            success: function (
                                                                e
                                                            ) {
                                                                if (e)
                                                                    if (
                                                                        e.success
                                                                    ) {
                                                                        if (
                                                                            !e.type
                                                                        ) {
                                                                            var t =
                                                                                    JSON.parse(
                                                                                        $(
                                                                                            "#addtoroom"
                                                                                        ).val()
                                                                                    ),
                                                                                a =
                                                                                    "";
                                                                            $.each(
                                                                                e
                                                                                    .data
                                                                                    .result,
                                                                                function (
                                                                                    e,
                                                                                    i
                                                                                ) {
                                                                                    null !=
                                                                                        i.s_type &&
                                                                                        (a +=
                                                                                            '<div class="item" style="display:flex;-webkit-flex-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;"><img class="ui avatar image" src="uploads/series/' +
                                                                                            i.s_image +
                                                                                            '"><div class="content truncate" style="flex:1;">' +
                                                                                            i.s_name +
                                                                                            "</div>" +
                                                                                            (inArray(
                                                                                                i.s_id,
                                                                                                t
                                                                                            )
                                                                                                ? '<button class="ui button addRoom primary" data-series="' +
                                                                                                  i.s_id +
                                                                                                  '">Eklendi</button>'
                                                                                                : '<button class="ui button addRoom" data-series="' +
                                                                                                  i.s_id +
                                                                                                  '">Ekle</button>') +
                                                                                            "</div>");
                                                                                }
                                                                            ),
                                                                                $(
                                                                                    "#results-for-room"
                                                                                ).html(
                                                                                    a
                                                                                );
                                                                        }
                                                                    } else
                                                                        $(
                                                                            "#results-for-room"
                                                                        ).html(
                                                                            "<p>" +
                                                                                e.error +
                                                                                "</p>"
                                                                        );
                                                            },
                                                            complete:
                                                                function () {
                                                                    $("body")
                                                                        .off(
                                                                            "click",
                                                                            ".addRoom"
                                                                        )
                                                                        .on(
                                                                            "click",
                                                                            ".addRoom",
                                                                            function () {
                                                                                var e =
                                                                                        JSON.parse(
                                                                                            $(
                                                                                                "#addtoroom"
                                                                                            ).val()
                                                                                        ),
                                                                                    t =
                                                                                        $(
                                                                                            this
                                                                                        ).text(),
                                                                                    a =
                                                                                        $(
                                                                                            this
                                                                                        ).data(
                                                                                            "series"
                                                                                        );
                                                                                $(
                                                                                    this
                                                                                )
                                                                                    .toggleClass(
                                                                                        "primary"
                                                                                    )
                                                                                    .text(
                                                                                        "Eklendi" ==
                                                                                            t
                                                                                            ? "Ekle"
                                                                                            : "Eklendi"
                                                                                    ),
                                                                                    "Eklendi" ==
                                                                                    t
                                                                                        ? e.splice(
                                                                                              e.indexOf(
                                                                                                  a
                                                                                              ),
                                                                                              1
                                                                                          )
                                                                                        : e.push(
                                                                                              a
                                                                                          ),
                                                                                    $(
                                                                                        "#addtoroom"
                                                                                    ).val(
                                                                                        JSON.stringify(
                                                                                            e
                                                                                        )
                                                                                    );
                                                                            }
                                                                        );
                                                                },
                                                        }));
                                                }
                                            );
                                }
                            ),
                        $("body")
                            .off("click touchstart", "#newCollection")
                            .on(
                                "click touchstart",
                                "#newCollection",
                                function (e) {
                                    var t = $("title").text(),
                                        a = window.location.pathname;
                                    swal
                                        .queue([
                                            {
                                                title: "Yeni Koleksiyon Oluştur",
                                                text: "",
                                                html: '<p>Koleksiyon başlığı</p><input id="swal-input1" class="swal2-input"><p class="mb-0">Açıklama</p><textarea id="swal-input2" class="swal2-textarea"></textarea>',
                                                focusConfirm: !1,
                                                showLoaderOnConfirm: !0,
                                                confirmButtonText: "Tamam",
                                                preConfirm: () => {
                                                    var e =
                                                            document.getElementById(
                                                                "swal-input1"
                                                            ).value,
                                                        i =
                                                            document.getElementById(
                                                                "swal-input2"
                                                            ).value;
                                                    if ("" !== e)
                                                        return $.ajax({
                                                            type: "POST",
                                                            url: "/ajax/service",
                                                            dataType: "json",
                                                            data: {
                                                                title: e,
                                                                desc: i,
                                                                type: "add_collection",
                                                            },
                                                            beforeSend:
                                                                function () {
                                                                    history.replaceState(
                                                                        null,
                                                                        t,
                                                                        a +
                                                                            "?edit=waiting_for_response"
                                                                    );
                                                                },
                                                            success: function (
                                                                e
                                                            ) {
                                                                e &&
                                                                    (e.success
                                                                        ? (swal.insertQueueStep(
                                                                              {
                                                                                  title: "Güzel başlık!",
                                                                                  text: "Şimdide içini dolduralım...",
                                                                                  input: null,
                                                                                  html: 'Şimdi içini dolduralım...<div class="ui fluid big input pt-lg" id="search-for-collection"><input type="text" placeholder="Anahtar kelime girin"></div><input type="hidden" name="series_ids" id="addtocollection" value="[]"><div class="ui left aligned segment" style="height:200px;overflow:scroll;"><div class="ui middle aligned divided list" id="results-for-collection"></div></div>',
                                                                                  showLoaderOnConfirm:
                                                                                      !0,
                                                                                  preConfirm:
                                                                                      () => {
                                                                                          var t =
                                                                                              $(
                                                                                                  ".swal2-content #addtocollection"
                                                                                              ).val();
                                                                                          $.ajax(
                                                                                              {
                                                                                                  type: "POST",
                                                                                                  url: "/ajax/service",
                                                                                                  dataType:
                                                                                                      "json",
                                                                                                  data: {
                                                                                                      cl_id: e.cl_id,
                                                                                                      series: t,
                                                                                                      type: "add_collection",
                                                                                                  },
                                                                                                  success:
                                                                                                      function (
                                                                                                          t
                                                                                                      ) {
                                                                                                          t &&
                                                                                                              (t.success
                                                                                                                  ? (router.navigate(
                                                                                                                        a +
                                                                                                                            "#ref=col_" +
                                                                                                                            e.cl_id,
                                                                                                                        !0
                                                                                                                    ),
                                                                                                                    getNotification(
                                                                                                                        "success",
                                                                                                                        t.success
                                                                                                                    ))
                                                                                                                  : (swal.showValidationError(
                                                                                                                        "Hata: " +
                                                                                                                            t.error
                                                                                                                    ),
                                                                                                                    getNotification(
                                                                                                                        "error",
                                                                                                                        t.error
                                                                                                                    )));
                                                                                                      },
                                                                                              }
                                                                                          );
                                                                                      },
                                                                              }
                                                                          ),
                                                                          getNotification(
                                                                              "success",
                                                                              e.success
                                                                          ))
                                                                        : (swal.showValidationError(
                                                                              "Hata: " +
                                                                                  e.error
                                                                          ),
                                                                          sweetAlert.hideLoading(),
                                                                          history.replaceState(
                                                                              null,
                                                                              t,
                                                                              a
                                                                          ),
                                                                          getNotification(
                                                                              "error",
                                                                              e.error
                                                                          )));
                                                            },
                                                        });
                                                    swal.showValidationError(
                                                        "Hata: Lütfen bir başlık girin."
                                                    );
                                                },
                                            },
                                        ])
                                        .then((e) => {
                                            var t = new Date().getTime();
                                            console.log(e),
                                                "overlay" == e.dismiss &&
                                                    ((0 !=
                                                        $(".swal2-input")
                                                            .length &&
                                                        $(".swal2-input").is(
                                                            ":visible"
                                                        )) ||
                                                        router.navigate(
                                                            a + "#ref=" + t,
                                                            !0
                                                        ));
                                        }),
                                        $("body")
                                            .off(
                                                "input",
                                                "#search-for-collection"
                                            )
                                            .on(
                                                "input",
                                                "#search-for-collection",
                                                function () {
                                                    var e = $(
                                                            "input",
                                                            this
                                                        ).val(),
                                                        t = null;
                                                    $(
                                                        "#results-for-collection"
                                                    ).html(""),
                                                        (t = $.ajax({
                                                            type: "POST",
                                                            url:
                                                                "/search?qr=" +
                                                                e,
                                                            dataType: "json",
                                                            data: {},
                                                            beforeSend:
                                                                function () {
                                                                    null != t &&
                                                                        (t.abort(),
                                                                        $(
                                                                            "#results-for-collection"
                                                                        ).html(
                                                                            ""
                                                                        ));
                                                                },
                                                            success: function (
                                                                e
                                                            ) {
                                                                if (e)
                                                                    if (
                                                                        e.success
                                                                    ) {
                                                                        if (
                                                                            !e.type
                                                                        ) {
                                                                            var t =
                                                                                    JSON.parse(
                                                                                        $(
                                                                                            "#addtocollection"
                                                                                        ).val()
                                                                                    ),
                                                                                a =
                                                                                    "";
                                                                            $.each(
                                                                                e
                                                                                    .data
                                                                                    .result,
                                                                                function (
                                                                                    e,
                                                                                    i
                                                                                ) {
                                                                                    null !=
                                                                                        i.s_type &&
                                                                                        (a +=
                                                                                            '<div class="item" style="display:flex;-webkit-flex-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;"><img class="ui avatar image" src="uploads/series/' +
                                                                                            i.s_image +
                                                                                            '"><div class="content truncate" style="flex:1;">' +
                                                                                            i.s_name +
                                                                                            "</div>" +
                                                                                            (inArray(
                                                                                                i.s_id,
                                                                                                t
                                                                                            )
                                                                                                ? '<button class="ui button addCollection primary" data-series="' +
                                                                                                  i.s_id +
                                                                                                  '">Eklendi</button>'
                                                                                                : '<button class="ui button addCollection" data-series="' +
                                                                                                  i.s_id +
                                                                                                  '">Ekle</button>') +
                                                                                            "</div>");
                                                                                }
                                                                            ),
                                                                                $(
                                                                                    "#results-for-collection"
                                                                                ).html(
                                                                                    a
                                                                                );
                                                                        }
                                                                    } else
                                                                        $(
                                                                            "#results-for-collection"
                                                                        ).html(
                                                                            "<p>" +
                                                                                e.error +
                                                                                "</p>"
                                                                        );
                                                            },
                                                            complete:
                                                                function () {
                                                                    $("body")
                                                                        .off(
                                                                            "click",
                                                                            ".addCollection"
                                                                        )
                                                                        .on(
                                                                            "click",
                                                                            ".addCollection",
                                                                            function () {
                                                                                var e =
                                                                                        JSON.parse(
                                                                                            $(
                                                                                                "#addtocollection"
                                                                                            ).val()
                                                                                        ),
                                                                                    t =
                                                                                        $(
                                                                                            this
                                                                                        ).text(),
                                                                                    a =
                                                                                        $(
                                                                                            this
                                                                                        ).data(
                                                                                            "series"
                                                                                        );
                                                                                $(
                                                                                    this
                                                                                )
                                                                                    .toggleClass(
                                                                                        "primary"
                                                                                    )
                                                                                    .text(
                                                                                        "Eklendi" ==
                                                                                            t
                                                                                            ? "Ekle"
                                                                                            : "Eklendi"
                                                                                    ),
                                                                                    "Eklendi" ==
                                                                                    t
                                                                                        ? e.splice(
                                                                                              e.indexOf(
                                                                                                  a
                                                                                              ),
                                                                                              1
                                                                                          )
                                                                                        : e.push(
                                                                                              a
                                                                                          ),
                                                                                    $(
                                                                                        "#addtocollection"
                                                                                    ).val(
                                                                                        JSON.stringify(
                                                                                            e
                                                                                        )
                                                                                    );
                                                                            }
                                                                        );
                                                                },
                                                        }));
                                                }
                                            );
                                }
                            ),
                        $(document)
                            .off("change", 'input[type="file"]')
                            .on("change", 'input[type="file"]', function (e) {
                                var t = $(this).val(),
                                    a = t.replace(/^.*\./, "");
                                switch ((a = a == t ? "" : a.toLowerCase())) {
                                    case "jpg":
                                    case "jpeg":
                                    case "png":
                                        swal({
                                            title: "Emin misin?",
                                            text: "Profil resminiz değiştirilecek.",
                                            imageUrl:
                                                window.URL.createObjectURL(
                                                    this.files[0]
                                                ),
                                            imageWidth: 120,
                                            imageHeight: 120,
                                            imageClass: "ui circular image",
                                            imageAlt: "Yeni profil resmi",
                                            showCancelButton: !0,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "Tamam",
                                            cancelButtonText: "İptal",
                                        }).then((e) => {
                                            if (e.value) {
                                                var t =
                                                        $(this).prop(
                                                            "files"
                                                        )[0],
                                                    a = new FormData();
                                                a.append("file", t),
                                                    a.append(
                                                        "type",
                                                        "addPhoto"
                                                    ),
                                                    $.ajax({
                                                        url: "/ajax/service",
                                                        dataType: "json",
                                                        cache: !1,
                                                        contentType: !1,
                                                        processData: !1,
                                                        data: a,
                                                        type: "post",
                                                        success: function (e) {
                                                            e &&
                                                                (e.success
                                                                    ? (getNotification(
                                                                          "success",
                                                                          "Profil Resminiz Güncellenmiştir."
                                                                      ),
                                                                      $(
                                                                          "#avatar"
                                                                      ).attr(
                                                                          "src",
                                                                          "uploads/users/" +
                                                                              e.image
                                                                      ),
                                                                      $(
                                                                          ".header-avatar"
                                                                      ).attr(
                                                                          "src",
                                                                          "uploads/users/" +
                                                                              e.image
                                                                      ))
                                                                    : e.error &&
                                                                      getNotification(
                                                                          "error",
                                                                          e.error
                                                                      ));
                                                        },
                                                        complete:
                                                            function () {},
                                                    });
                                            }
                                        });
                                        break;
                                    default:
                                        swal(
                                            "Hata!",
                                            "Geçersiz dosya uzantısı",
                                            "error"
                                        );
                                }
                            }),
                        $(document)
                            .off("submit", ".profile_settings")
                            .on("submit", ".profile_settings", function (e) {
                                e.preventDefault();
                                var t =
                                        $(this).serialize() +
                                        "&type=saveSetting",
                                    a = $(this),
                                    i = $("button.primary", a),
                                    o = $("button.primary", a).text(),
                                    s = $("title").text(),
                                    r = window.location.pathname,
                                    n = new Date().getTime();
                                t
                                    ? ($("input,textarea,button", a).prop(
                                          "disabled",
                                          !0
                                      ),
                                      i.text("Yükleniyor..."),
                                      $.ajax({
                                          type: "POST",
                                          url: "/ajax/service",
                                          dataType: "json",
                                          data: t,
                                          beforeSend: function () {
                                              history.replaceState(
                                                  null,
                                                  s,
                                                  r +
                                                      "?edit=waiting_for_response"
                                              );
                                          },
                                          success: function (e) {
                                              e &&
                                                  (e.error
                                                      ? (history.replaceState(
                                                            null,
                                                            s,
                                                            r
                                                        ),
                                                        getNotification(
                                                            "error",
                                                            e.error
                                                        ))
                                                      : e.success
                                                      ? (router.navigate(
                                                            r + "#ref=" + n,
                                                            !0
                                                        ),
                                                        getNotification(
                                                            "success",
                                                            e.success
                                                        ))
                                                      : e.session &&
                                                        (window.location.href =
                                                            "/"));
                                          },
                                          error: function (e) {},
                                          complete: function () {
                                              i.text(o),
                                                  $(
                                                      "input[name!=username],textarea,button"
                                                  ).prop("disabled", !1);
                                          },
                                      }))
                                    : getNotification(
                                          "error",
                                          "Lütfen gerekli yerleri boş bırakmayın !"
                                      );
                            }),
                        $(document)
                            .off("submit", ".change_social")
                            .on("submit", ".change_social", function (e) {
                                e.preventDefault();
                                var t =
                                        $(this).serialize() +
                                        "&type=saveSocial",
                                    a = $(this),
                                    i = $("button.primary", a),
                                    o = $("button.primary", a).text(),
                                    s = $("title").text(),
                                    r = window.location.pathname,
                                    n = new Date().getTime();
                                t
                                    ? ($("input,textarea,button", a).prop(
                                          "disabled",
                                          !0
                                      ),
                                      i.text("Yükleniyor..."),
                                      $.ajax({
                                          type: "POST",
                                          url: "/ajax/service",
                                          dataType: "json",
                                          data: t,
                                          beforeSend: function () {
                                              history.replaceState(
                                                  null,
                                                  s,
                                                  r +
                                                      "?edit=waiting_for_response"
                                              );
                                          },
                                          success: function (e) {
                                              e &&
                                                  (e.error
                                                      ? (history.replaceState(
                                                            null,
                                                            s,
                                                            r
                                                        ),
                                                        getNotification(
                                                            "error",
                                                            e.error
                                                        ))
                                                      : e.success
                                                      ? (router.navigate(
                                                            r + "#ref=" + n,
                                                            !0
                                                        ),
                                                        getNotification(
                                                            "success",
                                                            e.success
                                                        ))
                                                      : e.session &&
                                                        (window.location.href =
                                                            "/"));
                                          },
                                          error: function (e) {},
                                          complete: function () {
                                              i.text(o),
                                                  $(
                                                      "input[name!=username],textarea,button"
                                                  ).prop("disabled", !1);
                                          },
                                      }))
                                    : getNotification(
                                          "error",
                                          "Lütfen gerekli yerleri boş bırakmayın !"
                                      );
                            }),
                        $(document)
                            .off("submit", "#change_pass")
                            .on("submit", "#change_pass", function (e) {
                                e.preventDefault();
                                var t =
                                        $(this).serialize() +
                                        "&type=changePass",
                                    a = $(this),
                                    i = $("button.primary", a),
                                    o = $("button.primary", a).text(),
                                    s = $("title").text(),
                                    r = window.location.pathname,
                                    n = new Date().getTime();
                                t
                                    ? ($("input,textarea,button", a).prop(
                                          "disabled",
                                          !0
                                      ),
                                      i.text("Yükleniyor..."),
                                      $.ajax({
                                          type: "POST",
                                          url: "/ajax/service",
                                          dataType: "json",
                                          data: t,
                                          beforeSend: function () {
                                              history.replaceState(
                                                  null,
                                                  s,
                                                  r +
                                                      "?edit=waiting_for_response"
                                              );
                                          },
                                          success: function (e) {
                                              e &&
                                                  (e.error
                                                      ? (history.replaceState(
                                                            null,
                                                            s,
                                                            r
                                                        ),
                                                        getNotification(
                                                            "error",
                                                            e.error
                                                        ))
                                                      : e.success
                                                      ? (router.navigate(
                                                            r + "#ref=" + n,
                                                            !0
                                                        ),
                                                        getNotification(
                                                            "success",
                                                            e.success
                                                        ))
                                                      : e.session &&
                                                        (window.location.href =
                                                            "/"));
                                          },
                                          error: function (e) {},
                                          complete: function () {
                                              i.text(o),
                                                  $(
                                                      "input[name!=username],textarea,button"
                                                  ).prop("disabled", !1);
                                          },
                                      }))
                                    : getNotification(
                                          "error",
                                          "Lütfen gerekli yerleri boş bırakmayın !"
                                      );
                            }),
                        $("body")
                            .off("click", "[data-favorite]")
                            .on("click", "[data-favorite]", function (e) {
                                var t,
                                    a = $(this).data("fid"),
                                    i = $(this);
                                t = $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: { type: "forumFavorite", f_id: a },
                                    beforeSend: function (e) {
                                        t && t.abort(),
                                            i.hasClass("story-starred")
                                                ? (i.removeClass(
                                                      "story-starred"
                                                  ),
                                                  i
                                                      .parent()
                                                      .attr(
                                                          "data-tooltip",
                                                          "Favorilere Ekle"
                                                      ))
                                                : (i.addClass("story-starred"),
                                                  i
                                                      .parent()
                                                      .attr(
                                                          "data-tooltip",
                                                          "Favorilerden Kaldır"
                                                      ));
                                    },
                                    success: function (e) {
                                        console.log(e);
                                    },
                                });
                            }),
                        $("body")
                            .off("click", "[data-vote]")
                            .on("click", "[data-vote]", function (e) {
                                var t,
                                    a = $(this).data("fid"),
                                    i = $(this).data("vote"),
                                    o = $(this),
                                    s = $(this)
                                        .parent()
                                        .children(".story-vote-count");
                                t = $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: {
                                        type: "forumVote",
                                        f_id: a,
                                        vote_type: i,
                                    },
                                    beforeSend: function (e) {
                                        return (
                                            t && t.abort(),
                                            (!o.hasClass("upvoted") ||
                                                1 != i) &&
                                                (!o.hasClass("downvoted") ||
                                                    2 != i) &&
                                                void ("1" == i
                                                    ? $(
                                                          "[data-fid=" +
                                                              a +
                                                              '][data-vote="2"]'
                                                      ).hasClass("downvoted")
                                                        ? ($(
                                                              "[data-fid=" +
                                                                  a +
                                                                  '][data-vote="2"]'
                                                          ).removeClass(
                                                              "downvoted"
                                                          ),
                                                          o.addClass("upvoted"),
                                                          s.text(
                                                              parseInt(
                                                                  s.text()
                                                              ) + 2
                                                          ))
                                                        : (o.addClass(
                                                              "upvoted"
                                                          ),
                                                          s.text(
                                                              parseInt(
                                                                  s.text()
                                                              ) + 1
                                                          ))
                                                    : $(
                                                          "[data-fid=" +
                                                              a +
                                                              '][data-vote="1"]'
                                                      ).hasClass("upvoted")
                                                    ? ($(
                                                          "[data-fid=" +
                                                              a +
                                                              '][data-vote="1"]'
                                                      ).removeClass("upvoted"),
                                                      o.addClass("downvoted"),
                                                      s.text(
                                                          parseInt(s.text()) - 2
                                                      ))
                                                    : (o.addClass("downvoted"),
                                                      s.text(
                                                          parseInt(s.text()) - 1
                                                      )))
                                        );
                                    },
                                    success: function (e) {
                                        e.success;
                                    },
                                });
                            }),
                        $("body")
                            .off("click", "[data-bbcode]")
                            .on("click", "[data-bbcode]", function () {
                                var e = $("[data-editor]"),
                                    t = e.val(),
                                    a = getInputSelection(e);
                                a.length > 0
                                    ? e.val(
                                          t.replace(
                                              a,
                                              "[" +
                                                  $(this).attr("data-bbcode") +
                                                  "]" +
                                                  a +
                                                  "[/" +
                                                  $(this).attr("data-bbcode") +
                                                  "]"
                                          )
                                      )
                                    : e.val(
                                          t +
                                              "[" +
                                              $(this).attr("data-bbcode") +
                                              "][/" +
                                              $(this).attr("data-bbcode") +
                                              "]"
                                      ),
                                    e.focus();
                            }),
                        $("body")
                            .off("submit", "[data-newtopic]")
                            .on("submit", "[data-newtopic]", function (e) {
                                e.preventDefault();
                                var t = $("#subject", this).val(),
                                    a = $("#series", this).val(),
                                    i = $("#message", this).val(),
                                    o =
                                        ($("#spoiler", this).is(":checked"),
                                        $("title").text()),
                                    s = window.location.pathname;
                                t && a && i
                                    ? $.ajax({
                                          type: "POST",
                                          url: "/ajax/service",
                                          dataType: "json",
                                          data: {
                                              series: a,
                                              subject: t,
                                              message: i,
                                              type: "newTopic2",
                                          },
                                          success: function (e) {
                                              e &&
                                                  (e.error
                                                      ? (getNotification(
                                                            "error",
                                                            e.error
                                                        ),
                                                        history.replaceState(
                                                            null,
                                                            o,
                                                            s
                                                        ))
                                                      : e.success
                                                      ? (getNotification(
                                                            "success",
                                                            e.success
                                                        ),
                                                        e.replyid
                                                            ? router.navigate(
                                                                  s +
                                                                      "#ref=reply_" +
                                                                      e.replyid,
                                                                  !0
                                                              )
                                                            : router.navigate(
                                                                  "forum/" +
                                                                      e.s_link,
                                                                  !0
                                                              ))
                                                      : e.session &&
                                                        (window.location.href =
                                                            "/"));
                                          },
                                      })
                                    : getNotification(
                                          "error",
                                          "Tüm alanları doldurman gerekiyor!"
                                      );
                            }),
                        $("body")
                            .off("submit", "[data-edittopic]")
                            .on("submit", "[data-edittopic]", function (e) {
                                e.preventDefault();
                                var t = $("#subject", this).val(),
                                    a = $("#message", this).val(),
                                    i =
                                        ($("#spoiler", this).is(":checked"),
                                        $("title").text()),
                                    o = window.location.pathname;
                                t && a
                                    ? $.ajax({
                                          type: "POST",
                                          url: "/ajax/service",
                                          dataType: "json",
                                          data: {
                                              subject: t,
                                              message: a,
                                              type: "editTopic",
                                          },
                                          success: function (e) {
                                              console.log(e),
                                                  e &&
                                                      (e.error
                                                          ? (getNotification(
                                                                "error",
                                                                e.error
                                                            ),
                                                            history.replaceState(
                                                                null,
                                                                i,
                                                                o
                                                            ))
                                                          : e.success
                                                          ? (getNotification(
                                                                "success",
                                                                e.success
                                                            ),
                                                            e.replyid
                                                                ? router.navigate(
                                                                      o +
                                                                          "#ref=reply_" +
                                                                          e.replyid,
                                                                      !0
                                                                  )
                                                                : router.navigate(
                                                                      "forum/" +
                                                                          e.s_link,
                                                                      !0
                                                                  ))
                                                          : e.session &&
                                                            (window.location.href =
                                                                "/"));
                                          },
                                      })
                                    : getNotification(
                                          "error",
                                          "Tüm alanları doldurman gerekiyor!"
                                      );
                            }),
                        $("body")
                            .off("click", "[data-flock]")
                            .on("click", "[data-flock]", function (e) {
                                e.preventDefault();
                                var t = $(this).data("flock"),
                                    a = $("title").text(),
                                    i = window.location.pathname;
                                t
                                    ? swal({
                                          title: "Konuyu Kilitle",
                                          text: "Bu konuyu tartışmaya kapatmak istediğinden emin misin?",
                                          showCancelButton: !0,
                                          confirmButtonText: "Evet, Kapat",
                                          cancelButtonText: "Kapat",
                                      }).then((e) => {
                                          e.value &&
                                              $.ajax({
                                                  type: "POST",
                                                  url: "/ajax/service",
                                                  dataType: "json",
                                                  data: {
                                                      f_id: t,
                                                      type: "lockTopic",
                                                  },
                                                  success: function (e) {
                                                      e &&
                                                          (e.error
                                                              ? (getNotification(
                                                                    "error",
                                                                    e.error
                                                                ),
                                                                history.replaceState(
                                                                    null,
                                                                    a,
                                                                    i
                                                                ))
                                                              : e.success
                                                              ? (getNotification(
                                                                    "success",
                                                                    e.success
                                                                ),
                                                                router.navigate(
                                                                    i,
                                                                    !0
                                                                ))
                                                              : e.session &&
                                                                (window.location.href =
                                                                    "/"));
                                                  },
                                              });
                                      })
                                    : getNotification(
                                          "error",
                                          "Tüm alanları doldurman gerekiyor!"
                                      );
                            }),
                        $("body")
                            .off("click", "[data-fdelete]")
                            .on("click", "[data-fdelete]", function (e) {
                                e.preventDefault();
                                var t = $(this).data("fdelete"),
                                    a = $("title").text(),
                                    i = window.location.pathname;
                                t
                                    ? swal({
                                          title: "Konuyu Sil",
                                          text: "Bu konuyu silmek istediğinden emin misin?",
                                          showCancelButton: !0,
                                          confirmButtonText: "Evet, Sil",
                                          cancelButtonText: "Kapat",
                                      }).then((e) => {
                                          e.value &&
                                              $.ajax({
                                                  type: "POST",
                                                  url: "/ajax/service",
                                                  dataType: "json",
                                                  data: {
                                                      f_link: t,
                                                      type: "deleteTopic",
                                                  },
                                                  success: function (e) {
                                                      e &&
                                                          (e.error
                                                              ? (getNotification(
                                                                    "error",
                                                                    e.error
                                                                ),
                                                                history.replaceState(
                                                                    null,
                                                                    a,
                                                                    i
                                                                ))
                                                              : e.success
                                                              ? (getNotification(
                                                                    "success",
                                                                    e.success
                                                                ),
                                                                router.navigate(
                                                                    "forum",
                                                                    !0
                                                                ))
                                                              : e.session &&
                                                                (window.location.href =
                                                                    "/"));
                                                  },
                                              });
                                      })
                                    : getNotification(
                                          "error",
                                          "Tüm alanları doldurman gerekiyor!"
                                      );
                            }),
                        $("body")
                            .off("click touchstart", "#watch_together_trigger")
                            .on(
                                "click touchstart",
                                "#watch_together_trigger",
                                function (e) {
                                    e.preventDefault();
                                    var t = $(this).data("e_id"),
                                        a = $("title").text(),
                                        i = window.location.pathname;
                                    swal({
                                        title: "Seçiminden emin misin?",
                                        text: "bişeyler olacak!",
                                        type: "warning",
                                        showCancelButton: !0,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Evet!",
                                    }).then((e) => {
                                        console.log(e),
                                            e.dismiss ||
                                                $.ajax({
                                                    type: "POST",
                                                    url: "/ajax/service",
                                                    dataType: "json",
                                                    data: {
                                                        type: "selectEpisode4Room",
                                                        e_id: t,
                                                    },
                                                    beforeSend: function () {
                                                        $(this)
                                                            .addClass(
                                                                "disabled"
                                                            )
                                                            .prop(
                                                                "disabled",
                                                                !0
                                                            )
                                                            .attr(
                                                                "disabled",
                                                                !0
                                                            ),
                                                            history.replaceState(
                                                                null,
                                                                a,
                                                                i +
                                                                    "?edit=waiting_for_response"
                                                            );
                                                    },
                                                    success: function (e) {
                                                        e &&
                                                            (e.error
                                                                ? (history.replaceState(
                                                                      null,
                                                                      a,
                                                                      i
                                                                  ),
                                                                  getNotification(
                                                                      "error",
                                                                      e.error
                                                                  ))
                                                                : e.success
                                                                ? (router.navigate(
                                                                      "oda/" +
                                                                          e.username
                                                                  ),
                                                                  getNotification(
                                                                      "success",
                                                                      "Bölüm seçimi yapımlıştır"
                                                                  ))
                                                                : e.session &&
                                                                  (window.location.href =
                                                                      "/"));
                                                    },
                                                    complete: function () {
                                                        $(this).prop(
                                                            "disabled",
                                                            !1
                                                        );
                                                    },
                                                });
                                    });
                                }
                            );
                }
                $(document)
                    .off("submit", "#lost_pass")
                    .on("submit", "#lost_pass", function (e) {
                        e.preventDefault();
                        var t = $(this).serialize() + "&type=lostPass",
                            a = $(this),
                            i = $(this).find("#pass").val(),
                            o = $("button.primary", a),
                            s = $("button.primary", a).text(),
                            r = $("title").text(),
                            n = window.location.pathname;
                        i
                            ? ($("input,textarea,button", a).prop(
                                  "disabled",
                                  !0
                              ),
                              o.text("Yükleniyor..."),
                              $.ajax({
                                  type: "POST",
                                  url: "/ajax/service",
                                  dataType: "json",
                                  data: t,
                                  beforeSend: function () {
                                      history.replaceState(
                                          null,
                                          r,
                                          n + "?edit=waiting_for_response"
                                      );
                                  },
                                  success: function (e) {
                                      e &&
                                          (e.error
                                              ? (history.replaceState(
                                                    null,
                                                    r,
                                                    n
                                                ),
                                                getNotification(
                                                    "error",
                                                    e.error
                                                ))
                                              : e.success
                                              ? ((window.location.href = "/"),
                                                getNotification(
                                                    "success",
                                                    e.success
                                                ))
                                              : e.session &&
                                                (window.location.href = "/"));
                                  },
                                  error: function (e) {},
                                  complete: function () {
                                      o.text(s),
                                          $(
                                              "input[name!=username],textarea,button"
                                          ).prop("disabled", !1);
                                  },
                              }))
                            : getNotification(
                                  "error",
                                  "Lütfen, yeni şifrenizi yazınız !"
                              );
                    }),
                    $("body")
                        .off("click touchstart", "#tv-show-more")
                        .on("click touchstart", "#tv-show-more", function (e) {
                            e.preventDefault(),
                                $(this).hide(),
                                $("span.tv-more").show();
                        }),
                    $("body")
                        .off("click", ".series-load-more")
                        .on("click", ".series-load-more", function (t) {
                            t.preventDefault();
                            var a = $(this),
                                i = $(this).attr("data-page"),
                                o = parseInt(i) + 1,
                                s = $(this).html();
                            $(this).html("Yükleniyor"),
                                $(this)
                                    .addClass("disabled")
                                    .prop("disabled", !0)
                                    .attr("disabled", !0),
                                $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: { type: "loadLastEpisodes", page: o },
                                    success: function (e) {
                                        e &&
                                            (e.error
                                                ? (getNotification(
                                                      "error",
                                                      e.error
                                                  ),
                                                  setTimeout(function () {
                                                      a.removeClass("disabled")
                                                          .prop("disabled", !1)
                                                          .attr("disabled", !1);
                                                  }, 1e3))
                                                : e.success &&
                                                  (0 == e.no_more_episodes
                                                      ? (e.episodes &&
                                                            $(e.episodes)
                                                                .appendTo(
                                                                    "#result_lastEpisodes"
                                                                )
                                                                .hide()
                                                                .fadeIn(600),
                                                        a
                                                            .removeClass(
                                                                "disabled"
                                                            )
                                                            .prop(
                                                                "disabled",
                                                                !1
                                                            )
                                                            .attr(
                                                                "disabled",
                                                                !1
                                                            ))
                                                      : a.prop(
                                                            "disabled",
                                                            !0
                                                        )));
                                    },
                                    error: function (e) {},
                                    complete: function (t, i) {
                                        e.update(),
                                            "success" != i
                                                ? (a.attr("data-page", o),
                                                  a
                                                      .removeClass("disabled")
                                                      .prop("disabled", !1)
                                                      .attr("disabled", !1),
                                                  a.html(s))
                                                : (a.attr("data-page", o),
                                                  a.html(s));
                                    },
                                });
                        }),
                    $("body")
                        .off("click", ".comments-load-more")
                        .on("click", ".comments-load-more", function (e) {
                            e.preventDefault();
                            var t = $(this),
                                a = $(this).attr("data-page"),
                                i = $(this).attr("data-episode"),
                                o = $(this).attr("data-series"),
                                s = $(this).attr("data-collection"),
                                r = $(this).attr("data-forum"),
                                n = parseInt(a) + 1,
                                l = $(this).html();
                            $(this).html("Yükleniyor"),
                                $(this)
                                    .addClass("disabled")
                                    .prop("disabled", !0)
                                    .attr("disabled", !0),
                                $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: {
                                        type: "loadComments",
                                        page: a,
                                        episode: i,
                                        series: o,
                                        collection: s,
                                        forum: r,
                                    },
                                    success: function (e) {
                                        e &&
                                            (e.error
                                                ? (getNotification(
                                                      "error",
                                                      e.error
                                                  ),
                                                  setTimeout(function () {
                                                      t.removeClass("disabled")
                                                          .prop("disabled", !1)
                                                          .attr("disabled", !1);
                                                  }, 1e3))
                                                : e.success
                                                ? (e.comments
                                                      ? ($(e.comments)
                                                            .appendTo(
                                                                ".user-reviews #review-list"
                                                            )
                                                            .hide()
                                                            .fadeIn(600),
                                                        t
                                                            .removeClass(
                                                                "disabled"
                                                            )
                                                            .prop(
                                                                "disabled",
                                                                !1
                                                            )
                                                            .attr(
                                                                "disabled",
                                                                !1
                                                            ))
                                                      : t.attr("disabled", !0),
                                                  getNotification(
                                                      "success",
                                                      e.success
                                                  ))
                                                : e.session &&
                                                  (window.location.href = "/"));
                                    },
                                    error: function (e) {},
                                    complete: function () {
                                        t.attr("data-page", n),
                                            t.html(l),
                                            $(".dropdown").dropdown("refresh");
                                    },
                                });
                        });
                $().modal &&
                    $("body")
                        .off("click", "[data-yt]")
                        .on("click", "[data-yt]", function (e) {
                            e.preventDefault();
                            var t = $(this).attr("data-yt"),
                                a = $(this).data("link"),
                                i = $(this).data("film");
                            $("#wrapper").append(
                                '\n\t\t\t<div class="ui modal" id="fragman">\n\t\t\t\t<i class="close icon"></i>\n\t\t\t\t<div class="image content">\n\t\t\t\t\t<div class="image">\n\t\t\t\t\t\t<iframe width="100%" height="480" frameborder="0" title="fragman izle" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t'
                            );
                            var o = "Bu sezon başladı: Şimdi izle!";
                            i && (o = "Bu film yayında. Hemen izle!"),
                                a &&
                                    ($(".ui.modal").prepend(
                                        '<a href="' +
                                            a +
                                            '" class="ui red button close" id="watch-nowinside" data-navigo>' +
                                            o +
                                            "</a>"
                                    ),
                                    router.updatePageLinks()),
                                $("#fragman iframe").attr(
                                    "src",
                                    "https://www.youtube-nocookie.com/embed/" +
                                        t +
                                        "?autoplay=1&rel=0"
                                ),
                                $("#fragman")
                                    .modal({
                                        onHide: function () {
                                            $("#fragman iframe").attr(
                                                "src",
                                                ""
                                            );
                                        },
                                        onHidden: function () {
                                            $("#fragman").remove();
                                        },
                                    })
                                    .modal("show"),
                                $("#fragman").focus();
                        }),
                    $("body")
                        .off("click", ".replies-load-more")
                        .on("click", ".replies-load-more", function (e) {
                            e.preventDefault();
                            var t = $(this),
                                a = $(this).attr("data-page"),
                                i = $(this).attr("data-episode"),
                                o = $(this).attr("data-type"),
                                s = $(this).attr("data-comment"),
                                r = parseInt(a) + 1,
                                n = $(this).html();
                            $(this).html("Yükleniyor"),
                                $(this)
                                    .addClass("disabled")
                                    .prop("disabled", !0)
                                    .attr("disabled", !0),
                                $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: {
                                        type: "loadReplies",
                                        page: r,
                                        episode: i,
                                        comment: s,
                                        c_type: o,
                                    },
                                    success: function (e) {
                                        e &&
                                            (e.error
                                                ? (getNotification(
                                                      "error",
                                                      e.error
                                                  ),
                                                  setTimeout(function () {
                                                      t.removeClass("disabled")
                                                          .prop("disabled", !1)
                                                          .attr("disabled", !1);
                                                  }, 1e3))
                                                : e.success
                                                ? (e.comments &&
                                                      ($(e.comments)
                                                          .appendTo(
                                                              ".user-reviews .sub-reviews[data-comment=" +
                                                                  s +
                                                                  "]"
                                                          )
                                                          .hide()
                                                          .fadeIn(600),
                                                      t
                                                          .removeClass(
                                                              "disabled"
                                                          )
                                                          .prop("disabled", !1)
                                                          .attr(
                                                              "disabled",
                                                              !1
                                                          )),
                                                  getNotification(
                                                      "success",
                                                      e.success
                                                  ))
                                                : e.session &&
                                                  (window.location.href = "/"));
                                    },
                                    error: function (e) {},
                                    complete: function () {
                                        t.attr("data-page", r),
                                            t.html(n),
                                            $(".dropdown").dropdown("refresh");
                                    },
                                });
                        }),
                    $("body")
                        .off("click", ".forums-load-more")
                        .on("click", ".forums-load-more", function (e) {
                            e.preventDefault();
                            var t = $(this),
                                a = $(this).attr("data-page"),
                                i = parseInt(a) + 1,
                                o = $(this).html();
                            $(this).html("Yükleniyor"),
                                $(this)
                                    .addClass("disabled")
                                    .prop("disabled", !0)
                                    .attr("disabled", !0),
                                $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: { type: "loadForums", page: a },
                                    success: function (e) {
                                        e &&
                                            (e.error
                                                ? (getNotification(
                                                      "error",
                                                      e.error
                                                  ),
                                                  setTimeout(function () {
                                                      t.removeClass("disabled")
                                                          .prop("disabled", !1)
                                                          .attr("disabled", !1);
                                                  }, 1e3))
                                                : e.success
                                                ? (e.topics &&
                                                      ($(e.topics)
                                                          .insertAfter(
                                                              "li.story-list-item:last"
                                                          )
                                                          .hide()
                                                          .fadeIn(600),
                                                      t
                                                          .removeClass(
                                                              "disabled"
                                                          )
                                                          .prop("disabled", !1)
                                                          .attr(
                                                              "disabled",
                                                              !1
                                                          )),
                                                  getNotification(
                                                      "success",
                                                      e.success
                                                  ))
                                                : e.session &&
                                                  (window.location.href = "/"));
                                    },
                                    error: function (e) {},
                                    complete: function () {
                                        t.attr("data-page", i),
                                            t.html(o),
                                            $(".dropdown").dropdown("refresh");
                                    },
                                });
                        }),
                    $(".poster-media .image").dimmer({ on: "hover" }),
                    $("body")
                        .off("click", ".notifications .delete")
                        .on("click", ".notifications .delete", function (e) {
                            e.preventDefault();
                            var t = $(this).data("notification");
                            $(this)
                                .addClass("disabled")
                                .prop("disabled", !0)
                                .attr("disabled", !0),
                                $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: { type: "del_notification", noti: t },
                                    success: function (e) {
                                        e &&
                                            (e.error
                                                ? getNotification(
                                                      "error",
                                                      e.error
                                                  )
                                                : e.success
                                                ? $(
                                                      'div.item[data-notification="' +
                                                          t +
                                                          '"]'
                                                  ).slideUp("slow")
                                                : e.session &&
                                                  (window.location.href = "/"));
                                    },
                                });
                        }),
                    $("body")
                        .off("click", ".dimmable .colDelete")
                        .on("click", ".dimmable .colDelete", function (e) {
                            var t = $(this),
                                a = t.data("id"),
                                i = t.data("col");
                            $(this)
                                .addClass("disabled")
                                .prop("disabled", !0)
                                .attr("disabled", !0),
                                swal({
                                    title: "Koleksiyondan Silinecek",
                                    text: "Bu işlemi yapmak istediğinden emin misin?",
                                    type: "warning",
                                    showCancelButton: !0,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Sil",
                                    cancelButtonText: "Kapat",
                                }).then((e) => {
                                    e.value
                                        ? $.ajax({
                                              type: "POST",
                                              url: "/ajax/service",
                                              dataType: "json",
                                              data: {
                                                  type: "del_collection",
                                                  data: a,
                                                  col: i,
                                              },
                                              success: function (e) {
                                                  e &&
                                                      (e.error
                                                          ? getNotification(
                                                                "error",
                                                                e.error
                                                            )
                                                          : e.success
                                                          ? (getNotification(
                                                                "success",
                                                                e.success
                                                            ),
                                                            $(
                                                                ".segment-poster#data_" +
                                                                    a
                                                            ).fadeOut("medium"))
                                                          : e.session &&
                                                            (window.location.href =
                                                                "/"));
                                              },
                                          })
                                        : t
                                              .removeClass("disabled")
                                              .prop("disabled", !1)
                                              .attr("disabled", !1);
                                });
                        }),
                    $("body")
                        .off("click", ".notifications .topButtons .deleteAll")
                        .on(
                            "click",
                            ".notifications .topButtons .deleteAll",
                            function (e) {
                                var t = $(this);
                                $(this)
                                    .addClass("disabled")
                                    .prop("disabled", !0)
                                    .attr("disabled", !0),
                                    swal({
                                        title: "Bildirimler Silinecek",
                                        text: "Bu işlemi yapmak istediğinden emin misin?",
                                        type: "warning",
                                        showCancelButton: !0,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Bildirimleri Sil",
                                        cancelButtonText: "Kapat",
                                    }).then((e) => {
                                        e.value
                                            ? $.ajax({
                                                  type: "POST",
                                                  url: "/ajax/service",
                                                  dataType: "json",
                                                  data: {
                                                      type: "deleteAll_notifications",
                                                  },
                                                  success: function (e) {
                                                      e &&
                                                          (e.error
                                                              ? getNotification(
                                                                    "error",
                                                                    e.error
                                                                )
                                                              : e.success
                                                              ? getNotification(
                                                                    "success",
                                                                    e.success
                                                                )
                                                              : e.session &&
                                                                (window.location.href =
                                                                    "/"));
                                                  },
                                              })
                                            : t
                                                  .removeClass("disabled")
                                                  .prop("disabled", !1)
                                                  .attr("disabled", !1);
                                    });
                            }
                        ),
                    $("body")
                        .off("click", ".notifications .topButtons .readAll")
                        .on(
                            "click",
                            ".notifications .topButtons .readAll",
                            function (e) {
                                e.preventDefault(),
                                    $(this)
                                        .addClass("disabled")
                                        .prop("disabled", !0)
                                        .attr("disabled", !0),
                                    see_notification();
                            }
                        ),
                    $("body")
                        .off("click", ".notifications-load-more")
                        .on("click", ".notifications-load-more", function (e) {
                            e.preventDefault();
                            var t = $(this),
                                a = $(this).attr("data-page"),
                                i = parseInt(a) + 1,
                                o = $(this).html();
                            $(this).html("Yükleniyor"),
                                $(this)
                                    .addClass("disabled")
                                    .prop("disabled", !0)
                                    .attr("disabled", !0),
                                $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: { type: "notifications", page: a },
                                    success: function (e) {
                                        e &&
                                            (e.error
                                                ? (getNotification(
                                                      "error",
                                                      e.error
                                                  ),
                                                  setTimeout(function () {
                                                      t.removeClass("disabled")
                                                          .prop("disabled", !1)
                                                          .attr("disabled", !1);
                                                  }, 1e3))
                                                : e.success
                                                ? (e.notifications &&
                                                      ($(e.notifications)
                                                          .insertAfter(
                                                              ".notifications .item:last"
                                                          )
                                                          .hide()
                                                          .fadeIn(600),
                                                      t
                                                          .removeClass(
                                                              "disabled"
                                                          )
                                                          .prop("disabled", !1)
                                                          .attr(
                                                              "disabled",
                                                              !1
                                                          )),
                                                  getNotification(
                                                      "success",
                                                      e.success
                                                  ))
                                                : e.session &&
                                                  (window.location.href = "/"));
                                    },
                                    error: function (e) {},
                                    complete: function () {
                                        t.attr("data-page", i),
                                            t.html(o),
                                            $(".dropdown").dropdown("refresh");
                                    },
                                });
                        }),
                    $("body")
                        .off("click", ".review-content-spoiler p")
                        .on("click", ".review-content-spoiler p", function () {
                            $(this).parents(".spoiler").removeClass("spoiler"),
                                $(this).parent().fadeOut(100);
                        }),
                    $("body")
                        .off("click", ".alert-spoiler")
                        .on("click", ".alert-spoiler", function (e) {
                            $(this).hide(), $(this).next().show();
                        }),
                    $("body")
                        .off("click", "[data-link]")
                        .on("click", "[data-link]", function (e) {
                            e.preventDefault();
                            var t = $(this).data("link"),
                                a = $(this).data("hash"),
                                i = $(this).data("querytype"),
                                o = $(this),
                                s = window.location.pathname;
                            if (o.hasClass("active")) return !1;
                            a &&
                                ($(".player").html(""),
                                $.ajax({
                                    type: "POST",
                                    url: "/ajax/service",
                                    dataType: "json",
                                    data: {
                                        link: t,
                                        hash: a,
                                        querytype: i,
                                        type: "videoGet",
                                    },
                                    success: function (e) {
                                        e &&
                                            (e.success
                                                ? "alternate" == i
                                                    ? (0 == e.api.iframe
                                                          ? ($(".player").html(
                                                                '<video id="player_container" class="video-js vjs-fluid vjs-default-skin" controls preload="auto" data-s_id="" data-e_id=""></video>'
                                                            ),
                                                            do_player(e))
                                                          : 12 == e.vs_id
                                                          ? $(".player").html(
                                                                '<iframe src="' +
                                                                    e.api_iframe +
                                                                    '" scrolling="no" allowfullscreen="true" scrolling="no" sandbox="allow-forms allow-pointer-lock allow-same-origin allow-scripts allow-top-navigation" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen="" frameborder="0"></iframe>'
                                                            )
                                                          : $(".player").html(
                                                                "<iframe " +
                                                                    e.attr +
                                                                    ' src="' +
                                                                    e.api_iframe +
                                                                    '" scrolling="no" allowfullscreen="true"></iframe>'
                                                            ),
                                                      $(
                                                          ".alternatives-for-this .item.active"
                                                      ).removeClass("active"),
                                                      o.addClass("active"))
                                                    : router.navigate(
                                                          s +
                                                              "#rel=audiochanged_" +
                                                              a,
                                                          !1
                                                      )
                                                : e.empty
                                                ? getNotification(
                                                      "error",
                                                      "hash yok"
                                                  )
                                                : getNotification(
                                                      "error",
                                                      e.error
                                                  ));
                                    },
                                }));
                        });
            }),
            (e.FormEvents = function () {
                ($("body").on("submit", "#login-form", function (e) {
                    e.preventDefault();
                    var t = $(this),
                        a = $('button[type="submit"]', this),
                        i = a.html(),
                        o = t.serialize(),
                        s = !0;
                    a.html("Yükleniyor..."),
                        $.each($("input[name]", t), function (e, t) {
                            "" == $(this).val() && (s = !1);
                        }),
                        s
                            ? $.ajax({
                                  type: "POST",
                                  url: "/ajax/service",
                                  dataType: "json",
                                  data: o,
                                  success: function (e) {
                                      e &&
                                          (e.success
                                              ? (getNotification(
                                                    "success",
                                                    e.success
                                                ),
                                                (window.location.href =
                                                    location.protocol +
                                                    "//" +
                                                    location.host +
                                                    location.pathname),
                                                a.prop("disabled", !0))
                                              : getNotification(
                                                    "error",
                                                    e.error
                                                ));
                                  },
                                  complete: function () {
                                      a.prop("disabled", !1), a.html(i);
                                  },
                              })
                            : (getNotification(
                                  "error",
                                  "Lütfen tüm bilgileri eksiksiz girin."
                              ),
                              a.prop("disabled", !1),
                              a.html(i));
                }),
                $("body")
                    .off("click touchstart", "#signup")
                    .on("click touchstart", "#signup", function (e) {
                        "https://yabancidizi.org/login" !=
                            $(this).attr("href") &&
                            (e.preventDefault(),
                            $('#login-form input[name="type"]').val("register"),
                            $('#login-form button[type="submit"]').text(
                                "Kayıt Ol"
                            ),
                            $(".login-wrapper #signup")
                                .attr(
                                    "href",
                                    location.protocol +
                                        "//" +
                                        location.host +
                                        "/login"
                                )
                                .html("<span>Giriş Yap</span>"),
                            $("#login-form [hidden]").attr(
                                "name",
                                $(this).attr("id")
                            ),
                            $("#login-form #email").attr(
                                "name",
                                $("#login-form #email").attr("id")
                            ),
                            $("#login-form #password_try").attr(
                                "name",
                                $("#login-form #password_try").attr("id")
                            ),
                            $("#login-form [hidden]").prop("required", !0),
                            $("#login-form [hidden]").prop("hidden", !1));
                    }),
                $("body")
                    .off("click", "#reset-password")
                    .on("click", "#reset-password", function (e) {
                        e.preventDefault(),
                            $(".swal2-input").off("keypress"),
                            swal({
                                title: "Şifre Sıfırla",
                                text: "Lütfen, E-posta adresinizi giriniz",
                                input: "text",
                                showCancelButton: !0,
                                confirmButtonText: "Gönder",
                                cancelButtonText: "Kapat",
                                showLoaderOnConfirm: !0,
                                preConfirm: (e) =>
                                    $.ajax({
                                        type: "POST",
                                        url: "/ajax/service",
                                        dataType: "json",
                                        data: { data: e, type: "forgot_pw" },
                                        success: function (e) {
                                            e
                                                ? e.success
                                                    ? getNotification(
                                                          "success",
                                                          e.success
                                                      )
                                                    : (swal.showValidationError(
                                                          "Hata: " + e.error
                                                      ),
                                                      getNotification(
                                                          "error",
                                                          e.error
                                                      ))
                                                : swal.showValidationError(
                                                      "Hata: Lütfen formu boş bırakmayınız."
                                                  );
                                        },
                                    }),
                                allowOutsideClick: () => !swal.isLoading(),
                            }).then((e) => {});
                    }),
                window.location.hash) &&
                    "signup" == window.location.hash.substring(1) &&
                    ($('#login-form input[name="type"]').val("register"),
                    $('#login-form button[type="submit"]').text("Kayıt Ol"),
                    $(".login-wrapper #signup")
                        .attr(
                            "href",
                            location.protocol + "//" + location.host + "/login"
                        )
                        .html("<span>Giriş Yap</span>"),
                    $("#login-form [hidden]").attr("name", $(this).attr("id")),
                    $("#login-form #email").attr(
                        "name",
                        $("#login-form #email").attr("id")
                    ),
                    $("#login-form #password_try").attr(
                        "name",
                        $("#login-form #password_try").attr("id")
                    ),
                    $("#login-form [hidden]").prop("required", !0),
                    $("#login-form [hidden]").prop("hidden", !1));
            }),
            (e.WidgetEvents = function () {
                var e = $("#sortable")[0],
                    t = null;
                e && dragula([e], { removeOnSpill: !0 }),
                    $(document)
                        .off("click touchstart")
                        .on("click touchstart", function (e) {
                            $("#search-results").hide();
                        }),
                    $(document)
                        .off("click touchstart", "#search-results")
                        .on(
                            "click touchstart",
                            "#search-results",
                            function (e) {
                                e.stopPropagation();
                            }
                        ),
                    $(document)
                        .off("input", "#tvSearch")
                        .on("input", "#tvSearch", function (e) {
                            e.preventDefault();
                            var a = $(this);
                            clearTimeout(t),
                                $(this).parent().children(".deleteicon").show(),
                                "" == $(this).val() &&
                                    $(this)
                                        .parent()
                                        .children(".deleteicon")
                                        .hide(),
                                $("body")
                                    .off("click", "#search-response a")
                                    .on(
                                        "click",
                                        "#search-response a",
                                        function (e) {
                                            a.val(""),
                                                a
                                                    .parent()
                                                    .children(".deleteicon")
                                                    .hide();
                                        }
                                    );
                            var i = $(this).val(),
                                o = "",
                                s = "",
                                r = "",
                                n = "",
                                l = "",
                                c = "/search?qr=" + i,
                                d = 1e3;
                            $("#h_user_data").length > 0 &&
                                ((c = "/search_n?qr=" + i), (d = 500)),
                                i && i.length >= 3
                                    ? (t = setTimeout(function () {
                                          $("#search-results").show(),
                                              (window.currentSearch = $.ajax({
                                                  type: "POST",
                                                  url: c,
                                                  dataType: "json",
                                                  data: {},
                                                  beforeSend: function (e) {
                                                      0 !=
                                                          window.currentSearch &&
                                                          (window.currentSearch.abort(),
                                                          (window.currentSearch =
                                                              !1));
                                                  },
                                                  success: function (e) {
                                                      (window.currentSearch =
                                                          !1),
                                                          e &&
                                                              (e.success
                                                                  ? e.type ||
                                                                    ($.each(
                                                                        e.data
                                                                            .result,
                                                                        function (
                                                                            e,
                                                                            t
                                                                        ) {
                                                                            void 0 !==
                                                                                t.s_type &&
                                                                                "1" ==
                                                                                    t.s_type &&
                                                                                (s +=
                                                                                    '<li class="segment-poster"><div class="poster poster-md"><div class="poster-media"><a href="film/' +
                                                                                    t.s_link +
                                                                                    '" data-navigo><img src="uploads/series/' +
                                                                                    t.s_image +
                                                                                    '"></a></div><div class="poster-subject"><a href="film/' +
                                                                                    t.s_link +
                                                                                    '" data-navigo><h2 class="truncate">' +
                                                                                    t.s_name +
                                                                                    '</h2></a><p class="poster-meta truncate"><span class="genres">' +
                                                                                    t.s_year +
                                                                                    "</span></p></div></div></li>"),
                                                                                void 0 !==
                                                                                    t.s_type &&
                                                                                    "0" ==
                                                                                        t.s_type &&
                                                                                    (o +=
                                                                                        '<li class="segment-poster-sm"><div class="poster poster-xs"><a href="dizi/' +
                                                                                        t.s_link +
                                                                                        '" data-navigo><div class="poster-subject"><h2 class="truncate">' +
                                                                                        t.s_name +
                                                                                        '</h2></div><img alt="..." class="lazy-wide loaded" src="/uploads/series/cover/' +
                                                                                        t.s_image +
                                                                                        '" data-src="/uploads/series/cover/' +
                                                                                        t.s_image +
                                                                                        '"></a></div></li>'),
                                                                                void 0 !==
                                                                                    t.u_id &&
                                                                                    "" !=
                                                                                        t.u_id &&
                                                                                    (l +=
                                                                                        '<li><a href="profil/' +
                                                                                        t.u_username +
                                                                                        '" data-navigo>' +
                                                                                        ("avatar.jpg" ==
                                                                                        t.u_avatar
                                                                                            ? '<img src="https://api.adorable.io/avatars/285/' +
                                                                                              t.u_username +
                                                                                              '">'
                                                                                            : '<img src="/uploads/users/' +
                                                                                              t.u_avatar +
                                                                                              '">') +
                                                                                        "<span>" +
                                                                                        (t.u_name
                                                                                            ? '<h6 class="truncate">' +
                                                                                              t.u_name +
                                                                                              "</h6>"
                                                                                            : '<h6 class="truncate">@' +
                                                                                              t.u_username +
                                                                                              "</h6>") +
                                                                                        (t.u_name
                                                                                            ? '<small class="truncate">@' +
                                                                                              t.u_username +
                                                                                              "</small>"
                                                                                            : "") +
                                                                                        "</span></a></li>"),
                                                                                void 0 !==
                                                                                    t.c_id &&
                                                                                    "" !=
                                                                                        t.c_id &&
                                                                                    (n +=
                                                                                        '<li><a href="oyuncu/' +
                                                                                        t.cast_link +
                                                                                        '" data-navigo><img src="/uploads/cast/' +
                                                                                        t.cast_image +
                                                                                        '"><h6 class="truncate">' +
                                                                                        t.cast_name +
                                                                                        "</h6></a></li>");
                                                                        }
                                                                    ),
                                                                    "" != o &&
                                                                        (r +=
                                                                            '<div class="small-heading">Diziler</div><div class="dark-segment"><ul class="clearfix" style="flex-wrap: wrap;">' +
                                                                            o +
                                                                            "</ul></div>"),
                                                                    "" != s &&
                                                                        (r +=
                                                                            '<div class="small-heading">Filmler</div><div class="dark-segment"><ul class="clearfix" style="flex-wrap: wrap;">' +
                                                                            s +
                                                                            "</ul></div>"),
                                                                    "" != n &&
                                                                        (r +=
                                                                            '<div class="small-heading">Oyuncular</div><div class="actor-list"><ul style="flex-wrap: wrap;">' +
                                                                            n +
                                                                            "</ul></div>"),
                                                                    "" != l &&
                                                                        (r +=
                                                                            '<div class="small-heading">Kullanıcılar</div><div class="actor-list"><ul style="flex-wrap: wrap;">' +
                                                                            l +
                                                                            "</ul></div>"),
                                                                    $(
                                                                        "#search-response"
                                                                    ).html(r))
                                                                  : $(
                                                                        "#search-response"
                                                                    ).html(
                                                                        '<div class="alert alert-danger ml-md mr-md mb-md" role="alert"><p>Belirttiğin kriterlere uygun hiç sonuç bulamadık.</p></div>'
                                                                    ));
                                                  },
                                                  complete: function () {
                                                      router.updatePageLinks();
                                                  },
                                              }));
                                      }, d))
                                    : ($("#search-response").html(""),
                                      $("#search-results").hide());
                        }),
                    $(document)
                        .off("click touchstart", ".deleteicon")
                        .on("click touchstart", ".deleteicon", function () {
                            $("#tvSearch").val("").focus(),
                                "" == $("#tvSearch").val() && $(this).hide();
                        }),
                    $(document)
                        .off("click touchstart", "#tvSearch")
                        .on("click touchstart", "#tvSearch", function (e) {
                            e.stopPropagation(),
                                "" != $(this).val() &&
                                    $(this).val().length >= 2 &&
                                    $("#search-results").show();
                        }),
                    ($.fn.circle_progress = function () {
                        $.each(this, function () {
                            return $(this).html(
                                '<svg version="1.1" viewBox="0 0 100 100">\t\t\t\t\t<circle class="ring" cx="-48" cy="48" fill-opacity="0" r="46" stroke-dashoffset="293" stroke-dasharray="' +
                                    (($(this).attr("data-percent") / 100) *
                                        293 +
                                        293) +
                                    '" transform="rotate(-90)"></circle>\t\t\t\t\t</svg>'
                            );
                        });
                    });
                var a = $(".circle-progress");
                a.length && a.circle_progress();
            }),
            (e.BaseEvents = function () {
                (window.heartbeat = setInterval(function () {
                    gtag("event", "HeartBeat", { minutes: "1" });
                }, 6e4)),
                    (window.heartbeat5 = setInterval(function () {
                        gtag("event", "HeartBeat", { minutes: "5" });
                    }, 3e5)),
                    (window.heartbeat30 = setInterval(function () {
                        gtag("event", "HeartBeat", { minutes: "30" });
                    }, 18e5)),
                    (window.heartbeat60 = setInterval(function () {
                        gtag("event", "HeartBeat", { minutes: "60" });
                    }, 36e5)),
                    $(".mobile-menu-trigger")
                        .off("click")
                        .on("click", function (e) {
                            e.stopPropagation(),
                                $(
                                    "#primary-sidebar, #wrapper, .triggered-overlay, body"
                                ).addClass("triggered"),
                                $("#sidebar-inner").focus(),
                                $("[data-navigo]")
                                    .off("click")
                                    .on("click", function () {
                                        $(
                                            "#primary-sidebar, #wrapper, .triggered-overlay, body"
                                        ).removeClass("triggered");
                                    }),
                                $(".triggered-overlay.triggered")
                                    .off("click")
                                    .on("click", function (e) {
                                        $(
                                            "#primary-sidebar, #wrapper, .triggered-overlay, body"
                                        ).removeClass("triggered");
                                    });
                        }),
                    $("#trigger-filter-sidebar")
                        .off("touchstart")
                        .on("touchstart", function (e) {
                            e.preventDefault(),
                                $("#filter-sidebar").toggleClass("active");
                        });
                var e = $("a[rel*=external]"),
                    t = $("a[rel*=nofollow]").not("a[href^='kesfet']");
                e.off("click").on("click", function (e) {
                    return (
                        e.stopPropagation(),
                        e.preventDefault(),
                        window.open(this.href),
                        !1
                    );
                }),
                    t.off("click").on("click", function (e) {
                        return (
                            e.stopPropagation(),
                            e.preventDefault(),
                            window.open(this.href),
                            !1
                        );
                    }),
                    $("#scroll-notifications").scrollbar({ debug: !1 }),
                    -1 !== window.location.pathname.indexOf("/kesfet") &&
                        $.loadScript(
                            "/mofy/js/ion.rangeSlider.min.js",
                            function () {
                                $("#filter-years").ionRangeSlider({
                                    type: "double",
                                    grid: !1,
                                    min: 2e3,
                                    max: 2023,
                                    from: 2e3,
                                    to: 2023,
                                    hide_min_max: !0,
                                    hide_from_to: !0,
                                    onFinish: function (e) {
                                        var t =
                                            window.location.pathname.split(
                                                "kesfet/"
                                            )[1];
                                        if (
                                            (t &&
                                                -1 !== t.indexOf("/") &&
                                                (t = t.split("/")[0]),
                                            t && "W10=" != t)
                                        ) {
                                            var a = t;
                                            (a = (a = a.replace(
                                                "-",
                                                "+"
                                            )).replace("_", "/")),
                                                (a = atob(a));
                                            var i = JSON.parse(a);
                                        } else i = {};
                                        (i.year = {}),
                                            (i.year.from = e.from),
                                            (i.year.to = e.to);
                                        var o = JSON.stringify(i),
                                            s = btoa(o),
                                            r = (s = (s = s.replace(
                                                "+",
                                                "-"
                                            )).replace("/", "_"));
                                        router.navigate("kesfet/" + r, !0);
                                    },
                                    onStart: function (e) {
                                        $("#range-years span:first-child").html(
                                            e.from
                                        ),
                                            $(
                                                "#range-years span:last-child"
                                            ).html(e.to);
                                    },
                                    onChange: function (e) {
                                        $("#range-years span:first-child").html(
                                            e.from
                                        ),
                                            $(
                                                "#range-years span:last-child"
                                            ).html(e.to);
                                    },
                                }),
                                    $("#filter-imdb").ionRangeSlider({
                                        type: "double",
                                        grid: !1,
                                        min: 0,
                                        max: 10,
                                        from: 5,
                                        to: 10,
                                        hide_min_max: !0,
                                        hide_from_to: !0,
                                        onFinish: function (e) {
                                            var t =
                                                window.location.pathname.split(
                                                    "kesfet/"
                                                )[1];
                                            if (
                                                (t &&
                                                    -1 !== t.indexOf("/") &&
                                                    (t = t.split("/")[0]),
                                                t && "W10=" != t)
                                            ) {
                                                var a = t;
                                                (a = (a = a.replace(
                                                    "-",
                                                    "+"
                                                )).replace("_", "/")),
                                                    (a = atob(a));
                                                var i = JSON.parse(a);
                                            } else i = {};
                                            (i.imdb = {}),
                                                (i.imdb.from = e.from),
                                                (i.imdb.to = e.to);
                                            var o = JSON.stringify(i),
                                                s = btoa(o),
                                                r = (s = (s = s.replace(
                                                    "+",
                                                    "-"
                                                )).replace("/", "_"));
                                            router.navigate("kesfet/" + r, !0);
                                        },
                                        onStart: function (e) {
                                            $(
                                                "#range-imdb span:first-child"
                                            ).html(e.from),
                                                $(
                                                    "#range-imdb span:last-child"
                                                ).html(e.to);
                                        },
                                        onChange: function (e) {
                                            $(
                                                "#range-imdb span:first-child"
                                            ).html(e.from),
                                                $(
                                                    "#range-imdb span:last-child"
                                                ).html(e.to);
                                        },
                                    });
                            }
                        );
            });
        var t = function (e, t) {
                return (
                    '<div class="alert alert-' +
                    t +
                    '" role="alert">' +
                    e +
                    "</div>"
                );
            },
            a = $("#room_status").val();
        "" != a &&
            ($("#chatbox-scroll, #sidebar-inner").scrollbar({ debug: !1 }),
            $("#chatbox-scroll").length > 0 &&
                $("#chatbox-scroll").scrollTop(
                    $("#chatbox-scroll")[0].scrollHeight
                ),
            "done" == a &&
                ($("body").addClass("full-body"),
                $("#primary-sidebar").hide(),
                $(".footer").hide(),
                $.loadScript("/mofy/js/video.min.js", function () {
                    $.loadScript("mofy/js/videojs.hotkeys.min.js", function () {
                        $.loadScript(
                            "mofy/js/videojs-quality-selector.min.js",
                            function () {
                                room_player();
                            }
                        );
                    });
                })),
            "no_login" == a &&
                ($("body").addClass("full-body"),
                $("#primary-sidebar").show(),
                $(".footer").hide()),
            "no_episode" == a
                ? ($("body").addClass("full-body"),
                  $(".footer").hide(),
                  $(".wt-box .playing-now .poster-container").hide(),
                  $(".player.room-player").append(
                      '<div class="room-settings-overlay"><div class="room-introducing">\t<svg class="mofycon"><use xlink:href="#icon-watch-together-huge"></use></svg>\t<h1>Birlikte İzle</h1>\t<p>Sevgilinle, arkadaşlarınla yada herhangi bir takipçinle birlikte film veya dizi izle, eş zamanlı olarak sohbet et!</p>\t<a href="kesfet" class="ui primary button" data-navigo>Keşfet</a></div></div>'
                  ),
                  $(".player video").remove(),
                  $("#router-view").removeClass("loading"))
                : "not_a_participant" == a &&
                  ($("#router-view").html(
                      t(
                          "Bu odaya erişim iznin yok. Odaya girebilmen için davetiyeye ihtiyacın var.",
                          "danger"
                      )
                  ),
                  $("#router-view").removeClass("loading")));
        var i = window.location.pathname;
        "beta" == i || "home" == i || "/" == i || (i = i.substr(1)),
            $(".guide-icon-menu")
                .find("li")
                .each(function () {
                    $("a", this).attr("href") != i &&
                        $(this).parent().find(".menu-submenu").hide(),
                        $(this).toggleClass(
                            "active",
                            $("a", this).attr("href") == i
                        );
                }),
            "series" == $("#router").data("page")
                ? "film" == $("#router").data("meth") && movies_view()
                : "series_detail" == $("#router").data("page") && series_view(),
            "profile" == $("#router").data("page") && profile_view();
        var o = function (a) {
            null != document.getElementById("video_play_2") &&
                document.getElementById("video_play_2").setAttribute("src", "");
            (document.body.scrollTop = document.documentElement.scrollTop = 0),
                $("section#adLft").remove(),
                $("#search-results").hide(),
                $("#router-view").addClass("loading"),
                $("#router-view").html(
                    '<div class="skeleton-loading"><div class="skeleton-bac-animation"></div><div class="row" style="justify-content: start; padding-bottom: 15px;"><div class="square-list"><div class="square" style="background-color: #181924; width: 70px; height: 15px; margin-top: 10px; margin-bottom: 0px;"></div><div class="square" style="background-color: #181924; width: 150px; height: 32px; margin-top: 10px; margin-bottom: 0px;"></div><div class="square" style="background-color: #181924; width: 100%; height: 45px; margin-top: 30px; margin-bottom: 0px;"></div></div></div><div class="row" style="justify-content: start; padding-top: 0px; padding-bottom: 0px;"><div class="col" style="width: 300px; padding: 0px;"><div class="circle" style="background-color: #181924; width: 100%; height: 450px;"></div></div><div class="col" style="width: 600px; padding-left: 30px;"><div class="square-list"><div class="square" style="background-color: #181924; width: 70px; height: 26px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 100%; height: 15px; margin-top: 30px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 100%; height: 15px; margin-top: 5px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 100%; height: 15px; margin-top: 5px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 100%; height: 15px; margin-top: 5px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 50%; height: 15px; margin-top: 5px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 50px; height: 15px; margin-top: 30px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 50px; height: 15px; margin-top: 10px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 100%; height: 70px; margin-top: 30px; margin-bottom: 0px;"></div></div><div class="square-list"><div class="square" style="background-color: #181924; width: 100%; height: 100px; margin-top: 15px; margin-bottom: 0px;"></div></div></div></div></div>'
                );
            var i = router.lastRouteResolved();
            void 0 === i.name && (i.name = "/"),
                $(".guide-icon-menu")
                    .find("li")
                    .each(function () {
                        $("a", this).attr("href") != i.name &&
                            $(this).parent().find(".menu-submenu").hide(),
                            $(this).toggleClass(
                                "active",
                                $("a", this).attr("href") == i.name
                            );
                    }),
                (window.currentRequest = $.ajax({
                    url: a,
                    beforeSend: function (e) {
                        0 != window.currentRequest &&
                            window.currentRequest.abort(),
                            $(".modals").remove(),
                            clearTimeout(isHomere),
                            $("body").removeClass("dimmable dimmed");
                    },
                })
                    .done(function (a) {
                        $("#router-view").html(a);
                        var o = $("#page_title").val(),
                            s = $("#page_desc").val(),
                            r = $("#page_keyw").val(),
                            n = $("#page_image").val();
                        if (
                            ((document.title = o),
                            $("meta[name=description]").attr("content", s),
                            $("meta[name=keywords]").attr("content", r),
                            $("meta[property='og\\:title']").attr("content", o),
                            $("meta[property='og\\:url']").attr(
                                "content",
                                window.location.href
                            ),
                            $("meta[property='og\\:image']").attr("content", n),
                            $('link[rel="canonical"]').attr(
                                "href",
                                window.location.href
                            ),
                            gtag("config", "UA-274501025-1", {
                                page_path: window.location.pathname,
                            }),
                            clearInterval(window.heartbeat),
                            clearInterval(window.heartbeat5),
                            clearInterval(window.heartbeat30),
                            clearInterval(window.heartbeat60),
                            (window.heartbeat = setInterval(function () {
                                gtag("event", "HeartBeat", { minutes: "1" });
                            }, 3e5)),
                            (window.heartbeat5 = setInterval(function () {
                                gtag("event", "HeartBeat", { minutes: "5" });
                            }, 3e5)),
                            (window.heartbeat30 = setInterval(function () {
                                gtag("event", "HeartBeat", { minutes: "30" });
                            }, 18e5)),
                            (window.heartbeat60 = setInterval(function () {
                                gtag("event", "HeartBeat", { minutes: "60" });
                            }, 36e5)),
                            $("#router-view").removeClass("loading"),
                            ("dizi/:slug/sezon-:sezon/bolum-:bolum" != i.name &&
                                "dizi/:slug/sezon-:sezon/bolum-:bolum/:sessecenegi" !=
                                    i.name) ||
                                ("404" != a && series_view()),
                            ("film/:slug" != i.name &&
                                "film/:slug/turkce-dublaj-izle" != i.name &&
                                "film/:slug/turkce-altyazili-izle" != i.name &&
                                "film/:slug/altyazisiz-izle" != i.name) ||
                                ("404" != a && movies_view()),
                            "profil/:username" == i.name && profile_view(),
                            "oda/:code" == i.name)
                        ) {
                            $("#chatbox-scroll, #sidebar-inner").scrollbar({
                                debug: !1,
                            });
                            var l = $("#room_status").val();
                            "done" == l &&
                                ($("body").addClass("full-body"),
                                $("#primary-sidebar").hide(),
                                $(".footer").hide(),
                                $.loadScript(
                                    "/mofy/js/video.min.js",
                                    function () {
                                        $.loadScript(
                                            "mofy/js/videojs.hotkeys.min.js",
                                            function () {
                                                $.loadScript(
                                                    "mofy/js/videojs-quality-selector.min.js",
                                                    function () {
                                                        room_player();
                                                    }
                                                );
                                            }
                                        );
                                    }
                                )),
                                "no_login" == l &&
                                    ($("body").addClass("full-body"),
                                    $("#primary-sidebar").show(),
                                    $(".footer").show()),
                                "no_episode" == l
                                    ? ($("body").addClass("full-body"),
                                      $(".footer").hide(),
                                      $(
                                          ".wt-box .playing-now .poster-container"
                                      ).hide(),
                                      $(".player.room-player").append(
                                          '<div class="room-settings-overlay"><div class="room-introducing">\t<svg class="mofycon"><use xlink:href="#icon-watch-together-huge"></use></svg>\t<h1>Birlikte İzle</h1>\t<p>Sevgilinle, arkadaşlarınla yada herhangi bir takipçinle birlikte film veya dizi izle, eş zamanlı olarak sohbet et!</p>\t<a href="kesfet" class="ui primary button" data-navigo>Keşfet</a></div></div>'
                                      ),
                                      $(".player video").remove(),
                                      $("#router-view").removeClass("loading"))
                                    : "not_a_participant" == l &&
                                      ($("#router-view").html(
                                          t(
                                              "Bu odaya erişim iznin yok. Odaya girebilmen için davetiyeye ihtiyacın var.",
                                              "danger"
                                          )
                                      ),
                                      $("#router-view").removeClass("loading"));
                        } else "birlikte-izle" == i.name || "birlikte-izleyin" == i.name ? ($("body").addClass("full-body"), $("#primary-sidebar").show(), $(".footer").hide()) : ($("#primary-sidebar").show(), $(".footer").show(), $("body").removeClass("full-body"));
                        $().sticky &&
                            $(".ui.sticky").sticky({ context: "#context" }),
                            router.updatePageLinks(),
                            e.init(),
                            (window.currentRequest = !1);
                    })
                    .fail(function () {
                        $("#router-view").html("<h4>404</h4>"),
                            $("#router-view").removeClass("loading"),
                            (window.currentRequest = !1);
                    }));
        };
        e.init(),
            router.on(() => {
                o("_get_home");
            }),
            router.on({
                "film/:slug": (e) => o("_get_movies/" + e.slug),
                "film/:slug/turkce-dublaj-izle": (e) =>
                    o("_get_movies/" + e.slug + "/turkce-dublaj-izle"),
                "film/:slug/turkce-altyazili-izle": (e) =>
                    o("_get_movies/" + e.slug + "/turkce-altyazili-izle"),
                "film/:slug/altyazisiz-izle": (e) =>
                    o("_get_movies/" + e.slug + "/altyazisiz-izle"),
                "dizi/tur/:slug": (e) => o("_get_dizi_tur/" + e.slug),
                "dizi/tur/:slug/:page": (e) =>
                    o("_get_dizi_tur/" + e.slug + "/" + e.page),
                "film/tur/:slug": (e) => o("_get_film_tur/" + e.slug),
                "film/tur/:slug/:page": (e) =>
                    o("_get_film_tur/" + e.slug + "/" + e.page),
                "dizi/:slug": (e) => o("_get_series/" + e.slug),
                "dizi/:slug/sezon-:sezon": (e) =>
                    o("_get_series/" + e.slug + "/sezon-" + e.sezon),
                "dizi/:slug/sezon-:sezon/bolum-:bolum": (e) =>
                    o(
                        "_get_series/" +
                            e.slug +
                            "/sezon-" +
                            e.sezon +
                            "/bolum-" +
                            e.bolum
                    ),
                "dizi/:slug/sezon-:sezon/bolum-:bolum/:sessecenegi": (e) =>
                    o(
                        "_get_series/" +
                            e.slug +
                            "/sezon-" +
                            e.sezon +
                            "/bolum-" +
                            e.bolum +
                            "/" +
                            e.sessecenegi
                    ),
                "profil/:username": (e) => o("_get_profile/" + e.username),
                "profil/ayarlar": () => o("_get_profile/settings"),
                trend: () => o("_get_trending"),
                trends: () => o("_get_trending"),
                takvim: () => o("_get_calendar"),
                "sonra-izle": () => o("_get_watch-after"),
                forum: () => o("_get_forum"),
                forums: () => o("_get_forum"),
                "forum/new": () => o("_get_forum_new"),
                "forum/edit/:forum": (e) => o("_get_forum_edit/" + e.forum),
                "forum/latest": () => o("_get_forum_latest"),
                "forum/favorites": () => o("_get_forum_favorites"),
                "forums/latest": () => o("_get_forum_latest"),
                "forums/favorites": () => o("_get_forum_favorites"),
                "forum/:series": (e) => o("_get_forum/" + e.series),
                "forum/:series/latest": (e) =>
                    o("_get_forum/" + e.series + "/latest"),
                "forum/:series/:slug": (e) =>
                    o("_get_forum/" + e.series + "/" + e.slug),
                "forum/page/:page": (e) => o("_get_forum/page/" + e.slug),
                "konu/:slug": (e) => o("_get_konu/" + e.slug),
                "konu/details/:slug": (e) => o("_get_konu/details/" + e.slug),
                koleksiyon: () => o("_get_collections"),
                koleksiyons: () => o("_get_collections"),
                "koleksiyon/:user/:slug": (e) =>
                    o("_get_collections/" + e.user + "/" + e.slug),
                "koleksiyon/:slug": (e) => o("_get_collections/" + e.slug),
                kesfet: () => o("_get_discover"),
                film: () => o("_get_movies_list"),
                "film-izle": () => o("_get_movies_list"),
                "film-izle/:page": (e) => o("_get_movies_list/" + e.page),
                "film-izle/:slug/:page": (e) =>
                    o("_get_movies_list/" + e.slug + "/" + e.page),
                "dizi-izle": () => o("_get_series_list"),
                "dizi-izle/:page": (e) => o("_get_series_list/" + e.page),
                "kesfet/:filter": (e) => o("_get_discover/" + e.filter),
                "kesfet/:filter/:page": (e) =>
                    o("_get_discover/" + e.filter + "/" + e.page),
                "kesfet/:page": (e) => o("_get_discover/" + e.page),
                "oda/:code": (e) => o("_get_room/" + e.code),
                "birlikte-izle": () => o("_get_birlikte_izle"),
                "birlikte-izleyin": () => o("_get_birlikte_izle"),
                "oyuncu/:slug": (e) => o("_get_artist/" + e.slug),
                vip: () => o("_get_home"),
                vip1: () => o("_get_home"),
                vip2: () => o("_get_home"),
                beta: () => o("_get_home"),
                home: () => o("_get_home"),
            });
    })();
