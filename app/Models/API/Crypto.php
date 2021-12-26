<?php

namespace App\Models\Api;

class Crypto
{

    protected string $base;
    protected string $endpoint;

    public function __construct()
    {
        $this->base = "https://api.blockchain.com/v3/exchange";
    }


    public function request(){
        $ch = curl_init($this->base.$this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,  true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["accept: application/json","X-API-Token: c831730d-b3e5-4dc2-9f17-00e5b1957aa6"]);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        return $response;
    }

}

?>