<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public $showCount = 10;

    public $successCreateMessage = "Başarılı Bir Şekilde Veri Eklendi";
    public $successUpdateMessage = "Başarılı Bir Şekilde Veri Güncellendi";
    public $successDeleteMessage = "Başarılı Bir Şekilde Veri Silindi";

    public $errorCreateMessage = "Veri Eklenirken Bir Hata Meydana Geldi";
    public $errorsUpdateMessage = "Veri Güncellenirken Bir Hata Meydana Geldi";
    public $errorsDeleteMessage = "Veri Silinirken Bir Hata Meydana Geldi";
}
