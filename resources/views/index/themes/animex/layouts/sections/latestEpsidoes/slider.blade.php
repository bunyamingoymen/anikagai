    <!-- Latest Episodes Section Begin -->

    <div class="mobile-scroll">
        <div class="row">
            @foreach ($latestEpisodes as $episode)
                <!--img/latest/latest-1.jpg-->
                @php
                    $image_url = null;
                    if ($episode->series_thumb_poster) {
                        $image_url = $episode->series_thumb_poster;
                    } elseif ($episode->series_poster) {
                        $image_url = $episode->series_poster;
                    } elseif ($episode->series_thumb_image) {
                        $image_url = $episode->series_thumb_image;
                    } elseif ($episode->series_image) {
                        $image_url = $episode->series_image;
                    }
                    $image_url = url($image_url);

                    $series_url = url(
                        $episode->type .
                            '/' .
                            $episode->series_short_name .
                            '/' .
                            $episode->epsiode_season_short .
                            '/' .
                            $episode->epsiode_episode_short,
                    );
                @endphp
                <div class="latest-episode__item">
                    <div class="latest-episode__item__pic set-bg" data-setbg="{{ $image_url ?? '' }}">
                        <div class="ep">{{ $episode->epsiode_episode_short }}.Bölüm</div>
                        <div class="view"><i class="fa fa-eye"></i> {{ $episode->epsiode_click_count }}</div>
                    </div>
                    <div class="latest-episode__item__text">
                        <h5><a href="{{ $series_url }}">{{ $episode->series_name }}: {{ $episode->epsiode_name }}</a>
                        </h5>
                        <div class="rating">{{ $episode->epsiode_season_short }}. Sezon</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Latest Episodes Section End -->

    <script>
        // Latest Episodes kaydırma işlevselliği
        document.querySelectorAll('.mobile-scroll').forEach(scroll => {
            let isDown = false;
            let startX;
            let scrollLeft;
            let autoScrollInterval;
            const scrollSpeed = 5;
            const threshold = 0.25;

            function startAutoScroll(direction) {
                clearInterval(autoScrollInterval);
                autoScrollInterval = setInterval(() => {
                    scroll.scrollLeft += direction * scrollSpeed;
                }, 16);
            }

            function stopAutoScroll() {
                clearInterval(autoScrollInterval);
            }

            scroll.addEventListener('mousedown', (e) => {
                isDown = true;
                scroll.style.cursor = 'grabbing';
                startX = e.pageX - scroll.offsetLeft;
                scrollLeft = scroll.scrollLeft;
                stopAutoScroll();
            });

            scroll.addEventListener('mouseleave', () => {
                isDown = false;
                scroll.style.cursor = 'grab';
                stopAutoScroll();
            });

            scroll.addEventListener('mouseup', () => {
                isDown = false;
                scroll.style.cursor = 'grab';
            });

            scroll.addEventListener('mousemove', (e) => {
                if (isDown) {
                    e.preventDefault();
                    const x = e.pageX - scroll.offsetLeft;
                    const walk = (x - startX) * 2;
                    scroll.scrollLeft = scrollLeft - walk;
                } else {
                    const rect = scroll.getBoundingClientRect();
                    const mouseX = e.clientX - rect.left;
                    const containerWidth = rect.width;
                    const position = mouseX / containerWidth;

                    if (position > (1 - threshold)) {
                        startAutoScroll(1);
                    } else if (position < threshold) {
                        startAutoScroll(-1);
                    } else {
                        stopAutoScroll();
                    }
                }
            });

            scroll.addEventListener('wheel', (e) => {
                e.preventDefault();
                scroll.scrollLeft += e.deltaY;
            }, {
                passive: false
            });
        });

        // set-bg özelliği için

        document.querySelectorAll('.set-bg').forEach(element => {
            const bg = element.getAttribute('data-setbg');
            element.style.backgroundImage = `url(${bg})`;
            element.style.backgroundSize = 'cover';
            element.style.backgroundPosition = 'center center';
        });
    </script>
