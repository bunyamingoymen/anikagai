<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Models\AnimeEpisode;
use App\Models\KeyValue;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

use App\Models\Post;
use App\Models\Webtoon;
use App\Models\WebtoonEpisode;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $keyValue = KeyValue::Where('key', 'sitemap_auto')->first();

        if (!$keyValue) {
            $keyValue = new KeyValue();
            $keyValue->code = KeyValue::max('code') + 1;
            $keyValue->key = "sitemap_auto";
        }
        $keyValue->value = Carbon::now();
        $keyValue->save();

        $sitemap = Sitemap::create();

        $webtoons = Webtoon::where('deleted', 0)->get();
        $animes = Anime::where('deleted', 0)->get();
        foreach ($webtoons as $webtoon) {
            $sitemap->add(route('webtoonDetail', ['short_name' => $webtoon->short_name]), $webtoon->created_at);
            foreach (WebtoonEpisode::where('deleted', 0)->Where('webtoon_code', $webtoon->code)->get() as $episode) {
                $sitemap->add(route('read', ['short_name' => $webtoon->short_name, 'season' => $episode->season_short, 'episode' => $episode->episode_short]), $episode->created_at);
            }
        }

        foreach ($animes as $anime) {
            $sitemap->add(route('animeDetail', ['short_name' => $anime->short_name]), $anime->created_at);
            foreach (AnimeEpisode::where('deleted', 0)->Where('anime_code', $anime->code)->get() as $episode) {
                $sitemap->add(route('read', ['short_name' => $anime->short_name, 'season' => $episode->season_short, 'episode' => $episode->episode_short]), $episode->created_at);
            }
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $keyValue2 = KeyValue::Where('key', 'sitemap_auto_alt')->first();

        if (!$keyValue2) {
            $keyValue2 = new KeyValue();
            $keyValue2->code = KeyValue::max('code') + 1;
            $keyValue2->key = "sitemap_auto_alt";
        }
        $keyValue2->value = Carbon::now();
        $keyValue2->save();
    }
}
