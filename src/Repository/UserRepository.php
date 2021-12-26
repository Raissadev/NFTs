<?php

namespace Src\Repository;
use App\Services\ConnectionFactory;

class UserRepository
{

    private string $table = 'users';

    public static function schemaGetTypeUser(int $user): array
    {
        $type = ConnectionFactory::connect()->prepare("SELECT (type_user) FROM users WHERE id = $user");
        $type->execute();
        $launch = $type->fetch(\PDO::FETCH_ASSOC);
        return $launch;
    }

    protected static function schemaFetchBlockchain(int $user): array
    {
        $blockchain = ConnectionFactory::connect()->prepare("SELECT (blockchain), (blockchain_password) FROM users WHERE id = $user");
        $blockchain->execute();
        $launchBlockchain = $blockchain->fetch(\PDO::FETCH_ASSOC);
        return $launchBlockchain;
    }

    public static function schemaGetAllUsers($query): array
    {
        $user = ConnectionFactory::connect()->prepare("SELECT * FROM users $query");
        $user->execute();
        $launch = $user->fetchAll(\PDO::FETCH_ASSOC);
        return $launch;
    }


}


?>