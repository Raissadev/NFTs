<div class="divisor"></div>

<section class="container-list-collections mr-bottom-default mr-top-default">
    <figure class="wrap banner-collection-bigger items-flex align-center w80 center">
        <h1 class="font-title">Discover, collect and sell <br /> Extraordinary NFT's</h1>
    </figure>
</section>

<section class="container-list-collections mr-bottom-default mr-top-default">
    <div class="wrap w80 center">
        <h4 class="mr-bottom-small">Owners Collections</h4>
        <ul class="items-flex align-center">
            <?php foreach($params['users'] as $user){ ?>
            <li class="box box-user text-center">
                <figure>
                    <img src="<?= BASE_STORAGE_USERS . '/' . $user['image'] ?>" class="img-small" />
                </figure>
                <h5 class="mr-bottom-little"><?= $user['name'] ?></h5>
                <p class="font-size-small limit-line-one"><?= $user['email'] ?></p>
            </li>
            <?php } ?>
        </ul>
    </div>
</section>

<section class="container-collections mr-bottom-default mr-top-default">
    <div class="wrap w80 center">
        <h4 class="mr-bottom-small">Collections NFT's</h4>
        <div class="list-nfts items-flex flex-wrap">
           <?php
                foreach($params['collections'] as $collection){
                    include 'components/box-collection.php';
                }
           ?>
        </div>
    </div>
</section>


<!-- <section class="container-list-collections mr-bottom-default">
    <form class="wrap items-flex align-center">
        <a> <input type="checkbox" name="" id="" /> <label for="">  </label> </a>
    </form>
</section> -->