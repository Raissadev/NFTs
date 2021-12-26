<?php

namespace App\Models;

use Src\Repository\NFTRepository;
use Src\Repository\ShopVendorRepository;
use Src\Repository\UserRepository;
use Src\Repository\VendorRepository;
use Src\Helpers\MessageAuth;

class Market extends NFTRepository
{

    public function getNFT(int $id): array
    {
        $fetch = NFTRepository::schemaGetNFT($id);
        return $fetch;
    }

    public function fetchNft(string $query): array
    {
        $fetch = NFTRepository::schemaFetchNfts($query);
        return $fetch;
    }

    public function getAllUsers($query): array
    {
        $fetch = UserRepository::schemaGetAllUsers($query);
        return $fetch;
    }

    public function getOwner(int $id): array
    {
        $fetch = VendorRepository::schemaGetOwner($id);
        return $fetch;
    }

    public function getShop(int $owner): array
    {
        $response = ShopVendorRepository::schemaGetShopVendor( (int) $owner );
        return $response;
    }

    public function getAllShops($query): array
    {
        $fetch = ShopVendorRepository::schemaGetAllShops($query);
        return $fetch;
    }

    

}

?>