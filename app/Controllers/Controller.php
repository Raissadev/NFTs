<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Entitys\User;
use App\Models\Market;
use App\Models\Api\BlockchainRequest;

class Controller
{

    private array $funcsUser;

    public function __construct()
    {
        $this->funcsUser = User::isUser();
    }

    public function index(): void
    {
        $prices = array_slice((new BlockchainRequest)->getPrices(), 0, 2);
        $owners = (new Market)->getAllUsers("");
        $shops = (new Market)->getAllShops("LIMIT 6");
        $nfts = (new Market)->fetchNft("ORDER BY id DESC LIMIT 3");
        MainView::render('home', [ "isUser" => $this->funcsUser , "nfts" => $nfts, "owners" => $owners, 'shops' => $shops, 'prices' => $prices ]);
    }

    public function globalNFTs(): void
    {
        $nfts = (new BlockchainRequest)->getNFTs();
        MainView::render('global-nfts', [ "isUser" => $this->funcsUser, 'nfts' => $nfts ]);
    }

    public function wallet(): void
    {
        MainView::render('wallet', [ "isUser" => $this->funcsUser ]);
    }

    public function exception(): void 
    {
        MainView::simpleRender('exception', [  ]);
    }

}
