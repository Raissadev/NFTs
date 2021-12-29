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
            <a> <input type="checkbox" id="crypto_type-all" name="crypto_type" checked value="" data-check /> <label for="crypto_type-all" class="button rounded-edge"> All </label> </a>
            <a> <input type="checkbox" id="crypto_type-BTC" name="crypto_type" value="BTC" data-check /> <label for="crypto_type-BTC" class="button rounded-edge"> Bitcoin </label> </a>
        </div>
        <div class="items-flex flex-wrap w100 mr-bottom-small">
            <a> <input type="checkbox" name="collection" id="collection-1" checked value="1" data-check /> <label for="collection-1" class="button rounded-edge"> All </label> </a>
            <?php
                foreach($params['collections'] as $collection){
            ?>
            <a> 
                <input type="checkbox" name="collection" id="collection-<?= $collection['id'] ?>" value="<?= $collection['id'] ?>" /> 
                <label class="button rounded-edge button-default" for="collection-<?= $collection['id'] ?>"><?= $collection['name'] ?> </label>
            </a>
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
