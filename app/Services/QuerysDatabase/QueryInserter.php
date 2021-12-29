<?php

namespace App\Services\QuerysDatabase;
use App\Services\ConnectionFactory;

class QueryInserter
{

    protected static function schemaSetUser(string $name, string $email, string $password, string $image, string $type): string
    {
        $insert = ConnectionFactory::connect()->prepare("INSERT INTO users (name, email, password, image, type_user) VALUES (?,?,?,?,?)");
        $insert->execute([ $name, $email, $password, $image, $type ]);
        $id = ConnectionFactory::connect()->lastInsertId();
        return $id;
    }

    protected static function schemaLoginUser(string $email, string $password): array
    {
        $user = ConnectionFactory::connect()->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $user->execute([ $email, $password ]);
        $response = $user->fetch(\PDO::FETCH_ASSOC);
        return $response;
    }

    protected static function schemaSetNFT(int $owner, int $shop, string $name, string $description, string $blockchain, string $image, string $price, string $currency, string $crypto, string $cryptoType, int $collection, string $token): string
    {
        $insert = ConnectionFactory::connect()->prepare("INSERT INTO nfts (owner, shop, name, description, blockchain, image, price, currency, crypto_price, crypto_type, collection, token) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $insert->execute([ $owner, $shop, $name, $description, $blockchain, $image, $price, $currency, $crypto, $cryptoType, $collection, $token ]);
        $id = ConnectionFactory::connect()->lastInsertId();
        return $id;
    }

    public static function schemaSetShop(int $owner, string $name, string $banner): void
    {
        $insert = ConnectionFactory::connect()->prepare("INSERT INTO shops_vendors (owner, name, banner) VALUES (?,?,?)");
        $insert->execute([ $owner, $name, $banner ]);
    }

    public static function schemaSetCollection(int $owner, string $name, string $about, string $banner): void
    {
        $insert = ConnectionFactory::connect()->prepare("INSERT INTO collections (owners, name, about, banner) VALUES (?,?,?,?)");
        $insert->execute([ $owner, $name, $about, $banner ]);
    }

    public static function schemaAddNFTtoList(int $user, int $nft): void
    {
        $insert = ConnectionFactory::connect()->prepare("INSERT INTO nfts_purchases (owner, nft) VALUES (?,?)");
        $insert->execute([ $user, $nft ]);
    }

}

?>