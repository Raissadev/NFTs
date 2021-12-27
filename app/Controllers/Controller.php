<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Entitys\User;
use App\Models\Market;
use App\Models\Api\BlockchainRequest;

class Controller
{

    public function index(): void
    {
        $prices = array_slice((new BlockchainRequest)->getPrices(), 0, 2);
        $isUser = User::isUser();
        $owners = (new Market)->getAllUsers("");
        $shops = (new Market)->getAllShops( "LIMIT 6" );
        $nfts = (new Market)->fetchNft( "LIMIT 3" );
        MainView::render('home', [ "isUser" => $isUser, "nfts" => $nfts, "owners" => $owners, 'shops' => $shops, 'prices' => $prices ]);
    }

    public function globalNFTs(): void
    {
        $isUser = User::isUser();
        $nfts = (new BlockchainRequest)->getNFTs();
        MainView::render('global-nfts', [ "isUser" => $isUser, 'nfts' => $nfts ]);
    }

    public function wallet(): void
    {
        $isUser = User::isUser();
        MainView::render('wallet', [ "isUser" => $isUser ]);
    }

    public function exception(): void 
    {
        MainView::simpleRender('exception', [  ]);
    }

}
