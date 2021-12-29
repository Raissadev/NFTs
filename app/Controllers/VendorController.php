<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Market;
use App\Models\Entitys\User;
use App\Models\Entitys\UserVendor;
use App\Models\API\Blockchain;
use App\Models\API\BlockchainRequest;
use App\Models\API\BlockchainMetrics;

use App\Models\NFT;

class VendorController extends UserVendor
{

    private array $lastNFTs;
    private array $owners;

    public function __construct()
    {
        $this->lastNFTs = (new Market)->fetchNft( "ORDER BY id DESC LIMIT 3" );
        $this->owners = (new Market)->getAllUsers( "LIMIT 4" );
    }

    public function dashboard(): void
    {
        $blockchainUser = User::getMyBlockchain($_SESSION['id']);
        $blockchainWallet = (new Blockchain)->balanceWallet( /* $blockchainUser['blockchain'], $blockchainUser['blockchain_password'] */ "", "" );
        $nfts = (new UserVendor)->getMyNFTs($_SESSION['id']);
        MainView::dashboard('dashboard', [ 'nfts' => $nfts, 'lastNFTs' => $this->lastNFTs, 'owners' => $this->owners, 'blockchainWallet' => $blockchainWallet ]);
    }

    public function registerNFT(): void
    {
        $nfts = (new UserVendor)->getMyNFTs($_SESSION['id']);
        $blockchain = User::getMyBlockchain($_SESSION['id']);
        $shops = (new UserVendor)->getShops($_SESSION['id']);
        MainView::dashboard('register-nft', [ 'lastNFTs' => $this->lastNFTs, 'owners' => $this->owners, 'shops' => $shops, 'blockchain' => $blockchain['blockchain'] ]);
    }

    public function registerShopVendor(): void
    {
        MainView::dashboard('register-shop', [ 'lastNFTs' => $this->lastNFTs, 'owners' => $this->owners ]);
    }

    public function storeShopVendor(): void
    {
        (new UserVendor)->registerShop($_SESSION['id'], $_POST['name'], $_FILES['banner']);
    }

    public function profile(): void
    {
        $blockchain = User::getMyBlockchain($_SESSION['id']);
        $user = (new Market)->getOwner($_SESSION['id']);
        MainView::dashboard('profile', [ 'lastNFTs' => $this->lastNFTs, 'owners' => $this->owners, 'user' => $user, 'blockchain' => $blockchain ]);
    }

    public function statistics(): void{
        $users = (new Market)->getAllUsers( "" );
        $nfts = (new UserVendor)->getMyNFTs($_SESSION['id']);
        $shops = (new Market)->getAllShops( "WHERE owner = $_SESSION[id]" );
        $symbols = (new BlockchainRequest)->symbols();
        MainView::dashboard('statistics', [ 'lastNFTs' => $this->lastNFTs, 'owners' => $this->owners, 'nfts' => $nfts, 'shops' => $shops, 'users' => $users, 'symbols' => $symbols ]);
    }

    public function myNFTs(): void
    {
        $nfts = (new Market)->fetchNft( isset($_GET['search-my-nft']) ? "WHERE name LIKE '$_GET[name]%' AND owner = $_SESSION[id]" : "WHERE owner = $_SESSION[id]" );
        $users = (new Market)->getAllUsers("");
        MainView::dashboard('my-nfts', [ 'lastNFTs' => $this->lastNFTs, 'owners' => $this->owners, 'nfts' => $nfts, 'users' => $users ]);
    }

    public function myNFT(): void
    {
        $nft = (new UserVendor)->getMyNFT($_GET['id'], $_SESSION['id']);
        $shops = (new UserVendor)->getShops($_SESSION['id']);
        MainView::dashboard('my-nft', [ 'lastNFTs' => $this->lastNFTs, 'owners' => $this->owners, 'nft' => $nft, 'shops' => $shops ]);
    }


    public function storeRegisterNFT(): void
    {
        (new UserVendor)->newNFT($_SESSION['id'], $_POST['shop'], $_POST['name'], $_POST['description'], $_POST['blockchain'], $_FILES['image'], $_POST['price'], $_POST['currency'], $_POST['crypto_type']);
    }

    public function storeUpdateNFT(): void
    {
        (new UserVendor)->updateNFT($_GET['id'], $_SESSION['id'], $_POST['shop'], $_POST['name'], $_POST['description'], $_POST['blockchain'], $_POST['price'], $_POST['currency'], $_POST['crypto_type']);
    }

    public function storeUpdateProfile(): void
    {
        User::authUpdateProfile( (int) $_SESSION['id'], (string) $_POST['name'], (string) $_POST['email'], (array) $_FILES['image'] );
            
        if(isset($_POST['blockchain'])){
            User::newBlockchain( (int) $_SESSION['id'], (string) $_POST['blockchain'], (string) $_POST['blockchain_password'] );
        }

    }

    public function becomeVendor(): void
    {
        if(isset($_GET['type_user']) && isset($_SESSION['id']) ){
            (new UserVendor)->setType($_SESSION['id'], "vendor");
        }
    }

}

?>