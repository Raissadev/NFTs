<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Api\Blockchain;
use App\Models\NFT;
use Src\Middlewares\ExistenceVerifier;

class PaymentController extends Blockchain
{

    public function storePayment(): void
    {
        $verifier = ExistenceVerifier::hasAnOwner( (int) $_POST['nft-identifier'] );
        if($verifier === true) return;

        $newBuy = (new Blockchain)->makePayment($_POST['guid'], $_POST['password'], $_POST['to'], $_POST['amount']);
        
        if($newBuy && isset($_POST['nft-identifier'])){
            (new NFT)->addListNFT( (int) $_SESSION['id'], (int) $_POST['nft-identifier'] );
            header('Location: '.BASE_URL.'/profile');
        }
    }

}
