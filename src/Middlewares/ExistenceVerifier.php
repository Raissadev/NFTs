<?php

namespace Src\Middlewares;

use Src\Helpers\MessageAuth;
use Src\Repository\UserRepository;
use Src\Repository\NFTRepository;

class ExistenceVerifier
{

    public static function emailExists(string $email): bool
    {
        $email = UserRepository::schemaGetAllEmails( (string) $email );
        if($email){
            MessageAuth::launchMessage("error", "User already exists!");
            return true;
        }

        return false;
    }

    public static function nameNFTExists(string $name): bool
    {
        $name = NFTRepository::schemaGetAllNamesNFTs( (string) $name );
        if($name){
            MessageAuth::launchMessage("error", "Name nft already exists!");
            return true;
        }

        return false;
    }


}

?>