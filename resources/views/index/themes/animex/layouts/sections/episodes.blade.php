@php
    //Burası animeDetail, wath kısımlarında ortak bir şekilde bölüm kısmında çağrılır
    $season_count = $season_count ?? 0;
    $show_checkbox = $show_checkbox ?? false;
    $episode_type = $episode_type ?? 'anime';
    $short_name = $short_name ?? '';
@endphp
@if ($season_count > 0)
    <div class="anime__details__episodes">
        <div class="section-title">
            <h5>Episodes</h5>
        </div>
        <!-- Sezon Seçimi -->
        <div class="season-selector">
            @for ($i = 1; $i <= $season_count; $i++)
                <button class="season-btn {{ $i == 1 ? 'active' : '' }}" data-season="{{ $i }}">
                    Sezon {{ $i }}
                </button>
            @endfor
        </div>

        @for ($i = 1; $i <= $season_count; $i++)
            <div class="season-content {{ $i == 1 ? 'active' : '' }}" id="season{{ $i }}">
                <div class="episodes-scroll">
                    <div class="episodes-row">
                        @foreach ($series_episodes->where('season_short', $i) as $item)
                            @php
                                $url = url($episode_type . '/' . $short_name . '/' . $i . '/' . $item->episode_short);
                            @endphp
                            <div class="episode-item {{ count($watched) > 0 && $watched->Where('anime_episode_code', $item->code)->first() ? 'watched' : '' }}"
                                onclick="getEpisode(event, '{{ $url }}')" style="justify-content: center;">
                                <div class="row">
                                    @if ($show_checkbox)
                                        <input type="checkbox" id="watched{{ $item->code }}"
                                            class="episode-checkbox {{ count($watched) > 0 && $watched->Where('anime_episode_code', $item->code)->first() ? '' : '' }}"
                                            onchange="watchAnime('{{ $item->code }}')" value="{{ $item->code }}"
                                            {{ count($watched) > 0 && $watched->Where('anime_episode_code', $item->code)->first() ? 'checked' : '' }}>
                                        <label for="watched{{ $item->code }}" class="watched_label"></label>
                                    @endif

                                    <label>
                                        <span class="episode-number">
                                            {{ $item->episode_short < 10 ? '0' . (string) $item->episode_short : $item->episode_short }}
                                        </span>
                                        {{ $item->name ? $item->name : '' }}
                                    </label>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endfor
    </div>
@else
    <div class="col-lg-12 col-md-12 section-title">
        <h5>Herhangi Bir Bölüm Mevcut Değil.</h5>
    </div>
@endif

<script>
    // Sezon değiştirme işlevselliği
    document.querySelectorAll('.season-btn').forEach(button => {
        button.addEventListener('click', () => {
            // Aktif sezon butonunu güncelle
            document.querySelectorAll('.season-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');

            // Aktif sezon içeriğini göster
            const seasonNumber = button.getAttribute('data-season');
            document.querySelectorAll('.season-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById('season' + seasonNumber).classList.add('active');
        });
    });

    // Yatay kaydırma için dokunmatik ve mouse desteği
    document.querySelectorAll('.episodes-scroll').forEach(scroll => {
        let isDown = false;
        let startX;
        let scrollLeft;
        let autoScrollInterval;
        const scrollSpeed = 5; // Kaydırma hızı
        const threshold = 0.25; // Mouse'un hangi noktadan sonra kaydırmaya başlayacağı (0.25 = %25)

        function startAutoScroll(direction) {
            clearInterval(autoScrollInterval);
            autoScrollInterval = setInterval(() => {
                scroll.scrollLeft += direction * scrollSpeed;
            }, 16); // 60fps için yaklaşık değer
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        // Mouse basılı tutma ile kaydırma
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
                    startAutoScroll(1); // Sağa kaydır
                } else if (position < threshold) {
                    startAutoScroll(-1); // Sola kaydır
                } else {
                    stopAutoScroll();
                }
            }
        });

        // Sayfa scroll'unu engelle
        scroll.addEventListener('wheel', (e) => {
            e.preventDefault();
            scroll.scrollLeft += e.deltaY;
        }, {
            passive: false
        });
    });

    //Bölüme gitme özelliği:
    function getEpisode(event, url) {

        // Eğer tıklama checkbox'tan geliyorsa, işlemi iptal et
        if (
            event.target.tagName === 'INPUT' ||
            (event.target.tagName === 'LABEL' && (
                event.target.classList.value === 'episode-checkbox' ||
                event.target.classList.value === 'watched_label' ||
                event.target.classList.value === 'episode-checkbox watched'
            ))
        ) {
            return;
        }
        window.location.href = url;
    }
</script>
