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
            "my-nfts",
            "my-nft",
            "register-shop"
        ];

        $currentUri = preg_split('/\//', $_SERVER['REQUEST_URI']);
        if(in_array($currentUri[1], $uri)) {
            die('You do not have permission');
        }

        return $uri;
    }
}
?>