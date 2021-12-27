<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Entitys\User;
use App\Models\Market;
use App\Models\Api\BlockchainRequest;

class MarketController extends Market
{

    public function shop(): void
    {
        $isUser = User::isUser();
        $owners = (new Market)->getAllUsers("");
        $filter = (new Market)->fetchNft("");
        $shops = (new Market)->getAllShops("");
        $nfts = (new Market)->fetchNft( isset($_GET['search-nft']) ? "WHERE shop = '$_GET[shop]' AND name LIKE '$_GET[search]%' OR description LIKE '$_GET[search]%' AND crypto_type = '$_GET[crypto_type]' AND price BETWEEN '$_GET[price_min]' AND '$_GET[price_max]'" : '' );
        MainView::render('market', [ "isUser" => $isUser, 'nfts' => $nfts, 'owners' => $owners, 'filter' => $filter, 'shops' => $shops ]);
    }

    public function shopVendor(): void
    {
        $isUser = User::isUser();
        $nfts = (new Market)->fetchNft( "WHERE owner = $_GET[id]" );
        $owner = (new Market)->getOwner( $_GET['id'] );
        $shop = (new Market)->getShop( $_GET['id'] );
        MainView::render('shop-vendor', [ 'isUser' => $isUser, 'nfts' => $nfts, 'owner' => $owner, 'shop' => $shop]);
    }

    public function nft(): void
    {
        $blockchain = User::getMyBlockchain($_SESSION['id']);
        $isUser = User::isUser();
        $nft = (new Market)->getNFT($_GET['id']);
        $owner = (new Market)->getOwner($nft['owner']);
        MainView::render('nft-vendor', [ "isUser" => $isUser, 'nft' => $nft, 'owner' => $owner, 'blockchain' => $blockchain ]);
    }

    public function globalNFT(): void
    {
        $blockchain = User::getMyBlockchain($_SESSION['id']);
        $isUser = User::isUser();
        $nft = (new BlockchainRequest)->nftSingle($_GET['id']);
        MainView::render('global-nft', [ "isUser" => $isUser, 'nft' => $nft, 'blockchain' => $blockchain ]);
    }

}
