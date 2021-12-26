<?php

namespace App\Services\QuerysDatabase;
use App\Services\ConnectionFactory;

class QueryInserter
{

    protected static function schemaSetUser(array $params): string
    {
        $insert = ConnectionFactory::connect()->prepare("INSERT INTO users (name, email, password, image, type_user) VALUES (?,?,?,?,?)");
        $insert->execute( $params );
        $id = ConnectionFactory::connect()->lastInsertId();
        return $id;
    }

    protected static function schemaLoginUser(string $email, string $password): array
    {
        $user = ConnectionFactory::connect()->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $user->execute([ $email, $password ]);
        $launch = $user->fetch(\PDO::FETCH_ASSOC);
        return $launch;
    }

    protected static function schemaSetNFT(int $owner, int $shop, string $name, string $description, string $quantity, string $blockchain, string $image, string $price, string $crypto, string $cryptoType): void
    {
        $insert = ConnectionFactory::connect()->prepare("INSERT INTO nfts (owner, shop, name, description, quantity, blockchain, image, price, price_crypto, crypto_type) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $insert->execute([ $owner, $shop, $name, $description, $quantity, $blockchain, $image, $price, $crypto, $cryptoType ]);
    }

    public static function schemaSetShop(int $owner, string $name, string $banner): void
    {
        $insert = ConnectionFactory::connect()->prepare("INSERT INTO shops_vendors (owner, name, banner) VALUES (?,?,?)");
        $insert->execute([ $owner, $name, $banner ]);
    }

}

?>