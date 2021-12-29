<?php

namespace Src\Repository;

use App\Services\ConnectionFactory;

class NFTRepository
{

    private string $table = 'nfts';

    public static function schemaFetchNfts($query): array
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM nfts $query");
        $fetch->execute();
        $response = $fetch->fetchAll(\PDO::FETCH_ASSOC);
        return $response;
    }

    public static function schemaGetMyNFTS(int $id): array 
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM nfts WHERE owner = $id");
        $fetch->execute();
        $response = $fetch->fetchAll(\PDO::FETCH_ASSOC);
        return $response;
    }

    public static function schemaGetMyNFT(int $id, int $owner): array 
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM nfts WHERE id = $id AND owner = $owner");
        $fetch->execute();
        $response = $fetch->fetch(\PDO::FETCH_ASSOC);
        return $response;
    }

    public static function schemaGetNFT(int $id): array
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM nfts WHERE id = $id");
        $fetch->execute();
        $response = $fetch->fetch(\PDO::FETCH_ASSOC);
        return $response;
    }

    public static function schemaFetchClientNFTs(int $user): array
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM nfts INNER JOIN nfts_purchases ON nfts_purchases.nft = nfts.id WHERE nfts_purchases.owner = $user");
        $fetch->execute();
        $response = $fetch->fetchAll(\PDO::FETCH_ASSOC);
        return $response;
    }

    public static function schemaGetAllNamesNFTs(string $name)
    {
        $name = ConnectionFactory::connect()->prepare("SELECT (name) FROM nfts WHERE name = '$name'");
        $name->execute();
        $launch = $name->fetch(\PDO::FETCH_ASSOC);
        if($launch) return true;
        return false;
    }

}


?>