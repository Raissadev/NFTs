<div class="divisor"></div>


<section class="container-shop mr-top-small mr-bottom-default">
    <div class="wrap w90 center">
        <figure class="img-bigguer-banner-shop">
            <img src="<?= BASE_STORAGE_SHOPS ?>/<?= $params['shop']['banner'] ?>" />
        </figure>
        <div class="row-infos text-center mr-bottom-default">
            <figure class="img-user-very-bigger mr-bottom-tiny">
                <img src="<?= BASE_STORAGE_USERS ?>/<?= $params['owner']['image'] ?>" />
            </figure>
            <h1 class="font-title-small mr-bottom-tiny"><?= $params['owner']['name'] ?></h1>
            <p><?= $params['owner']['email'] ?></p>
        </div>
    </div>
</section>

<section class="container-shop-vendor-nfts mr-bottom-bigger">
    <div class="wrap w90 center">
        <div class="title mr-bottom-default text-center">
            <h2 class="font-size-default">NFTs <?= $params['shop']['name'] ?> 🔥</h2>
        </div>
        <div class="list-nfts items-flex">
            <?php
                 foreach($params['nfts'] as $nft){
                    include 'components/box-nft.php';
                }
           ?>
        </div>
    </div>
</section>