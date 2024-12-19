<div class="episodes-grid">
    @foreach ($latestEpisodes as $episode)
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
        @endphp
        <div class="latest-episode__item">
            <div class="latest-episode__item__pic set-bg" data-setbg="{{ $image_url ?? '' }}">
                <div class="ep">{{ $episode->epsiode_episode_short }}.Bölüm</div>
                <div class="view"><i class="fa fa-eye"></i> {{ $episode->epsiode_click_count }}</div>
            </div>
            <div class="latest-episode__item__text">
                <h5><a href="#">{{ $episode->series_name }}: {{ $episode->epsiode_name }}</a></h5>
                <div class="rating">{{ $episode->epsiode_season_short }}. Sezon</div>
            </div>
        </div>
    @endforeach
</div>

<script>
    // set-bg özelliği için

    document.querySelectorAll('.set-bg').forEach(element => {
        const bg = element.getAttribute('data-setbg');
        element.style.backgroundImage = `url(${bg})`;
        element.style.backgroundSize = 'cover';
        element.style.backgroundPosition = 'center center';
    });
</script>
