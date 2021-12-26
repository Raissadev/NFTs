<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Market;
use App\Models\Entitys\User;
use App\Models\Entitys\UserVendor;
use App\Models\API\Blockchain;
use App\Models\API\BlockchainRequest;
use App\Models\API\BlockchainMetrics;

class VendorController extends UserVendor
{

    public function dashboard(): void
    {
        $blockchainUser = User::getMyBlockchain($_SESSION['id']);
        $blockchainWallet = (new Blockchain)->balanceWallet( /* $blockchainUser['blockchain'], $blockchainUser['blockchain_password'] */ "", "" );
        $lastNFTs = (new Market)->fetchNft( "ORDER BY id DESC LIMIT 3" );
        $owners = (new Market)->getAllUsers( "LIMIT 3" );
        $nfts = (new UserVendor)->getMyNFTs($_SESSION['id']);
        MainView::dashboard('dashboard', [ 'nfts' => $nfts, 'lastNFTs' => $lastNFTs, 'owners' => $owners, 'blockchainWallet' => $blockchainWallet ]);
    }

    public function registerNFT(): void
    {
        $lastNFTs = (new Market)->fetchNft( "ORDER BY id DESC LIMIT 3" );
        $nfts = (new UserVendor)->getMyNFTs($_SESSION['id']);
        $owners = (new Market)->getAllUsers( "LIMIT 3" );
        $blockchain = User::getMyBlockchain($_SESSION['id']);
        $shops = (new UserVendor)->getShops($_SESSION['id']);
        MainView::dashboard('register-nft', [ 'lastNFTs' => $lastNFTs, 'owners' => $owners, 'shops' => $shops, 'blockchain' => $blockchain['blockchain'] ]);
    }

    public function registerShopVendor(): void
    {
        $lastNFTs = (new Market)->fetchNft( "ORDER BY id DESC LIMIT 3" );
        $owners = (new Market)->getAllUsers( "LIMIT 3" );
        MainView::dashboard('register-shop', [ 'lastNFTs' => $lastNFTs, 'owners' => $owners ]);
    }

    public function storeShopVendor(): void
    {
        if(isset($_POST['register-shop'])){
            (new UserVendor)->registerShop($_SESSION['id'], $_POST['name'], $_FILES['banner']);
        }
    }

    public function profile(): void
    {
        $lastNFTs = (new Market)->fetchNft( "ORDER BY id DESC LIMIT 3" );
        $owners = (new Market)->getAllUsers( "LIMIT 3" );
        $blockchain = User::getMyBlockchain($_SESSION['id']);
        $user = (new Market)->getOwner($_SESSION['id']);
        MainView::dashboard('profile', [ 'lastNFTs' => $lastNFTs, 'owners' => $owners, 'user' => $user, 'blockchain' => $blockchain ]);
    }

    public function statistics(): void{
        $lastNFTs = (new Market)->fetchNft( "ORDER BY id DESC LIMIT 3" );
        $owners = (new Market)->getAllUsers( "LIMIT 3" );
        $nfts = (new UserVendor)->getMyNFTs($_SESSION['id']);
        $shops = (new Market)->getAllShops( "WHERE owner = $_SESSION[id]" );
        $symbols = (new BlockchainRequest)->symbols();
        MainView::dashboard('statistics', [ 'lastNFTs' => $lastNFTs, 'owners' => $owners, 'nfts' => $nfts, 'shops' => $shops, 'symbols' => $symbols ]);
    }

    public function myNFTs(): void
    {
        $lastNFTs = (new Market)->fetchNft( "ORDER BY id DESC LIMIT 3" );
        $owners = (new Market)->getAllUsers( "LIMIT 3" );
        $nfts = (new Market)->fetchNft( isset($_GET['search-my-nft']) ? "WHERE name LIKE '$_GET[name]%' AND owner = $_SESSION[id]" : "WHERE owner = $_SESSION[id]" );
        $users = (new Market)->getAllUsers("");
        MainView::dashboard('my-nfts', [ 'lastNFTs' => $lastNFTs, 'owners' => $owners, 'nfts' => $nfts, 'users' => $users ]);
    }

    public function myNFT(): void
    {
        $lastNFTs = (new Market)->fetchNft( "ORDER BY id DESC LIMIT 3" );
        $owners = (new Market)->getAllUsers( "LIMIT 3" );
        $nft = (new UserVendor)->getMyNFT($_GET['id'], $_SESSION['id']);
        $shops = (new UserVendor)->getShops($_SESSION['id']);
        MainView::dashboard('my-nft', [ 'lastNFTs' => $lastNFTs, 'owners' => $owners, 'nft' => $nft, 'shops' => $shops ]);
    }


    public function storeRegisterNFT(): void
    {
        if(isset($_POST['register-nft'])){
            (new UserVendor)->newNFT($_SESSION['id'], $_POST['shop'], $_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['blockchain'], $_FILES['image'], $_POST['price'], $_POST['currency'], $_POST['crypto_type']);
        }
    }

    public function storeUpdateNFT(): void
    {
        if(isset($_POST['update-nft'])){
            (new UserVendor)->updateNFT($_GET['id'], $_SESSION['id'], $_POST['shop'], $_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['blockchain'], $_POST['price'], $_POST['currency'], $_POST['crypto_type']);
        }
    }

    public function storeUpdateProfile(): void
    {
        if(isset($_POST['update-profile'])){
            User::authUpdateProfile( (int) $_SESSION['id'], (string) $_POST['name'], (string) $_POST['email'], (array) $_FILES['image'] );
            
            if(isset($_POST['blockchain'])){
                User::newBlockchain( (int) $_SESSION['id'], (string) $_POST['blockchain'], (string) $_POST['blockchain_password'] );
            }
        }
    }

    public function shopVendor(): void
    {
        $isUser = User::isUser();
        $nfts = (new Market)->fetchNft( "WHERE owner = $_GET[id]" );
        $owner = (new Market)->getOwner( $_GET['id'] );
        $shop = (new Market)->getShop( $_GET['id'] );
        MainView::render('shop-vendor', [ 'isUser' => $isUser, 'nfts' => $nfts, 'owner' => $owner, 'shop' => $shop]);
    }

    public function nftVendor(): void
    {
        $isUser = User::isUser();
        MainView::render('nft-vendor', [ 'isUser' => $isUser ]);
    }

    public function becomeVendor(): void
    {
        if(isset($_GET['type']) && isset($_SESSION['id']) ){
            (new UserVendor)->setType($_SESSION['id'], "vendor");
        }
    }

}

?>