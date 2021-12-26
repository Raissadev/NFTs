<?php include 'components/box-message.php'; ?>

<main class="welcome pos-relative mr-bottom-bigger">
    <div class="wrap items-flex align-center just-center">
        <div class="col w50 w100-dv-small">
            <h1 class="font-size-bigger">Discover, <br /> Collect and sell <br /> dope NFTs</h1>
            <p class="mr-top-small mr-bottom-default">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent laoreet <br /> congue tortor.</p>
            <div class="buttons items-flex align-center pos-relative">
                <a href="/market" class="button w15 mr-right-small w40-dv-small">NFTs</a>
                <a href="/global-nfts" class="button button-clean w15 w40-dv-small">Explore</a>
            </div>
        </div>
        <div class="w50 w20-dv-small"></div>
    </div>
    <div class="row items-flex just-space-between pos-relative w90 center">
        <ul class="col w25 hide-dv-small">
            <li class="items-flex align-center mr-bottom-small">
                <i class="ri-bit-coin-fill mr-right-tiny"></i>
                <div>
                    <h2>42k+</h2>
                    <p>Visitants</p>
                </div>
            </li>
            <li class="items-flex align-center">
                <i class="ri-bit-coin-fill mr-right-tiny"></i>
                <div>
                    <h2>18k+</h2>
                    <p>Users actives</p>
                </div>
            </li>
        </ul>
        <div class="box w70 items-flex align-center just-space-between w100-dv-small slide-dv-small">
            <?php
                foreach($params['prices'] as $coin){
            ?>
            <div class="col w30 w100-dv-small">
                <p>Current Bid</p>
                <h2 class="limit-line-one"><?= $coin->price_24h ?> <?= $coin->symbol ?></h2>
                <p><?= $coin->last_trade_price ?> $</p>
            </div>
            <?php } ?>
            <div class="col w30 buttons">
                <a href="/market" class="button button-clean-purple mr-bottom-tiny">NFTs</a>
                <a href="/global-nfts" class="button button-clean">Explore</a>
            </div>
        </div>
    </div>
</main>

<section class="container-list mr-top-bigger mr-bottom-bigger">
    <div class="wrap w90 center">
        <div class="title mr-bottom-default">
            <h2 class="font-size-default">Last Users in Platform 🔥</h2>
        </div>
        <ul class="list items-flex flex-wrap">
            <?php 
                foreach($params['owners'] as $user){
            ?>
            <li class="item items-flex align-center">
                <figure class="img-user-bigger w40 mr-right-small">
                    <img src="<?= BASE_STORAGE_USERS . '/' . $user['image'] ?>" />
                </figure>
                <div class="w60">
                    <h4 class="mr-bottom-little"><?= $user['name'] ?></h4>
                    <p class="limit-line-one"><?= $user['email'] ?></p>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</section>

<section class="container-nfts mr-bottom-bigger">
    <div class="wrap w90 center">
        <div class="title mr-bottom-default text-center">
            <h2 class="font-size-default">Live Action 🔥</h2>
        </div>
        <div class="list-nfts items-flex just-center flex-wrap">
            <?php
                foreach($params['nfts'] as $nft){
                    foreach($params['owners'] as $owner){
                        if($nft['owner'] === $owner['id']) include 'components/box-nft.php';
                    }
                }
           ?>
        </div>
    </div>
</section>

<section class="container-collections mr-bottom-bigger">
    <div class="wrap w90 center">
        <div class="title mr-bottom-default text-center">
            <h2 class="font-size-default">Hot Stores 🔥</h2>
        </div>
        <div class="list-nfts items-flex flex-wrap just-center">
           <?php
                foreach($params['shops'] as $shop){
                    include 'components/box-shop.php';
                }
           ?>
        </div>
    </div>
</section>

<section class="container-infos mr-bottom-bigger">
    <div class="wrap w90 center items-flex align-center flex-wrap-dv-small">
        <div class="col w45 mr-right-small w100-dv-small mr-dv-bottom-default">
            <h2 class="font-title mr-bottom-small">Hot Collection 👍</h2>
            <h4 class="w80">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent laoreet congue tortor.</h4>
            <a class="button w30 mr-top-default">Explode</a>
        </div>
        <div class="col w55 w100-dv-small">
            <div class="row items-flex just-space-between mr-bottom-small flex-wrap">
                <div class="item w48 w100-dv-small mr-dv-bottom-small">
                    <a class="icon mr-bottom-small"><i class="ri-wallet-3-line"></i></a>
                    <h4 class="mr-bottom-small">Hot Collection</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent laoreet <br /> congue tortor.</p>
                </div>
                <div class="item w48 w100-dv-small mr-dv-bottom-small">
                    <a class="icon mr-bottom-small"><i class="ri-wallet-3-line"></i></a>
                    <h4 class="mr-bottom-small">Hot Collection</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent laoreet <br /> congue tortor.</p>
                </div>
            </div>
            <div class="row items-flex just-space-between flex-wrap">
                <div class="item w48 w100-dv-small mr-dv-bottom-small">
                    <a class="icon mr-bottom-small"><i class="ri-wallet-3-line"></i></a>
                    <h4 class="mr-bottom-small">Hot Collection</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent laoreet <br /> congue tortor.</p>
                </div>
                <div class="item w48 w100-dv-small mr-dv-bottom-small">
                    <a class="icon mr-bottom-small"><i class="ri-wallet-3-line"></i></a>
                    <h4 class="mr-bottom-small">Hot Collection</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent laoreet <br /> congue tortor.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container-invite">
    <div class="wrap items-flex align-center w90 center banner-action">
        <div class="col w50 w100-dv-small">
            <h2 class="font-title-small mr-bottom-small">Are you create collection?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras pulvinar, elit a bibendum facilisis, ligula nunc tempus ipsum, in vulputate purus nunc ut magna. Ut augue orci, volutpat nec imperdiet vel, venenatis ut urna. Pellentesque ac viverra sapien. Duis vel nisi et lorem pharetra tempus nec sed ligula.</p>
            <form class="form-custom items-flex align-center pos-relative mr-top-small">
                <input type="text" class="w100" placeholder="You text here" />
                <button class="button-white w20 w40-dv-small">Get start</button>
            </form>
        </div>
        <div class="col w50 hide-dv-small"></div>
    </div>
</section>