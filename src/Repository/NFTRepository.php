<?php

namespace Src\Repository;

use App\Services\ConnectionFactory;

class NFTRepository
{

    private string $table = 'nfts';

    protected static function schemaRegisterNFT(int $owner, int $shop, string $name, string $description, string $quantity, string $blockchain, string $image, string $price, string $crypto, string $cryptoType): void
    {
        $insert = ConnectionFactory::connect()->prepare("INSERT INTO nfts (owner, shop, name, description, quantity, blockchain, image, price, price_crypto, crypto_type) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $insert->execute([ $owner, $shop, $name, $description, $quantity, $blockchain, $image, $price, $crypto, $cryptoType ]);
    }

    protected static function schemaUpdateNFT(int $nft, int $owner, int $shop, string $name, string $description, string $quantity, string $blockchain, string $price, string $crypto, string $cryptoType): void
    {
        $update = ConnectionFactory::connect()->prepare("UPDATE nfts SET shop = ?, name = ?, description = ?, quantity = ?, blockchain = ?, price = ?, price_crypto = ?, crypto_type = ? WHERE id = $nft AND owner = $owner");
        $update->execute([ $shop, $name, $description, $quantity, $blockchain, $price, $crypto, $cryptoType ]);
    }

    protected static function schemaFetchNfts($query): array
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM nfts $query");
        $fetch->execute();
        $response = $fetch->fetchAll();
        return $response;
    }

    protected static function schemaGetMyNFTS(int $id): array 
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM nfts WHERE owner = $id");
        $fetch->execute();
        $response = $fetch->fetchAll();
        return $response;
    }

    protected static function schemaGetMyNFT(int $id, int $owner): array 
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM nfts WHERE id = $id AND owner = $owner");
        $fetch->execute();
        $response = $fetch->fetch();
        return $response;
    }

    protected static function schemaGetNFT(int $id): array
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM nfts WHERE id = $id");
        $fetch->execute();
        $response = $fetch->fetch();
        return $response;
    }

}


?>