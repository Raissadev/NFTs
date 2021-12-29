</section>

<aside class="aside-infos">
    <div class="wrap w90 center">
        <div class="row mr-bottom-small">
            <h5>Last NFTs</h5>
            <ul class="list-items mr-top-small">
                <?php
                    foreach($params['lastNFTs'] as $nft){
                ?>
                <li class="line-box items-flex align-center mr-bottom-small">
                    <figure class="img-small mr-right-small">
                        <img src="<?= BASE_STORAGE_NFTS ?>/<?= $nft['image'] ?>" />
                    </figure>
                    <div class="row">
                        <h5 class="limit-line-one"> <a style="color:var(--purple)">New Nft</a> <?= $nft['name'] ?> </h5>
                        <h5 class="font-size-small"><?= $nft['crypto_price'] ?> <?= $nft['crypto_type'] ?></h5>
                        <p class="font-size-small"><?= substr($nft['created_at'], 0, -7) ?></p>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="row">
            <h5>Users Artists</h5>
            <ul class="list-items mr-top-small">
                <?php
                    foreach($params['owners'] as $owner){
                ?>
                <li class="items-flex align-center mr-bottom-small">
                    <figure class="img-small mr-right-small w20">
                        <img src="<?= BASE_STORAGE_USERS ?>/<?= $owner['image'] ?>" />
                    </figure>
                    <div class="row items-flex align-center w70">
                        <div class="w70 mr-right-small">
                            <h5 class="limit-line-one"> <?= $owner['name'] ?> </h5>
                            <p class="font-size-small limit-line-one"><?= $owner['email'] ?></p>
                        </div>
                        <div class="w30">
                            <a href="/shop-vendor/?id=<?= $nft['owner'] ?>" class="button button-purple w100 button-small">View</a>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</aside>

</main>

<script src="<?= BASE_PATH ?>/js/global.js"></script>