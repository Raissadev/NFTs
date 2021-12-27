<?php

namespace App\Services;

use Src\Exceptions\AuthException;

class ConnectionFactory
{

    private static string $host = "localhost";
    private static string $database = "nfts";
    private static string $user = "postgres";
    private static string $password = "root";
    private static $sql;

    public static function connect()
    {
        if(self::$sql == null){
            try{
                self::$sql = new \PDO('pgsql:host='.self::$host.';dbname='.self::$database.'',''.self::$user.'',''.self::$password.'',array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$sql->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }catch(Exception $e){
                throw new AuthException("Oops... An error has occurred!");
            }
        }

        return self::$sql;
        
    }

}

?>