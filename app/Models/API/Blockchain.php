<?php

namespace App\Models\Api;

use Src\Helpers\MessageAuth;

class Blockchain
{

    protected string $base;
    protected string $endpoint;
    protected string $api;
    protected array $data;

    public function __construct()
    {
        $this->api = "39421209-b0fc-47e5-acf9-e7e553d8b152";
        $this->base = "http://127.0.0.1:3000";
    }

    public function createWallet(string $email, string $password)
    {
        $this->endpoint = "/api/v2/create_wallet?password=$password&email=$email&api_code=$this->api&hd=true";
        
        return $this->send();
    }

    public function balanceWallet(string $guid, string $password)
    {
        $this->endpoint = "/merchant/$guid/balance?password=$password";

        return $this->send();
    }

    public function makePayment(string $guid, string $password, string $to, string $amount)
    {
        $this->endpoint = "/merchant/$guid/payment?password=$password&to=$to&amount=$amount";

        return $this->send();
    }

    public function sendMany(string $guid, string $password, string $to, string $fee)
    {
        $recipients = json_encode([ $to => $fee ]);
        print_r($recipients);

        if(!$recipients){
            MessageAuth::launchMessage('error', 'Error when paying!');
            return;
        }

        $this->endpoint = "/merchant/$guid/sendmany?password=$password&recipients=$recipients&to=$to&fee=$fee";

        return $this->send();
    }

    public function send()
    {
        $ch = curl_init($this->base . $this->endpoint);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);
        
        if(empty($response)){
            MessageAuth::launchMessage('error', 'Error sended!');
            return;
        }

        MessageAuth::launchMessage('success', 'Success!');
        return $response;

    }

}

?>