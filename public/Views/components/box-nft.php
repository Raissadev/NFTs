<div class="box box-nft">
    <figure class="img-bigger-nft pos-relative">
        <img src="<?= BASE_STORAGE_NFTS ?>/<?= $nft['image'] ?>" />
        <img src="<?= BASE_STORAGE_USERS ?>/<?= isset($owner['image']) ? $owner['image'] : $params['owner']['image'] ?>" class="img-small" /> 
    </figure>
    <div class="wrap w95">
        <div class="row items-flex mr-bottom-small">
            <div class="col w70">
                <h2 class="mr-bottom-tiny limit-line-one"><?= $nft['name'] ?></h2>
                <p>by <?= isset($owner['name']) ? $owner['name'] : $params['owner']['name'] ?></p>
            </div>
            <div class="col w30 text-center">
                <a class="button button-clean-purple mr-bottom-tiny w90 center"><?= $nft['crypto_price'] ?> <?= $nft['crypto_type'] ?></a>
                <p class="limit-line-one"><?= $nft['quantity'] ?> in stock</p>
            </div>
        </div>
        <form class="row items-flex align-center just-space-between w90 center">
            <a href="/nft/?id=<?= $nft['id'] ?>" class="button w55">Place bid</a>
            <a href="/shop-vendor/?id=<?= $nft['owner'] ?>" class="button button-clean w40">View</a>
        </form>
    </div>
</div>