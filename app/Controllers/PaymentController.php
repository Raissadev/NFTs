<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Api\Blockchain;

class PaymentController extends Blockchain
{

    public function storePayment(): void
    {
        if(isset($_POST['buy'])){
            (new Blockchain)->makePayment( $_POST['guid'], $_POST['password'], $_POST['to'], $_POST['amount'] );
        }
    }

}
