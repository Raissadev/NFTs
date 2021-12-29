<?php

namespace Src\Middlewares\Permissions;

final class PermissionsClient
{
    public function __construct()
    {
        $this->uri();
    }
    
    public function uri(): array
    {
        $uri = [
            "dashboard",
            "register-nft",
            "register-shop"
        ];

        $uri = PermissionsURL::uriNotPermission($uri);
        return $uri;
    }
}
?>