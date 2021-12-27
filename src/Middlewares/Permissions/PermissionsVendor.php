<?php

namespace Src\Middlewares\Permissions;

final class PermissionsVendor
{
    public function __construct()
    {
        $this->uri();
    }
    
    public function uri(): array
    {
        $uri = [
            "profile"
        ];

        $currentUri = preg_split('/\//', $_SERVER['REQUEST_URI']);
        if(in_array($currentUri[1], $uri)) {
            die('You do not have permission');
        }

        return $uri;
    }
}
?>

