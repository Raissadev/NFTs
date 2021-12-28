<?php

namespace App\Services\QuerysDatabase;
use App\Services\ConnectionFactory;

class QuerySeter
{

    public static function schemaUpdateType(int $user): void
    {
        $type = ConnectionFactory::connect()->prepare("UPDATE users SET type_user = ? WHERE id = $user");
        $type->execute([ "vendor" ]);
    }

    public static function schemaUpdateUser(int $user, string $name, string $email, string $image): array
    {
        $user = ConnectionFactory::connect()->prepare("UPDATE users SET name = ?, email = ?, image = ? WHERE id = $user");
        $user->execute([ $name, $email, $image ]);
        $launch = $user->fetch(\PDO::FETCH_ASSOC);
        return $launch;
    }

    public static function schemaUpdateNFT(int $nft, int $owner, int $shop, string $name, string $description, string $blockchain, string $price, string $currency, string $crypto, string $cryptoType): void
    {
        $update = ConnectionFactory::connect()->prepare("UPDATE nfts SET shop = ?, name = ?, description = ?, blockchain = ?, price = ?, currency = ?, crypto_price = ?, crypto_type = ? WHERE id = $nft AND owner = $owner");
        $update->execute([ $shop, $name, $description, $blockchain, $price, $currency, $crypto, $cryptoType ]);
    }

    public static function schemaCreateBlockchain(int $user, string $blockchain, string $blockchainPassword): void
    {
        $insert = ConnectionFactory::connect()->prepare("UPDATE users SET blockchain = ?, blockchain_password = ? WHERE id = $user");
        $insert->execute([ $blockchain, $blockchainPassword ]);
    }

    
}

?>