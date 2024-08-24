<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UrlConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        // 'config' servisini yeniden tanımlamak yerine, mevcut yapılandırmaya erişip değişiklik yapıyoruz
        $this->mergeConfig();
    }

    public function boot()
    {
        //
    }

    protected function mergeConfig()
    {
        // url.php yapılandırma dosyasını okuyup mevcut config'e ekliyoruz
        $urlsConfig = include(config_path('url.php'));

        $accessCodes = [];
        $currentCounters = [];

        foreach ($urlsConfig['groups'] as $group) {
            $currentCounters[$group['id']] = $group['start'];
        }

        foreach ($urlsConfig['urls'] as $url => $info) {
            $groupId = $info['group'];
            if (isset($info['same_as_previous']) && $info['same_as_previous']) {
                $accessCodes[$url] = end($accessCodes); // Önceki değeri kullan
            } else {
                $accessCodes[$url] = $currentCounters[$groupId]++;
            }
        }

        // Mevcut 'access.path_access_codes' yapılandırmasına erişip üzerine yazıyoruz
        config(['access.path_access_codes' => $accessCodes]);
    }
}
