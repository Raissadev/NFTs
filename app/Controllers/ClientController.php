<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Entitys\User;
use App\Models\Market;
use App\Models\NFT;
use App\Models\Authentication;

class ClientController
{

    private array $funcsUser;

    public function __construct()
    {
        $this->funcsUser = User::isUser();
    }

    public function profile(): void
    {
        $user = (new Market)->getOwner($_SESSION['id']);
        $blockchain = User::getMyBlockchain($_SESSION['id']);
        $nftsClient = (new NFT)->getListNFT( (int) $_SESSION['id'] );
        MainView::render('profile', [ 'isUser' => $this->funcsUser, 'user' => $user, 'blockchain' => $blockchain, 'nftsClient' => $nftsClient ]);
    }

    public function storeUpdateProfile(): void
    {
        User::authUpdateProfile( (int) $_SESSION['id'], (string) $_POST['name'], (string) $_POST['email'], (array) $_FILES['image'] );
    }

    public function storeUpdateBlockchain(): void
    {
        User::newBlockchain( (int) $_SESSION['id'], (string) $_POST['blockchain'], (string) $_POST['blockchain_password'] );
    }

    public function myNTFs(): void
    {
        $nftsClient = (new NFT)->getListNFT( (int) $_SESSION['id'] );
        MainView::render('my-nfts', [ 'isUser' => $this->funcsUser, 'nftsClient' => $nftsClient ]);
    }

    public function downloadFile(): void
    {
        $readFile = (new NFT)->downloadFile( (string) $_POST['image-nft']  );
    }

}
