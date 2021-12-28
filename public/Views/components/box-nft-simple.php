<div class="box global-nft">
    <a href="/nft/?id=<?= $nft['id'] ?>">
        <figure class="img-default-nft mr-bottom-tiny">
            <img src="<?= BASE_STORAGE_NFTS . '/' . $nft['image'] ?>" />
        </figure>
        <div class="row">
            <h4><?= $nft['name'] ?></h4>
            <div class="items-flex mr-top-small">
                <figure class="img-user-tiny mr-right-tiny">
                    <img src="<?= BASE_STORAGE_USERS ?>/<?= $owner['image'] ?>" />
                </figure>
                <div>
                    <h5 class="font-size-small mr-bottom-little">Creator</h5>
                    <h5 class="font-size-little"><?= $owner['name'] ?></h5>
                </div>
            </div>
            <div class="mr-top-small">
                <p class="font-size-little mr-bottom-tiny">Current Bid</p>
                <div class="items-flex align-center just-space-between">
                    <h4 class="price"><?= $nft['crypto_price'] ?> <?= $nft['crypto_type'] ?></h4>
                    <h5><?= $nft['price'] ?> $</h5>
                </div>
            </div>
        </div>
    </a>
</div>