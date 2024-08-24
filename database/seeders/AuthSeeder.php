<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AuthSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('authorization_groups')->truncate();
        DB::table('authorization_clauses')->truncate();

        DB::table('authorization_groups')->insert([
            [
                'id' => 1,
                'code' => 1,
                'text'  => 'Admin',
                'description'  => 'Site Yöneticisi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // access.php'deki erişim kodlarını ve url.php'deki URL yapılandırmalarını al
        $accessCodes = Config::get('access.path_access_codes');
        $urlsConfig = include(config_path('url.php'));

        foreach ($accessCodes as $url => $code) {
            // url.php'de same_as_previous kontrolü
            if (isset($urlsConfig['urls'][$url]['same_as_previous']) && $urlsConfig['urls'][$url]['same_as_previous']) {
                // same_as_previous true ise bu URL'yi atla ve devam et
                continue;
            }

            // Metin değerini al
            $text = isset($urlsConfig['urls'][$url]['text']) ? $urlsConfig['urls'][$url]['text'] : null;

            // URL ve kodu veritabanına kaydet
            DB::table('authorization_clauses')->insert([
                'code' => $code,
                'text' => $text,
                'description' => $text,
            ]);
        }
    }
}
