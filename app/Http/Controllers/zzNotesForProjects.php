<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class zzNotesForProjects extends Controller
{
    //Burası bu proje için notları aldığım kısımdır.
    /****
     * Uyguulamayı geliştirici moduna almak için :
    Bu sistemin çalışma sebebi proje aktif iken, yani  bir hosta yüklü iken; güncelleme işlemi yapmak için geliştirici moduan alırsın. Kullanıcıya site yapım aşamasında diye bir ekrana yönlendirirsin
    Bunun için ya php artisan down yaz. Geliştiriciden çıkmak için php artisan up yaz. Bu storage/framework/ klasörü altında down ve maintenance.php dosyası oluşturuluyor.
    Ben bu oluşturulan dosyaları silmek yerine adlarını değiştirdim. Çünkü cpanelde kod yazma yetkisi yok.
    down_old.json dosyasının adını down yap, maintenance_old.json dosyasının adını maintenance.php olarak ayarla


    *
     */
}
