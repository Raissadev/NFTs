<?php

namespace App\Models\Api;

use App\Models\Api\Blockchain;
use Src\Helpers\MessageAuth;

class BlockchainReceive extends Blockchain
{

    public function __construct()
    {
        $this->base = 'https://api.blockchain.com/v3/exchange';
    }

    public function withDrawals(string $from, string $to, string $amount, string $currency, string $beneficiary)
    {
        $this->endpoint = "/withdrawals?from=$from&to=$to";
        $this->data = [
            'amount'    =>  $amount,
            'currency'  =>  $currency,
            'beneficiary'   =>  $beneficiary,
            'sendMax'   =>  true
        ];

        $this->post();
        return $this;
    }


    public function post()
    {
        $url = $this->base . $this->endpoint;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-API-Token: ****************", "accept: application/json", "Content-Type: application/json"]);

        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        MessageAuth::launchMessage('success', "Success $response");
    }

}

?>
