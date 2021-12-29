<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= BASE_PATH ?>/css/global.css" rel="stylesheet" />
    <link href="<?= BASE_PATH ?>/css/dashboard.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= BASE_STORAGE_IMAGES ?>/crypto.ico" >
    <title>Dahsboard - NFTs</title>
</head>
<body>

<aside class="panel hide-dv-small aside-nav">
    <nav class="wrap w100 h100 items-flex direction-column just-space-between align-center h85vh">
        <div class="col logo w85 text-center">
            <a href="<?= BASE_URL ?>/dashboard"><img src="<?= BASE_STORAGE_IMAGES ?>/digital_key.svg" /></a>
        </div>
        <ul class="col menu w85">
            <li><a href="<?= BASE_DASHBOARD ?>/" class="box-effect"> <i class="ri-command-fill"></i> </a></li>
            <li><a href="<?= BASE_DASHBOARD ?>/statistics" class="box-effect"> <i class="ri-bar-chart-fill"></i> </a></li>
            <li><a href="<?= BASE_DASHBOARD ?>/profile" class="box-effect"> <i class="ri-wallet-3-fill"></i> </a></li>
        </ul>
        <ul class="col menu w85">
            <li><a href="<?= BASE_DASHBOARD ?>/my-nfts" class="box-effect"> <i class="ri-archive-fill"></i> </a></li>
            <li><a href="<?= BASE_DASHBOARD ?>/register-nft" class="box-effect"> <i class="ri-quill-pen-fill"></i> </a></li>
            <li><a href="<?= BASE_DASHBOARD ?>/register-shop" class="box-effect"> <i class="ri-git-branch-fill"></i> </a></li>
        </ul>
        <ul class="col w85">
            <li class="text-center"><a> <i class="ri-shield-user-line"></i> </a></li>
        </ul>
    </nav>
</aside>

<main class="container-main mr-bottom-small">

<header class="w100 mr-bottom-small">
    <div class="wrap w95 center items-flex align-center">
        <form method="GET" action="<?= BASE_DASHBOARD ?>/my-nfts" class="col w30 search items-flex align-center pos-relative">
            <button type="submit" name="search-my-nft" class="style-none"><i class="ri-search-line"></i></button>
            <input type="text" name="name" placeholder="Search here" class="w100" />
        </form>
        <div class="col w70 items-flex align-center just-end">
            <a class="button w15 mr-right-default hide-dv-small"><i class="ri-coin-fill mr-right-tiny"></i> <?= isset($params['blockchainWallet']->balance) ? $params['blockchainWallet']->balance : '0 BTC' ?></a>
            <div class="items-flex align-center">
                <a><i class="ri-message-3-fill"></i></a>
                <a href="<?= BASE_DASHBOARD ?>/register-collection" class="mr-side-small"><i class="ri-notification-3-fill"></i></a>
                <a class="toggle hide-dv-bigger mr-right-small"><i class="ri-menu-3-line"></i></a>
                <figure class="img-user-small items-flex align-center">
                    <img src="<?= BASE_STORAGE_USERS ?>/<?= $_SESSION['image'] ?>" />
                    <h5 class="mr-left-tiny hide-dv-small"><?= $_SESSION['name'] ?></h5>
                </figure>
            </div>
        </div>
    </div>
</header>

<section class="content">
