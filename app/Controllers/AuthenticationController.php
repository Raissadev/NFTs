<?php

namespace App\Controllers;

use App\Services\MainView;
use App\Models\Authentication;
use App\Models\Entitys\User;
use App\Models\Entitys\UserVendor;
use App\Models\API\Blockchain;

class AuthenticationController extends Authentication
{

    public function signIn(): void 
    {
        MainView::simpleRender('sign-in', [  ]);
    }

    public function storeSignIn(): void
    {
        (new Authentication)->authSignIn( (string) $_POST['email'], (string) $_POST['password'] );
    }

    public function signUp(): void 
    {
        MainView::simpleRender('sign-up', [  ]);
    }

    public function storeSignUp(): void 
    {
        (new Authentication)->authSignUp( (string) $_POST['name'], (string) $_POST['email'], (string) $_POST['password'], (array) $_FILES['image'], (string) "client" );
        
        if(isset($_POST['create-wallet'])){
            (new Blockchain)->createWallet($_POST['email'], $_POST['password']);
        }
    }

    public function storeRequestBlockchain(): void
    {
        (new Blockchain)->createWallet($_POST['email'], $_POST['password']);
    }

    public function storeCreateWallet(): void
    {
        if(isset($_SESSION['id'])) User::newBlockchain( (int) $_SESSION['id'], (string) $_POST['blockchain'], (string) $_POST['blockchain_password'] );
    }

}


?>