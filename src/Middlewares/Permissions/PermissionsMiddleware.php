<?php

namespace Src\Middlewares\Permissions;

use Src\Middlewares\Permissions\PermissionsURL;
use Src\Middlewares\Permissions\PermissionsVendor;
use Src\Middlewares\Permissions\PermissionsClient;

class PermissionsMiddleware
{

    private string $function;
    const vendor = 'vendor';
    const client = 'client';

    public function __construct()
    {
        $this->uriGlobal();

        if(isset($_SESSION['type_user'])){
            $this->function = $_SESSION['type_user'];
            $this->type();
        } elseif (isset($_SESSION['type_user']) ? $_SESSION['type_user'] !== "vendor" && strpos($_SERVER['REQUEST_URI'], "dashboard") : ''){
            header("location: ".BASE_URL);
        }
    }

    public function uriGlobal(): array
    {
        if(!isset($_SESSION['login'])){
            $uri = [ "", "sign-in", "sign-up", "home" ];
            $uri = PermissionsURL::uriPermission($uri);
        } else {
            $uri = [ "sign-in", "sign-up" ];
            $uri = PermissionsURL::uriNotPermission($uri);
        }

        return $uri;
    }

    private function type(): void
    {
        if($this->function == self::client){
            new PermissionsClient;
        }
        if($this->function == self::vendor){
            new PermissionsVendor;
        }
    }

}

?>