<?php

namespace Src\Middlewares\Permissions;

use Src\Helpers\MessageAuth;

final class PermissionsURL
{
    
    public static function uriPermission(array $uri): array
    {
        $currentUri = preg_split('/\//', $_SERVER['REQUEST_URI']);
        if(!in_array($currentUri[1], $uri)) {
            MessageAuth::launchMessage("error", "You do not have permissions to access this page!");
            header('Location: '.BASE_URL);
        }

        return $uri;
    }

    public static function uriNotPermission(array $uri): array
    {
        $currentUri = preg_split('/\//', $_SERVER['REQUEST_URI']);
        if(in_array($currentUri[1], $uri)) {
            MessageAuth::launchMessage("error", "You do not have permissions to access this page!");
            header('Location: '.BASE_URL);
        }

        return $uri;
    }

}
?>

