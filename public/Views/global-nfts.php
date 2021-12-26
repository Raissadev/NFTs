<div class="divisor"></div>

<section class="container-global-nfts container-shop w95 center mr-top-default">
    <div class="wrap w95 center">
        <div class="list-nfts flex-wrap items-flex">
           <?php
                foreach($params['nfts']->data->nfts as $nft){
                    include 'components/box-global-nft.php';
                }
           ?>
        </div>
    </div>
</section>


