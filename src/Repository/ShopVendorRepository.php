<?php

namespace Src\Repository;

use App\Services\ConnectionFactory;

class ShopVendorRepository
{

    private string $table = 'shops_vendors';

    public static function schemaRegisterShop(int $owner, string $name, string $banner): void
    {
        $insert = ConnectionFactory::connect()->prepare("INSERT INTO shops_vendors (owner, name, banner) VALUES (?,?,?)");
        $insert->execute([ $owner, $name, $banner ]);
    }

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