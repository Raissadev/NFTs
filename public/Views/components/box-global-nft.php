<div class="box box-nft global-nft">
    <a target="_blank" href="<?= BASE_URL ?>/global-nft/?id=<?= $nft->id ?>">
        <figure class="img-default-nft mr-bottom-tiny">
            <img src="<?= $nft->image ?>" />
        </figure>
        <div class="row">
            <h4><?= $nft->name ?></h4>
            <div class="mr-top-small">
                <p class="font-size-little mr-bottom-tiny">Current Bid</p>
                <div class="items-flex align-center just-space-between">
                    <h4 class="price mr-right-small"><?= $nft->price ?></h4>
                    <h5 class="limit-line-one"><?= $nft->priceInDollar ?> $</h5>
                </div>
            </div>
        </div>
    </a>
</div>

<!--<?= $nft->externalUrl ?>-->