<?=
'<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<rss version="2.0">
    <channel>
        <title>
            <![CDATA[ https://anikagai.com/ ]]>
        </title>
        <link>
        <![CDATA[ https://anikagai.com/feed/ ]]>
        </link>
        <description>
            <![CDATA[ {{ $des->optional ?? '' }} ]]>
        </description>
        <language>tr</language>
        <pubDate>{{ now() }}</pubDate>
        @isset($webtoon_episodes)
            @foreach ($webtoon_episodes as $item)
                <item>
                    <title>
                        <![CDATA[{{ $item->webtoon_name }}]]>
                    </title>
                    <link>
                    {{ url('webtoon/' . $item->webtoon_short_name . '/' . $item->season_short . '/' . $item->episode_short) }}
                    </link>
                    <description>
                        <![CDATA[{{ $item->webtoon_name . ' Webtoon: ' . $item->season_short . '.Sezon ' . $item->episode_short . '.Bölüm ' . $item->name . ' Oku' }}]]>
                    </description>
                    <author>
                        <![CDATA[Anikagai]]>
                    </author>
                    <guid>{{ $item->id }}</guid>
                    <pubDate>{{ $item->created_at }}</pubDate>
                </item>
            @endforeach
        @endisset
        @isset($anime_episodes)
            @foreach ($anime_episodes as $item)
                <item>
                    <title>
                        <![CDATA[{{ $item->anime_name }}]]>
                    </title>
                    <link>
                    {{ url('anime/' . $item->anime_short_name . '/' . $item->season_short . '/' . $item->episode_short) }}
                    </link>
                    <description>
                        <![CDATA[{{ $item->anime_name . ' Anime: ' . $item->season_short . '.Sezon ' . $item->episode_short . '.Bölüm ' . $item->name . ' İzle' }}]]>
                    </description>
                    <author>
                        <![CDATA[Anikagai]]>
                    </author>
                    <guid>{{ $item->code }}</guid>
                    <pubDate>{{ $item->created_at }}</pubDate>
                </item>
            @endforeach
        @endisset

    </channel>
</rss>
