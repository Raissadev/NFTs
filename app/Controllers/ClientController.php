<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Entitys\User;
use App\Models\Market;
use App\Models\Authentication;

class ClientController extends Authentication
{

    public function profile(): void
    {
        $isUser = User::isUser();
        $user = (new Market)->getOwner($_SESSION['id']);
        $blockchain = User::getMyBlockchain($_SESSION['id']);
        MainView::render('profile', [ 'isUser' => $isUser, 'user' => $user, 'blockchain' => $blockchain['blockchain'] ]);
    }

    public function storeUpdateProfile(): void
    {
        if(isset($_POST['update-profile-client'])){
            (new Authentication)->authUpdateProfile( (int) $_SESSION['id'], (string) $_POST['name'], (string) $_POST['email'], (array) $_FILES['image'] );
        }
    }

    public function storeUpdateBlockchain(): void
    {
        if(isset($_POST['register-blockchain-client'])){
            User::newBlockchain( (int) $_SESSION['id'], (string) $_POST['blockchain'] );
        }
    }

}
