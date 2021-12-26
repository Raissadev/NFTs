<?php

namespace App\Models\Api;

use App\Models\Api\Blockchain;

class BlockchainMetrics extends Blockchain
{

    public function __construct()
    {
        $this->base = "https://api.blockchain.info/";
    }

    public function graphics()
    {
        $this->endpoint = "charts/transactions-per-second?timespan=1weeks&rollingAverage=8hours&format=json";

        $this->get();
        return $this;
    }

    public function get()
    {
        $url = $this->base . $this->endpoint;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);

        $response = json_decode(curl_exec($ch));
        
        curl_close($ch);

        foreach($response->values as $key => $value){
            echo '['.$value->x.','.$value->y.'],';
        }

    }

}

?>
