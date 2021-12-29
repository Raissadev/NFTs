<?php

require 'config/config.php';

new Src\Middlewares\Permissions\PermissionsMiddleware;

$Router = new App\Route\Router;
$Controllers = "App\Controllers";

/* Methods Posts */
$Router->post("/sign-in", "$Controllers\AuthenticationController", "storeSignIn");
$Router->post("/sign-up", "$Controllers\AuthenticationController", "storeSignUp");
$Router->post("/request-wallet", "$Controllers\AuthenticationController", "storeRequestBlockchain");
$Router->post("/nft", "$Controllers\PaymentController", "storePayment");
$Router->post("/download-file", "$Controllers\ClientController", "downloadFile");
//Dashboard
$Router->post("/dashboard/register-nft", "$Controllers\VendorController", "storeRegisterNFT");
$Router->post("/dashboard/register-shop", "$Controllers\VendorController", "storeShopVendor");
$Router->post("/dashboard/register-collection", "$Controllers\VendorController", "storeCollectionVendor");

/* Methods Puts */
$Router->put("/dashboard/profile", "$Controllers\VendorController", "storeUpdateProfile");
$Router->put("/dashboard/my-nft/?id=", "$Controllers\VendorController", "storeUpdateNFT");
$Router->put("/create-wallet", "$Controllers\AuthenticationController", "storeCreateWallet");
$Router->put("/profile", "$Controllers\ClientController", "storeUpdateProfile");
$Router->put("/update-blockchain", "$Controllers\ClientController", "storeUpdateBlockchain");

/* Methods Gets */
//Dashboard
$Router->get("/dashboard/profile", "$Controllers\VendorController", "profile");
$Router->get("/dashboard/statistics", "$Controllers\VendorController", "statistics");
$Router->get("/dashboard/register-nft", "$Controllers\VendorController", "registerNFT");
$Router->get("/dashboard/my-nfts", "$Controllers\VendorController", "myNFTs");
$Router->get("/dashboard/my-nft/?id=", "$Controllers\VendorController", "myNFT");
$Router->get("/dashboard/register-shop", "$Controllers\VendorController", "registerShopVendor");
$Router->get("/dashboard/register-collection", "$Controllers\VendorController", "registerCollectionVendor");
$Router->get("/dashboard", "$Controllers\VendorController", "dashboard");
//Pages Defaults
$Router->get("/home", "$Controllers\Controller", "index");
$Router->get("/sign-in", "$Controllers\AuthenticationController", "signIn");
$Router->get("/sign-up", "$Controllers\AuthenticationController", "signUp");
$Router->get("/profile", "$Controllers\ClientController", "profile");
$Router->get("/market", "$Controllers\MarketController", "shop");
$Router->get("/collections", "$Controllers\MarketController", "collections");
$Router->get("/collection/?id=", "$Controllers\MarketController", "collection");
$Router->get("/shop-vendor/?id=", "$Controllers\MarketController", "shopVendor");
$Router->get("/nft/?id=", "$Controllers\MarketController", "nft");
$Router->get("/global-nft/?id=", "$Controllers\MarketController", "globalNFT");
$Router->get("/global-nfts", "$Controllers\Controller", "globalNFTs");
$Router->get("/my-nfts", "$Controllers\ClientController", "myNTFs");
$Router->get("/become-vendor", "$Controllers\VendorController", "becomeVendor");
$Router->get("/wallet", "$Controllers\Controller", "wallet");
$Router->get("/exception", "$Controllers\Controller", "exception");
$Router->get("/", "$Controllers\Controller", "index");        

?>