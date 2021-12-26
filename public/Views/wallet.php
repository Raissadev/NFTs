<div class="divisor"></div>


<section class="mr-top-default mr-bottom-default">
    <div class="wrap box items-flex align-center just-space-between w90 center">
        <figure class="img-bigguer-banner-shop w50">
            <img src="<?= BASE_STORAGE_IMAGES ?>/crypto.jpg" />
        </figure>

        <form method="POST" action="/request-wallet" class="w50 wallet mr-left-default form-request-wallet">
            <h1 class="mr-bottom-small">Request Your Wallet</h1>
            <input type="text" name="email" placeholder="Your email" class="w100 mr-bottom-small" />
            <input type="password" name="password" placeholder="Your password" class="w100 mr-bottom-small" />
            <button type="submit" name="request-wallet" class="button-black w30 mr-bottom-default">Register Wallet</button>
            <p class="button-next text-right">Don't have a Blockchain account? <a class="next"> Click here! </a> </p>
        </form>

        <form method="POST" action="/create-wallet" class="w50 wallet form-create-wallet mr-left-default hide">
            <h1 class="mr-bottom-small">Register Your Wallet</h1>
            <input type="text" name="blockchain" placeholder="Your key blockchain" class="w100 mr-bottom-small" />
            <input type="text" name="blockchain_password" placeholder="Your key blockchain" class="w100 mr-bottom-small" />
            <button type="submit" name="register-wallet" class="button-black w30 mr-bottom-default">Register Wallet</button>
            <p class="button-previous text-right">Already have a Blockchain account? <a class="next"> Click here! </a> </p>
        </form>

    </div>
</section>


<script src="<?= BASE_PATH ?>/js/form.js"></script>
