<section class="container-banner-dashboard mr-bottom-default">
    <div class="wrap w95 center">
        <figure class="banner-dashboard items-flex align-end flex-wrap">
            <h2 class="font-size-default w100 mr-bottom-small"> Discover, Collect, and Sell <br /> Various Extraordinary NFTs </h2>
            <div class="buttons items-flex align-center w100">
                <a href="/market" class="button button-purple w10 mr-right-small">Explore</a>
                <a href="/dashboard/register-nft" class="button button-clean w10">Create</a>
            </div>
        </figure>
    </div>
</section>

<section class="container-nfts">
    <div class="wrap w95 center">
        <div class="row items-flex align-center just-space-between mr-bottom-small">
            <h2 class="font-size-default w50 mr-bottom-small"> Tranding Auction </h2>
            <a href="/dashboard/my-nfts" class="button button-purple w15">View all</a>
        </div>
        <div class="list-nfts items-flex just-space-between">
            <?php
                foreach($params['nfts'] as $nft){
                    include 'components/box-nft.php';
                }
            ?>
        </div>
    </div>
</section>