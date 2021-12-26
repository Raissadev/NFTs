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
        if(isset($_POST['sign-in'])){
            (new Authentication)->authSignIn( (string) $_POST['email'], (string) $_POST['password'] );
        }
    }

    public function signUp(): void 
    {
        MainView::simpleRender('sign-up', [  ]);
    }

    public function storeUpdateProfile(): void
    {
        if(isset($_POST['update-profile'])){
            (new Authentication)->authUpdateProfile( (int) $_SESSION['id'], (string) $_POST['name'], (string) $_POST['email'], (array) $_FILES['image'] );
            
            if(isset($_POST['blockchain'])){
                User::newBlockchain( (int) $_SESSION['id'], (string) $_POST['blockchain'] );
            }
        }
    }

    public function storeSignUp(): void 
    {
        if(isset($_POST['sign-up'])){
            (new Authentication)->authSignUp( (string) $_POST['name'], (string) $_POST['email'], (string) $_POST['password'], (array) $_FILES['image'], (string) "client" );
        }
        if(isset($_POST['create-wallet'])){
            (new Blockchain)->createWallet($_POST['email'], $_POST['password']);
        }
    }

    public function storeRequestBlockchain(): void
    {
        if(isset($_POST['request-wallet'])){
            (new Blockchain)->createWallet($_POST['email'], $_POST['password']);
        }
    }

    public function storeCreateWallet(): void
    {
        if(isset($_POST['register-wallet'])){
            if(isset($_SESSION['id'])) User::newBlockchain( (int) $_SESSION['id'], (string) $_POST['blockchain'], (string) $_POST['blockchain_password'] );
        }
    }

    public function becomeVendor(): void
    {
        if(isset($_GET['type']) && isset($_SESSION['id']) ){
            (new UserVendor)->setType($_SESSION['id'], "vendor");
        }
    }

}