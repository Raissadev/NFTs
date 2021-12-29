<?php

namespace Src\Repository;

use App\Services\ConnectionFactory;

class CollectionsRepository
{

    private string $table = 'collections';

    public static function schemaFetchCollections(): array
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM collections");
        $fetch->execute();
        $response = $fetch->fetchAll(\PDO::FETCH_ASSOC);
        return $response;
    }

    public static function schemaGetCollection($query): array
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT id, owners, nfts FROM collections $query");
        $fetch->execute();
        $response = $fetch->fetch(\PDO::FETCH_ASSOC);
        return $response;
    }

}


?>