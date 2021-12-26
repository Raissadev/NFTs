<?php

namespace Src\Middlewares\Permissions;

use Src\Middlewares\Permissions\PermissionsVendor;
use Src\Middlewares\Permissions\PermissionsClient;

class PermissionsMiddleware
{

    private string $function;
    const vendor = 'vendor';
    const client = 'client';

    public function __construct()
    {
        if(isset($_SESSION['login']) && strpos($_SERVER['REQUEST_URI'], "sign-in") || isset($_SESSION['login']) && strpos($_SERVER['REQUEST_URI'], "sign-up")){
            header('Location: '.BASE_URL);
        }

        if(isset($_SESSION['type'])){
            $this->function = $_SESSION['type'];
            $this->type();
        } elseif (!isset($_SESSION['vendor']) && strpos($_SERVER['REQUEST_URI'], "dashboard")){
            header("location: ".BASE_URL);
        }
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