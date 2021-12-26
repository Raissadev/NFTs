<?php

namespace Src\Middlewares;
use Src\Helpers\MessageAuth;

class AuthenticatorMiddleware
{

    private static array $message;

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

    public static function verifyEmail(string $email)
    {
        $validation = filter_var($email, FILTER_VALIDATE_EMAIL);
        if(!$validation || $email == ""){
            MessageAuth::launchMessage("error", "Invalid email!");
            return false;
        }

        return true;
    }

    public static function verifyPassword(string $password)
    {
        $strongPassword = filter_var($password, FILTER_VALIDATE_REGEXP, 
            array( "options" => array("regexp"=>"/^(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d]{8,}$/")
        ));
        if($strongPassword || $password == ""){
            MessageAuth::launchMessage("error", "Weak password! Enter at least one capital letter, numbers and a special character.");
            return false;
        }

        return true;
    }

}

?>