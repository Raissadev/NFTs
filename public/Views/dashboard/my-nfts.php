<section class="container-search mr-bottom-default">
    <form method="GET" action="/dashboard/my-nfts" class="wrap w95 center items-flex align-center just-space-between">
        <input type="text" name="name" class="w80 w65-dv-small" placeholder="Search your NFTs" />
        <button type="submit" name="search-my-nft" class="w15 w30-dv-small">Search</button>
    </form>
</section>

<section class="container-nfts container-my-nfts">
    <div class="wrap w95 center">
        <div class="list-nfts items-flex just-space-between flex-wrap">
            <?php
                foreach($params['nfts'] as $nft){
                    include 'components/box-nft.php';
                }
            ?>
        </div>
    </div>
</section>