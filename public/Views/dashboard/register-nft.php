<?php include 'components/box-message.php'; ?>

<section class="container-form">
    <div class="wrap w95 center">
        <form method="POST" action="/dashboard/register-nft" enctype="multipart/form-data" class="form-box items-flex flex-wrap just-space-between">
            <div class="w50 w100-dv-small mr-dv-bottom-small">    
                <input type="text" name="name" class="w100 mr-bottom-small" placeholder="Name of your NFT" autocomplete="off" />
                <input type="text" name="description" class="w100 mr-bottom-small" placeholder="Description of your NFT" />
                <select name="shop" class="w100 mr-bottom-small">
                    <?php foreach($params['shops'] as $shop){ ?>
                    <option value="<?= $shop['id'] ?>"><?= $shop['name'] ?></option>
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
                <input type="number" name="quantity" class="w100 mr-bottom-small" placeholder="Quantity of NFTs" autocomplete="off" />
                <input type="text" name="price" size="12" onKeyUp="coinMask(this, event)" class="w100 mr-bottom-small" autocomplete="off" placeholder="Price of your NFT in Dolar" />
                <input type="password" name="blockchain" class="w100 mr-bottom-small" value="<?= $params['blockchain'] ?>" placeholder="Your blockchain" />
            </div>
            <div class="w40 w100-dv-small">
                <label class="send-file mr-bottom-small">
                    <i class="ri-landscape-fill"></i>
                </label>
                <input type="file" name="image" class="w100 mr-bottom-small" />
                <button type="submit" name="register-nft" class="w100">Register NFT <i class="ri-quill-pen-fill mr-left-small"></i></button>
            </div>
        </form>
    </div>
</section>

<script src="<?= BASE_PATH ?>/js/mask.js"></script>