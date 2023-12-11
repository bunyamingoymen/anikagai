//Grafik Gösterimleri için gereken değişken
var options = {
    chart: {
        height: 346,
        type: "line",
        zoom: { enabled: !1 },
        toolbar: { show: !1 },
    },
    dataLabels: { enabled: !1 },
    stroke: { width: 3, curve: "smooth", dashArray: [0, 8] },
    series: [
        {
            name: "İzleme",
            data: okumaData,
        },
        {
            name: "Okuma",
            type: "area",
            data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35],
        },
    ],
    colors: ["#3d8ef8", "#11c46e"],
    fill: { opacity: [1, 0.15] },
    markers: { size: 0, hover: { sizeOffset: 6 } },
    xaxis: {
        categories: [
            "Oca",
            "Şub",
            "Mar",
            "Nis",
            "May",
            "Haz",
            "Tem",
            "Ağu",
            "Eyl",
            "Eki",
            "Kas",
            "Ara",
        ],
    },
    grid: { borderColor: "#f1f1f1" },
};

//Ana Grafik Gösterim
(chart = new ApexCharts(
    document.querySelector("#revenue-chart"),
    options
)).render(),
    $(".slider-for").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: !1,
        autoplay: !0,
        asNavFor: ".slider-nav",
    }),
    $(".slider-nav").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: ".slider-for",
        arrows: !1,
        dots: !1,
        centerMode: !0,
        focusOnSelect: !0,
        responsive: [
            {
                breakpoint: 1680,
                settings: { slidesToShow: 2, slidesToScroll: 2 },
            },
            {
                breakpoint: 1440,
                settings: { slidesToShow: 1, slidesToScroll: 1 },
            },
            {
                breakpoint: 1200,
                settings: { slidesToShow: 3, slidesToScroll: 3 },
            },
            {
                breakpoint: 600,
                settings: { slidesToShow: 2, slidesToScroll: 2 },
            },
            {
                breakpoint: 480,
                settings: { slidesToShow: 1, slidesToScroll: 1 },
            },
        ],
    });

//Günlük Gösterim
options = {
    chart: { height: 250, type: "radialBar", offsetY: -20 },
    plotOptions: {
        radialBar: {
            startAngle: -135,
            endAngle: 135,
            hollow: { size: "72%" },
            dataLabels: {
                name: { offsetY: -15 },
                value: {
                    offsetY: 12,
                    fontSize: "18px",
                    color: void 0,
                    formatter: function (e) {
                        return e + "%";
                    },
                },
            },
        },
    },
    colors: ["#3d8ef8"],
    fill: {
        type: "gradient",
        gradient: {
            shade: "dark",
            shadeIntensity: 0.15,
            inverseColors: !1,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 65, 91],
        },
    },
    series: [67],
    labels: ["Day"],
};
(chart = new ApexCharts(
    document.querySelector("#earning-day-chart"),
    options
)).render();

//Haftalık Gösterim
options = {
    chart: { height: 250, type: "radialBar", offsetY: -20 },
    plotOptions: {
        radialBar: {
            startAngle: -135,
            endAngle: 135,
            hollow: { size: "72%" },
            dataLabels: {
                name: { offsetY: -15 },
                value: {
                    offsetY: 12,
                    fontSize: "18px",
                    color: void 0,
                    formatter: function (e) {
                        return e + "%";
                    },
                },
            },
        },
    },
    colors: ["#11c46e"],
    fill: {
        type: "gradient",
        gradient: {
            shade: "dark",
            shadeIntensity: 0.15,
            inverseColors: !1,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 65, 91],
        },
    },
    series: [72],
    labels: ["Week"],
};
(chart = new ApexCharts(
    document.querySelector("#earning-weekly-chart"),
    options
)).render();

//Aylık Gösterim
options = {
    chart: { height: 250, type: "radialBar", offsetY: -20 },
    plotOptions: {
        radialBar: {
            startAngle: -135,
            endAngle: 135,
            hollow: { size: "72%" },
            dataLabels: {
                name: { offsetY: -15 },
                value: {
                    offsetY: 12,
                    fontSize: "18px",
                    color: void 0,
                    formatter: function (e) {
                        return e + "%";
                    },
                },
            },
        },
    },
    colors: ["#f1b44c"],
    fill: {
        type: "gradient",
        gradient: {
            shade: "dark",
            shadeIntensity: 0.15,
            inverseColors: !1,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 65, 91],
        },
    },
    series: [83],
    labels: ["Month"],
};
(chart = new ApexCharts(
    document.querySelector("#earning-monthly-chart"),
    options
)).render();

//Yıllık Gösterim
options = {
    chart: { height: 250, type: "radialBar", offsetY: -20 },
    plotOptions: {
        radialBar: {
            startAngle: -135,
            endAngle: 135,
            hollow: { size: "72%" },
            dataLabels: {
                name: { offsetY: -15 },
                value: {
                    offsetY: 12,
                    fontSize: "18px",
                    color: void 0,
                    formatter: function (e) {
                        return e + "%";
                    },
                },
            },
        },
    },
    colors: ["#fb4d53"],
    fill: {
        type: "gradient",
        gradient: {
            shade: "dark",
            shadeIntensity: 0.15,
            inverseColors: !1,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 65, 91],
        },
    },
    series: [95],
    labels: ["Year"],
};
(chart = new ApexCharts(
    document.querySelector("#earning-yearly-chart"),
    options
)).render();
