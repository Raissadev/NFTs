<section class="container-banner-dashboard mr-bottom-default">
    <div class="wrap w95 center">
        <figure class="banner-dashboard items-flex align-end flex-wrap">
            <h2 class="font-size-default w100 mr-bottom-small"> Discover, Collect, and Sell <br /> Various Extraordinary NFTs </h2>
            <div class="buttons items-flex align-center w100">
                <a href="/market" class="button button-purple w10 mr-right-small w40-dv-small">Explore</a>
                <a href="/dashboard/register-nft" class="button button-clean w10 w40-dv-small">Create</a>
            </div>
        </figure>
    </div>
</section>

<section class="container-nfts">
    <div class="wrap w95 center">
        <div class="row items-flex align-center just-space-between mr-bottom-small">
            <h2 class="font-size-default w50"> Tranding Auction </h2>
            <a href="/dashboard/my-nfts" class="button button-purple w15 w40-dv-small">View all</a>
        </div>
        <div class="list-nfts items-flex just-space-between flex-wrap-dv-small">
            <?php
                foreach($params['lastNFTs'] as $nft){
                    include 'components/box-nft.php';
                }
            ?>
        </div>
    </div>
</section>