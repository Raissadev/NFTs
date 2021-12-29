<div class="divisor"></div>

<section class="container-shop mr-top-small mr-bottom-default">
    <div class="wrap w90 center">
        <figure class="img-bigguer-banner-shop">
            <img src="<?= BASE_STORAGE_COLLECTIONS ?>/<?= $params['collection']['banner'] ?>" />
        </figure>
        <div class="row-infos text-center mr-bottom-default">
            <figure class="img-user-very-bigger mr-bottom-tiny">
                <img src="<?= BASE_STORAGE_COLLECTIONS ?>/<?= $params['collection']['banner'] ?>" />
            </figure>
            <h1 class="font-title-small mr-bottom-tiny"><?= $params['collection']['name'] ?></h1>
            <p><?= $params['collection']['about'] ?></p>
        </div>
    </div>
</section>

<section class="container-shop-vendor-nfts mr-bottom-bigger">
    <div class="wrap w90 center">
        <div class="title mr-bottom-default text-center">
            <h2 class="font-size-default">NFTs <?= $params['collection']['name'] ?> 🔥</h2>
        </div>
        <div class="list-nfts items-flex flex-wrap">
        <?php
                foreach($params['nfts'] as $nft){
                    foreach($params['owners'] as $owner){
                        if($nft['owner'] === $owner['id']) include 'components/box-nft-simple.php';
                    }
                }
           ?>
        </div>
    </div>
</section>