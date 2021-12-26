<?php

namespace Src\Repository;
use App\Services\ConnectionFactory;

class UserRepository
{

    private string $table = 'users';

    protected static function schemaLoginUser(string $email, string $password): array
    {
        $user = ConnectionFactory::connect()->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $user->execute([ $email, $password ]);
        $launch = $user->fetch(\PDO::FETCH_ASSOC);
        return $launch;
    }

    protected static function schemaRegisterUser(string $name, string $email, string $password, string $image, string $type): string
    {
        $insert = ConnectionFactory::connect()->prepare("INSERT INTO users (name, email, password, image, type_user) VALUES (?,?,?,?,?)");
        $insert->execute([ $name, $email, $password, $image, $type ]);
        $id = ConnectionFactory::connect()->lastInsertId();
        return $id;
    }

    protected static function schemaUpdateUser(int $user, string $name, string $email, string $image): array
    {
        $user = ConnectionFactory::connect()->prepare("UPDATE users SET name = ?, email = ?, image = ? WHERE id = $user");
        $user->execute([ $name, $email, $image ]);
        $launch = $user->fetch(\PDO::FETCH_ASSOC);
        return $launch;
    }

    public static function schemaUpdateType(int $user): void
    {
        $type = ConnectionFactory::connect()->prepare("UPDATE users SET type_user = ? WHERE id = $user");
        $type->execute([ "vendor" ]);
    }

    public static function schemaGetTypeUser(int $user): array
    {
        $type = ConnectionFactory::connect()->prepare("SELECT (type_user) FROM users WHERE id = $user");
        $type->execute();
        $launch = $type->fetch(\PDO::FETCH_ASSOC);
        return $launch;
    }

    protected static function schemaCreateBlockchain(int $user, string $blockchain, string $blockchainPassword): void
    {
        $insert = ConnectionFactory::connect()->prepare("UPDATE users SET blockchain = ?, blockchain_password = ? WHERE id = $user");
        $insert->execute([ $blockchain, $blockchainPassword ]);
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

    public static function schemaGetOwner(int $id): array
    {
        $user = ConnectionFactory::connect()->prepare("SELECT * FROM users WHERE id = $id");
        $user->execute();
        $launch = $user->fetch(\PDO::FETCH_ASSOC);
        return $launch;
    }

}


?>