<?php include 'components/box-message.php'; ?>

<section class="container-form container-my-nft">
    <div class="wrap w95 center">
        <form method="POST" action="/dashboard/my-nft/?id=<?= $params['nft']['id'] ?>" enctype="multipart/form-data" class="form-box items-flex flex-wrap just-space-between">
            <div class="w50 w100-dv-small mr-dv-bottom-small">    
                <figure class="img-bigger-nft">
                    <img src="<?= BASE_STORAGE_NFTS . '/' . $params['nft']['image'] ?>" />
                </figure>
            </div>
            <div class="w45 w100-dv-small">
                <input type="text" name="name" class="w100 mr-bottom-small" value="<?= $params['nft']['name'] ?>" placeholder="Name of your NFT" />
                <input type="text" name="description" class="w100 mr-bottom-small" value="<?= $params['nft']['description'] ?>" placeholder="Description of your NFT" />
                <select name="shop" value="<?= $params['nft']['shop'] ?>" class="w100 mr-bottom-small">
                <?php foreach($params['shops'] as $shop){ ?>
                    <option value="<?= $shop['id'] ?>"><?= $shop['name'] ?></option>
                <?php } ?>
                </select>
                <select name="collection" class="w100 mr-bottom-small">
                    <?php foreach($params['collections'] as $collection){ ?>
                    <option value="<?= $collection['id'] ?>"><?= $collection['name'] ?></option>
                    <?php } ?>
                </select>
                <select name="crypto_type" class="w100 mr-bottom-small">
                    <option value="BTC">Bitcoin</option>
                </select>
                <select name="currency" class="w100 mr-bottom-small">
                    <option value="USD">Dólar</option>
                    <option value="BRL">Real</option>
                    <option value="AUD">Dólar australiano</option>
                    <option value="CAD">Dólar canadense</option>
                </select>
                <input type="text" name="price" size="12" onKeyUp="coinMask(this, event)" value="<?= $params['nft']['price'] ?>" class="w100 mr-bottom-small" placeholder="Price of your NFT in Dolar" />
                <input type="text" name="blockchain" value="<?= $params['nft']['blockchain'] ?>" class="w100 mr-bottom-small" placeholder="Your blockchain" />
                <button type="submit" name="update-nft" class="w100">Update NFT <i class="ri-quill-pen-fill mr-left-small"></i></button>
            </div>
        </form>
    </div>
</section>


<script src="<?= BASE_PATH ?>/js/mask.js"></script>