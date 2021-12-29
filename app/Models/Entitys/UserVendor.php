<?php

namespace App\Models\Entitys;

use App\Services\QuerysDatabase\QuerySeter;
use App\Services\QuerysDatabase\QueryInserter;
use Src\Repository\NFTRepository;
use Src\Repository\ShopVendorRepository;
use Src\Helpers\MessageAuth;
use App\Models\API\BlockchainRequest;
use Src\Middlewares\AuthenticatorNFT;
use Src\Middlewares\ExistenceVerifier;
use Src\Middlewares\RenameFiles;

class UserVendor extends QueryInserter
{

    protected function getMyNFTs(int $id): array
    {
        $response = NFTRepository::schemaGetMyNFTS( (int) $id );
        return $response;
    }

    protected function getMyNFT(int $id, int $owner): array
    {
        $response = NFTRepository::schemaGetMyNFT( (int) $id, (int) $owner );
        return $response;
    }

    protected function getShops(int $owner): array
    {
        $response = ShopVendorRepository::schemaGetShops( (int) $owner );
        return $response;
    }

    protected function newNFT(int $owner, int $shop, string $name, string $description, string $blockchain, array $image, string $price, string $currency, string $cryptoType): void
    {
        $verifyName = AuthenticatorNFT::verifyName($name);
        $verifyImage = AuthenticatorNFT::verifyImage($image);
        $verifyPrice = AuthenticatorNFT::verifyPrice($price);
        $verifyExistence = ExistenceVerifier::nameNFTExists($name);

        if($verifyExistence === true || $verifyName === false || $verifyImage === false || $verifyPrice === false) return;

        $priceConvert = str_replace(array('.', ','), '', $price);
        $fileName = RenameFiles::renameImage( (string) $name, (string) $image['name'] );

        $crypto = (new BlockchainRequest)->exchangeRates($currency, (string) $priceConvert);
        $insert = QueryInserter::schemaSetNFT( (int) $owner, (int) $shop, (string) $name, (string) $description, (string) $blockchain, (string) $fileName, (string) $price, (string) $currency, (int) $crypto, (string) $cryptoType );
        
        if(!empty($insert)){
            MessageAuth::launchMessage('error', 'Invalid data!');
            return;
        }

        move_uploaded_file($image['tmp_name'], dirname(__DIR__, 3). '\storage\nfts\\' . $fileName);

        MessageAuth::launchMessage('success', 'NFT successfully registered!');
        header('Refresh');
    }

    protected function updateNFT(int $nft, int $owner, int $shop, string $name, string $description, string $blockchain, string $price, string $currency, string $cryptoType): void
    {
        $priceConvert = str_replace(array('.', ','), '', $price);
        $crypto = (new BlockchainRequest)->exchangeRates($currency, (string) $priceConvert);
        $update = QuerySeter::schemaUpdateNFT( (int) $nft, (int) $owner, (int) $shop, (string) $name, (string) $description, (string) $blockchain, (string) $price, (string) $currency, (int) $crypto, (string) $cryptoType );
        
        if(!empty($update)){
            MessageAuth::launchMessage('error', 'Invalid data!');
            return;
        }

        MessageAuth::launchMessage('success', 'NFT successfully updated!');
        header('Refresh');
    }

    protected function registerShop(int $owner, string $name, array $banner): void
    {
        $verifyName = AuthenticatorNFT::verifyName($name);
        $verifyBanner = AuthenticatorNFT::verifyImage($banner);

        if($verifyName === false || $verifyBanner === false) return;

        $fileName = RenameFiles::renameImage( (string) $name, (string) $banner['name'] );

        $insert = QueryInserter::schemaSetShop( (int) $owner, (string) $name, (string) $fileName );
        
        if(!empty($insert)){
            MessageAuth::launchMessage('error', 'Invalid data!');
            return;
        }

        move_uploaded_file($banner['tmp_name'], dirname(__DIR__, 3). '\storage\shops\\' . $fileName);

        MessageAuth::launchMessage('success', 'Shop successfully registered!');
    }

    public function setType(int $user, string $type): void
    {

        if(!$type){
            MessageAuth::launchMessage('error', 'Error type!');
            return;
        }

        $update = QuerySeter::schemaUpdateType( (int) $user );
        $_SESSION['type_user'] = $type;
    }

}

?>