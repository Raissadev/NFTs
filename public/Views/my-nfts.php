<div class="divisor"></div>

<section class="container-collections mr-top-bigger">
    <div class="wrap w90 center">
        <div class="title mr-bottom-default">
            <h2 class="font-size-default">Your NFTs</h2>
        </div>
        <div class="list-nfts items-flex flex-wrap">
           <?php
                foreach($params['nftsClient']as $nft){
                    include 'components/box-list-nft.php';
                }
           ?>
        </div>
    </div>
</section>
