<div class="divisor"></div>

<section class="items-flex just-space-between w95 center mr-top-default flex-wrap">

<aside class="container-search mr-bottom-default w20 w100-dv-small">
    <form method="GET" action="/market" class="wrap w100 items-flex flex-wrap">
        <div class="w100 mr-bottom-small">
            <input type="text" name="search" placeholder="Search..." class="w100 mr-bottom-small" />
            <select name="shop" class="w100">
                <?php
                    foreach($params['shops'] as $shop){
                ?>
                <option value="<?= $shop['id'] ?>"><?= $shop['name'] ?></option>
                <?php } ?>
            </select>
            <div class="mr-top-small items-flex align-center">
                <input type="text" name="price_min" value="1.000.00" class="w50 mr-right-tiny" placeholder="Price min" />
                <input type="text" name="price_max" value="10.000.00" class="w50 mr-left-tiny" placeholder="Price max" />
            </div>
        </div>
        <div class="items-flex flex-wrap w100 mr-bottom-small">
            <a class="button rounded-edge"> <input type="checkbox" onclick="check(this, event)" name="crypto_type" checked value="" data-check /> All </a>
            <?php
                foreach($params['filter'] as $nft){
            ?>
            <a class="button rounded-edge"> <input type="checkbox" onclick="check(this, event)" name="crypto_type" value="<?= $nft['crypto_type'] ?>" data-check /> <?= $nft['crypto_type'] ?> </a>
            <?php } ?>
        </div>
        <button type="submit" name="search-nft" id="search" class="button-black w100 mr-right-tiny">Search</button>
    </form>
</aside>

<section class="container-shop w80 w100-dv-small">
    <div class="wrap w95 center">
        <div class="list-nfts flex-wrap items-flex">
           <?php
                foreach($params['nfts'] as $nft){
                    foreach($params['owners'] as $owner){
                        if($nft['owner'] === $owner['id']) include 'components/box-nft-simple.php';
                    }
                }
           ?>
        </div>
    </div>
</section>

</section>

<script src="<?= BASE_PATH ?>/js/search.js"></script>
