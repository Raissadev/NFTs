<?php

namespace Src\Middlewares;
use Src\Helpers\MessageAuth;

class AuthenticatorNFT
{

    public static function verifyImage(array $image)
    {
        $validation = preg_match('/^image\/(pjpeg|jpeg|png|jpg)$/', $image['type']);
        if(!$validation){
            MessageAuth::launchMessage("error", "Invalid image!");
            return false;
        }
        
        return true;
    }

    public static function verifyName(string $name)
    {
        $characters = preg_match("/[\[^\'£$%^&*()}{@:\'#~?><>]]/", (string) $name);
        if($characters || $name == ""){
            MessageAuth::launchMessage("error", "Invalid name!");
            return false;
        }
        
        return true;
    }

    public static function verifyPrice(string $price)
    {
        $characters = preg_match("/[\[^\'£$%^&*()}{@:\'#~?><>]]/", (string) $price);
        if($characters || $price == ""){
            MessageAuth::launchMessage("error", "Invalid price!");
            return false;
        }
        
        return true;
    }


}

?>