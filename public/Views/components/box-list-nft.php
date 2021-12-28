<div class="box-nft box-collection pos-relative">
    <figure class="img-default-collection">
        <img src="<?= BASE_STORAGE_NFTS . '/' . $nft['image'] ?>" />
    </figure>
    <div class="row items-flex align-center just-space-between">
        <h4><?= $nft['name'] ?></h5>
        <form method="POST" action="/download-file" class="w30">
            <input type="hidden" name="image-nft" value="<?= $nft['image'] ?>" />
            <button type="submit" name="download-file" class="button button-clean-purple w100">Download</button>
        </form>
    </div>
</div>
