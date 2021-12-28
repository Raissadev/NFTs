<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Api\Blockchain;

class PaymentController extends Blockchain
{

    public function storePayment(): void
    {
        $newBuy = (new Blockchain)->makePayment( $_POST['guid'], $_POST['password'], $_POST['to'], $_POST['amount'] );
        
        if($newBuy && isset($_POST['nft-identifier'])){
            (new VendorController)->newBuy( (int) $_POST['nft-identifier'], (int) $_POST['quantity'] - 1 );
        }
    }

}
