<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Api\Blockchain;
use App\Models\NFT;

class PaymentController extends Blockchain
{

    public function storePayment(): void
    {
        $newBuy = (new Blockchain)->makePayment($_POST['guid'], $_POST['password'], $_POST['to'], $_POST['amount']);
        
        if(!$newBuy && isset($_POST['nft-identifier'])){
            (new NFT)->addListNFT( (int) $_SESSION['id'], (int) $_POST['nft-identifier'] );
            header('Location: '.BASE_URL.'/my-nfts');
        }
    }

}
