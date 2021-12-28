<div class="divisor"></div>

<?php include 'components/box-message.php' ?>

<section class="container-collections mr-top-bigger h75vh">
    <div class="wrap w90 center">
        <div class="title mr-bottom-default">
            <h2 class="font-size-default">Your NFTs</h2>
        </div>
        <div class="list-nfts items-flex flex-wrap">
           <?php
                foreach($params['nftsClient'] as $nft){
                    include 'components/box-list-nft.php';
                }
           ?>
        </div>
    </div>
</section>
