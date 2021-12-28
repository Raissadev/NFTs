<div class="box-nft box-collection pos-relative">
    <figure class="img-default-collection">
        <img src="<?= BASE_STORAGE_NFTS . '/' . $nft['image'] ?>" />
    </figure>
    <div class="row items-flex align-center just-space-between">
        <h4><?= $nft['name'] ?></h5>
        <a href="<?= BASE_STORAGE_NFTS . '/' . $nft['image'] ?>" download class="button button-clean-purple w30">Download</a>
    </div>
</div>
