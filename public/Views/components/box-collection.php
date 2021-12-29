<div class="box-nft box-collection pos-relative">
    <figure class="img-default-collection">
        <img src="<?= BASE_STORAGE_COLLECTIONS . '/' . $collection['banner'] ?>" />
    </figure>
    <div class="row items-flex align-center just-space-between">
        <h4><?= $collection['name'] ?></h5>
        <a href="/collection/?id=<?= $collection['id'] ?>" class="button button-clean-purple w30">Collection</a>
    </div>
</div>