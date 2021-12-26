<?php

namespace App\Services;

class MainView
{

    public static function render($filename, $params = [], $header = 'public/Views/theme/header.php', $footer = 'public/Views/theme/footer.php'): void
    {
        require "$header";
        require "public/Views/$filename.php";
        require "$footer";
        die();
    }

    public static function simpleRender($filename, $params = [], $header = 'public/Views/theme/header-auth.php'): void
    {
        require "$header";
        require "public/Views/$filename.php";
        die();
    }

    public static function dashboard($filename, $params = [], $header = 'public/Views/dashboard/theme/header.php', $aside = 'public/Views/dashboard/theme/aside.php'): void
    {
        require "$header";
        require "public/Views/dashboard/$filename.php";
        require "$aside";
        die();
    }

}

?>