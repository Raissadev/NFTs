<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Entitys\User;
use App\Models\Market;
use App\Models\Api\BlockchainRequest;

class MarketController extends Market
{

    private array $funcsUser;

    public function __construct()
    {
        $this->funcsUser = User::isUser();
        $this->userBlockchain = User::getMyBlockchain( $_SESSION['id'] );
    }

    public function shop(): void
    {
        $collections = (new Market)->getAllCollections();
        $owners = (new Market)->getAllUsers("");
        $filter = (new Market)->fetchNft("");
        $shops = (new Market)->getAllShops("");
        $nfts = (new Market)->fetchNft( isset($_GET['search-nft']) ? "WHERE shop = '$_GET[shop]' AND name LIKE '$_GET[search]%' OR description LIKE '$_GET[search]%' AND crypto_type = '$_GET[crypto_type]' AND price BETWEEN '$_GET[price_min]' AND '$_GET[price_max]' AND collection = $_GET[collection] ORDER BY id DESC" : 'ORDER BY id DESC' );
        MainView::render('market', [ "isUser" => $this->funcsUser, 'nfts' => $nfts, 'owners' => $owners, 'filter' => $filter, 'shops' => $shops, 'collections' => $collections ]);
    }

    public function shopVendor(): void
    {
        $nfts = (new Market)->fetchNft("WHERE owner = $_GET[id]");
        $owner = (new Market)->getOwner($_GET['id']);
        $shop = (new Market)->getShop($_GET['id']);
        MainView::render('shop-vendor', [ 'isUser' => $this->funcsUser, 'nfts' => $nfts, 'owner' => $owner, 'shop' => $shop]);
    }

    public function nft(): void
    {
        $nft = (new Market)->getNFT($_GET['id']);
        $owner = (new Market)->getOwner($nft['owner']);
        $collection = (new Market)->getCollection("WHERE id = $nft[collection]");
        MainView::render('nft-vendor', [ "isUser" => $this->funcsUser, 'nft' => $nft, 'owner' => $owner, 'blockchain' => $this->userBlockchain, 'collection' => $collection ]);
    }

    public function globalNFT(): void
    {
        $blockchain = User::getMyBlockchain($_SESSION['id']);
        $nft = (new BlockchainRequest)->nftSingle($_GET['id']);
        MainView::render('global-nft', [ "isUser" => $this->funcsUser, 'nft' => $nft, 'blockchain' => $this->userBlockchain ]);
    }

    public function collections(): void
    {
        $users = (new Market)->getAllUsers("WHERE type_user = 'vendor' LIMIT 5");
        $collections = (new Market)->getAllCollections();
        MainView::render('collections', [ "isUser" => $this->funcsUser, 'collections' => $collections, 'users' => $users ]);
    }

    public function collection(): void
    {
        $collection = (new Market)->getCollection("WHERE id = $_GET[id]");
        $nfts = (new Market)->fetchNft("WHERE collection = $collection[id]");
        $owners = (new Market)->getAllUsers("");
        MainView::render('collection', [ "isUser" => $this->funcsUser, 'collection' => $collection, 'nfts' => $nfts, 'owners' => $owners ]);
    }

}
