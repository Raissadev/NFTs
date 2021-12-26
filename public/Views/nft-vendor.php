<div class="divisor"></div>

<?php include 'components/box-message.php' ?>

<section class="items-flex h100vh">

    <section class="container-single-nft w70">
        <div class="wrap box w95 center items-flex just-space-between">
            <div class="col w45">
                <figure class="img-very-bigger-nft">
                    <img src="<?= BASE_STORAGE_NFTS . '/' . $params['nft']['image'] ?>" />
                </figure>
            </div>
            <div class="col w50">
                <div class="text-infos mr-top-small mr-bottom-default">
                    <h1 class="font-title mr-bottom-small"><?= $params['nft']['name'] ?></h1>
                    <h5 class="mr-bottom-small"><?= $params['nft']['description'] ?></h5>
                    <p><?= $params['nft']['quantity'] ?> in Stock</p>
                </div>
                <div class="items-flex align-center mr-bottom-bigger">
                    <figure class="img-user-small mr-right-tiny">
                        <img src="<?= BASE_STORAGE_USERS . '/' . $params['owner']['image'] ?>" />
                    </figure>
                    <h5><?= $params['owner']['name'] ?></h5>
                </div>
                <div class="item items-flex align-center just-space-betweeen mr-bottom-default">
                    <div class="col w50">
                        <p class="font-size-little mr-bottom-little">Current Bit</p>
                        <h2><?= $params['nft']['price_crypto'] ?> <?= $params['nft']['crypto_type'] ?></h2>
                    </div>
                    <div class="col w50">
                        <p class="font-size-little mr-bottom-little">Price in Dolar</p>
                        <h2><?= $params['nft']['price'] ?> $</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="container-form-nft w30">
        <form method="POST" action="/nft/?id=<?= $params['nft']['id'] ?>" class="wrap box w95 center">
            <input type="text" name="name" placeholder="Your name" value="<?= $_SESSION['name'] ?>" class="w100 mr-bottom-small" />   
            <input type="text" name="email" placeholder="Your email" value="<?= $_SESSION['email'] ?>" class="w100 mr-bottom-small" /> 
            <input type="text" name="guid" placeholder="Address your blockchain" value="<?= $params['blockchain']['blockchain'] ?>" class="w100 mr-bottom-small" />
            <input type="password" name="password" placeholder="Password your blockchain" value="<?= $params['blockchain']['blockchain_password'] ?>" class="w100 mr-bottom-small" />   
            <input type="hidden" name="to" value="<?= $params['owner']['blockchain'] ?>" />   
            <input type="hidden" name="amount" value="<?= $params['nft']['price_crypto'] ?>" />   
            <button type="submit" name="buy" class="w30 center">Buy now</button>   
        </form>
    </section>


</section>
