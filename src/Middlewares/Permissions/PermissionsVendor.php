<?php

namespace Src\Middlewares\Permissions;

use Src\Middlewares\Permissions\PermissionsURL;

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

        $uri = PermissionsURL::uriNotPermission($uri);
        return $uri;
    }
}
?>

