<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Models\KeyValue;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

use App\Models\Post;
use App\Models\Webtoon;
use App\Models\WebtoonEpisode;

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
        $sitemap = Sitemap::create();

        $webtoons = Webtoon::all();
        Anime::All();
        foreach ($webtoons as $webtoon) {
            $sitemap->add(route('webtoonDetail', ['short_name' => $webtoon->short_name]), $webtoon->created_at);
            foreach (WebtoonEpisode::Where('webtoon_code', $webtoon->code)->get() as $episode) {
                $sitemap->add(route('read', ['short_name' => $webtoon->short_name, 'season' => $episode->season_short, 'episode' => $episode->episode_short]), $episode->created_at);
            }
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $keyValue = KeyValue::Where('key', 'test_sitemap')->first();
        if (!$keyValue) {
            $keyValue = new KeyValue();
            $keyValue->code = KeyValue::max('code') + 1;
            $keyValue->key = "test_sitemap";
            $keyValue->value = 1;
            $keyValue->save();
        } else {
            $keyValue->value = $keyValue->value + 1;
            $keyValue->save();
        }
    }
}
