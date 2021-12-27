<?php

namespace Src\Middlewares;

use Src\Helpers\MessageAuth;
use Src\Exceptions\AuthException;

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
            throw new AuthException("Malicious techniques were detected! Go hack another asshole!");
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