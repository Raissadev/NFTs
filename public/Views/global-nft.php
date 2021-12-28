<div class="divisor"></div>

<?php include 'components/box-message.php' ?>

<section class="items-flex h100vh flex-wrap-dv-small">

    <section class="container-single-nft w70 w100-dv-small mr-dv-bottom-small">
        <div class="wrap box w95 center items-flex just-space-between flex-wrap-dv-small">
            <div class="col w45 w100-dv-small mr-dv-bottom-small">
                <figure class="img-very-bigger-nft">
                    <img src="<?= $params['nft']->data->nft->image ?>" />
                </figure>
            </div>
            <div class="col w50 w100-dv-small">
                <div class="text-infos mr-top-small mr-bottom-default">
                    <h1 class="font-title mr-bottom-small"><?= $params['nft']->data->nft->name ?></h1>
                    <h5 class="mr-bottom-small"><?= $params['nft']->data->nft->dappDescription ?></h5>
                    <p><?= $params['nft']->data->nft->auctionCreatedAt ?> Auction Created At</p>
                </div>
                <div class="items-flex align-center mr-bottom-bigger">
                    <figure class="img-user-small mr-right-tiny">
                        <img src="<?= $params['nft']->data->nft->dappImage ?>" />
                    </figure>
                    <h5><a target="_blank" href="<?= $params['nft']->data->nft->externalUrl ?>">External Url</a></h5>
                </div>
                <div class="item items-flex align-center just-space-betweeen mr-bottom-default">
                    <div class="col w50">
                        <p class="font-size-little mr-bottom-little limit-line-one">Current Bit</p>
                        <h2 class="limit-line-one"><?= $params['nft']->data->nft->price ?> <?= $params['nft']->data->nft->registryBlockchain ?></h2>
                    </div>
                    <div class="col w50">
                        <p class="font-size-little mr-bottom-little limit-line-one">Price in Dolar</p>
                        <h2 class="limit-line-one"><?= $params['nft']->data->nft->priceInDollar ?> $</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="container-form-nft w30 w100-dv-small">
        <form method="POST" action="/nft/?id=<?= $params['nft']->data->id ?>" class="wrap box w95 center">
            <input type="text" name="name" placeholder="Your name" value="<?= $_SESSION['name'] ?>" class="w100 mr-bottom-small" />   
            <input type="text" name="email" placeholder="Your email" value="<?= $_SESSION['email'] ?>" class="w100 mr-bottom-small" /> 
            <input type="text" name="guid" placeholder="Address your blockchain" value="<?= $params['blockchain']['blockchain'] ?>" class="w100 mr-bottom-small" />
            <input type="password" name="password" placeholder="Password your blockchain" value="<?= $params['blockchain']['blockchain_password'] ?>" class="w100 mr-bottom-small" />   
            <input type="hidden" name="to" value="<?= $params['nft']->data->nft->payout_address ?>" />   
            <input type="hidden" name="amount" value="<?= $params['nft']->data->nft->price ?>" />   
            <button type="submit" name="buy" class="w30 center w40-dv-small">Buy now</button>   
        </form>
    </section>


</section>
