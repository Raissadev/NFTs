<?php

namespace Src\Repository;

use App\Services\ConnectionFactory;

class ShopVendorRepository
{

    private string $table = 'shops_vendors';

    public static function schemaGetShopVendor(int $owner): array
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM shops_vendors WHERE owner = $owner");
        $fetch->execute();
        $response = $fetch->fetch();
        return $response;
    }

    public static function schemaGetShops(int $owner): array
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM shops_vendors WHERE owner = $owner");
        $fetch->execute();
        $response = $fetch->fetchAll();
        return $response;
    }

    public static function schemaGetAllShops($query): array
    {
        $fetch = ConnectionFactory::connect()->prepare("SELECT * FROM shops_vendors $query");
        $fetch->execute();
        $response = $fetch->fetchAll();
        return $response;
    }

}


?>