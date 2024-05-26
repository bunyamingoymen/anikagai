<body>
    <!-- Video Player Container -->
    <video id="anime-video-player-url" class="plyr video_size_class" controls crossorigin playsinline
        poster="{{ url($anime->thumb_image) }}">
        Your browser does not support the video tag.
    </video>

    <!-- Plyr JS -->
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('anime-video-player-url');

            if (Hls.isSupported()) {
                const hls = new Hls();
                hls.loadSource('{{ asset('storage / ' . $episode->video) }}');
                hls.attachMedia(video);
                hls.on(Hls.Events.MANIFEST_PARSED, () => {
                    const player = new Plyr(video, {
                        controls: controls,
                        settings: settings,
                        tooltips: tooltips,
                        storage: {
                            enabled: true,
                            key: 'plyr_{{ $episode->code }}'
                        },
                        seekTime: 10, // Sets the seek time to 10 seconds
                        quality: {
                            default: 576,
                            options: hls.levels.map(level => level.height),
                            forced: true, // force the quality settings to be shown
                            onChange: (quality) => {
                                hls.levels.forEach((level, levelIndex) => {
                                    if (level.height === quality) {
                                        hls.currentLevel = levelIndex;
                                    }
                                });
                            }
                        }
                    });

                    hls.on(Hls.Events.LEVEL_SWITCHED, (event, data) => {
                        const quality = hls.levels[data.level].height;
                        player.quality = quality;
                    });

                    // Diğer Plyr yapılandırma kodlarınız buraya gelecek...

                    // Rewind ve fast-forward butonlarının ikonlarını değiştirme
                    document.querySelector('.plyr__controls__item[data-plyr="rewind"]').innerHTML =
                        '<i class="fas fa-undo-alt"></i>';
                    document.querySelector('.plyr__controls__item[data-plyr="fast-forward"]').innerHTML =
                        '<i class="fas fa-redo-alt"></i>';

                    //sayfa tamamen yüklendiğinde
                    $(document).ready(function() {
                        // Butonlara tıklandığında
                        var introButton = document.getElementById('introButton');

                        //introButton tuşu varsa ve ona basılırsa
                        if (introButton) {
                            introButton.addEventListener('click', function() {
                                player.currentTime = endIntroButtonTime;
                            });
                        }

                        //bir sonraki bölüm varsa ve ona basılırsa
                        @if ($next_episode_url != 'none')
                            var nextEpisodeButton = document.getElementById('nextEpisodeButton');
                            if (nextEpisodeButton) {
                                nextEpisodeButton.addEventListener('click', function() {
                                    // Belirlediğiniz linke git
                                    window.location.href =
                                        '{{ url($next_episode_url) }}'; // bir sonraki bölüm URL'i
                                });
                            }
                        @endif
                    });

                    // Video başlatıldığında / durdurulup-başlatıldığında
                    player.on('play', function() {
                        showNextEpisodeButtonTime = player.duration - 60;
                    });

                    // Video oynatılırken
                    player.on('timeupdate', function(event) {
                        var currentTime = event.detail.plyr
                            .currentTime; // Geçerli video zamanını al

                        // İntro başlangıç zamanı ile bitiş zamanı arasında ise ve daha önce intro butonu gözükmediyse
                        if ((currentTime >= showIntroButtonTime && currentTime <=
                                endIntroButtonTime) && !is_show_intro_button) {
                            // İntroyu atla butonunu göster
                            showButton('introButton');
                            is_show_intro_button = true;

                            // Intro Atla butonunun aktif olduğunu göstermek için kontrolü gösteriyoruz ve 3 saniye sonra gizliyoruz.
                            document.getElementsByClassName('plyr--video')[0].classList.remove(
                                'plyr--hide-controls');
                            controlsTimeout = setTimeout(() => {
                                document.getElementsByClassName('plyr--video')[0].classList
                                    .add('plyr--hide-controls');
                            }, 3000); // 3000 milisaniye (3 saniye) sonra gizle
                        }

                        // Intro Atla butonu daha önce gizlenmediyse ve şu anki zaman intro atla zamanını geçtiyse butonu gizler
                        if (currentTime > endIntroButtonTime && !is_hide_intro_button) {
                            // İntroyu atla butonunu gizle
                            hideButton('introButton');
                            is_hide_intro_button = true;
                        }

                        // Bir sonraki bölüm varsa son saniyeler buton gözükür.
                        // Video son 10 saniyesinde ve daha önce sonraki bölüme geç butonu gösterilmediyse
                        if (showNextEpisodeButtonTime !== null && showNextEpisodeButtonTime <=
                            currentTime && !is_show_next_episode_button) {
                            showButton('nextEpisodeButton');
                            // Eğer Kullanıcı girişi yapmışsa otomatik olarak izlendi olarak işaretleniyor
                            @if (Auth::user() && count($watched->Where('anime_episode_code', $episode->code)) == 0)
                                watchAnime("{{ $episode->code }}");
                            @endif

                            @if ($next_episode_url != 'none')
                                is_show_next_episode_button = true;
                                // Sonraki Bölüme Atla butonunun aktif olduğunu göstermek için kontrolü gösteriyoruz ve 3 saniye sonra gizliyoruz.
                                document.getElementsByClassName('plyr--video')[0].classList.remove(
                                    'plyr--hide-controls');
                                controlsTimeout = setTimeout(() => {
                                    document.getElementsByClassName('plyr--video')[0]
                                        .classList.add('plyr--hide-controls');
                                }, 3000); // 3000 milisaniye (3 saniye) sonra gizle
                            @endif
                        }
                    });

                    // Video tam ekran butonuna basıldığında
                    player.on('fullscreenchange', (event) => {
                        if (isFullScreen) {
                            // Tam ekrandan çıkıyor
                            isFullScreen = false;
                            document.getElementById('anime-video-player-url').classList.add(
                                'video_size_class');
                        } else {
                            // Tam ekrana giriyor
                            isFullScreen = true;
                            document.getElementById('anime-video-player-url').classList.remove(
                                'video_size_class');
                        }
                    });

                    // Video yeniden başlatıldığında
                    player.on('restart', function() {
                        // Video yeniden başlatılırsa introyu atla ve sonraki bölüme atla değerleri sıfırlanması gerekmektedir.
                        is_show_intro_button = false;
                        is_hide_intro_button = false;
                        is_show_next_episode_button = false;

                        hideButton('introButton');
                        @if ($next_episode_url != 'none')
                            hideButton('nextEpisodeButton');
                        @endif
                    });

                    // Butonu göster
                    function showButton(buttonId) {
                        var button = document.getElementById(buttonId);
                        if (button) {
                            opacity = 0;
                            count = 0;
                            button.hidden = false;
                            button.style.display = "block";
                            var old_opacity = button.style.opacity;
                            if (old_opacity == 0) {
                                var animationInterval = setInterval(function() {
                                    if (count < 8) {
                                        count++;
                                        button.style.display = 'block';
                                        opacity += 0.1;
                                        button.style.opacity = opacity;
                                    } else {
                                        clearInterval(animationInterval);
                                    }
                                }, 10);
                            }
                        }
                    }

                    // Butonu gizle
                    function hideButton(buttonId) {
                        var button = document.getElementById(buttonId);
                        if (button) {
                            button.hidden = true;
                            button.style.display = "none";
                            button.opacity = 0;
                        }
                    }
                });
            } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                // HLS desteklenmiyorsa ve Safari gibi HLS desteği olan bir tarayıcı kullanılıyorsa
                video.src = '{{ asset('storage / ' . $episode->video) }}';
                video.addEventListener('loadedmetadata', () => {
                    const player = new Plyr(video, {
                        controls: controls,
                        settings: settings,
                        tooltips: tooltips,
                        storage: {
                            enabled: true,
                            key: 'plyr_{{ $episode->code }}'
                        },
                        seekTime: 10, // Sets the seek time to 10 seconds
                        quality: {
                            default: 576,
                            options: [432, 576, 720, 1080],
                            forced: true, // force the quality settings to be shown
                            onChange: (quality) => {
                                // Logic for changing quality can be added here for native HLS support
                            }
                        }
                    });
                });
            }
        });
    </script>
</body>
