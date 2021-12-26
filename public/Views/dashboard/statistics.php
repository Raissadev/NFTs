<section class="mr-top-small">
    <div class="w95 center">
        <h2>Statistics</h2>
    </div>
</section>

<section class="mr-top-small">
    <div class="wrap w95 center items-flex align-center just-space-between flex-wrap-dv-small">
        <div class="box w30 items-flex align-center just-space-between w100-dv-small mr-dv-bottom-small">
            <div class="w50">
                <p class="mr-bottom-tiny">Number of NFTs</p>
                <h1><?= count($params['nfts']); ?></h1>
            </div>
            <a class="icon-default text-right">
                <i class="ri-quill-pen-fill"></i> 
            </a>
        </div>
        <div class="box w30 items-flex align-center just-space-between w100-dv-small mr-dv-bottom-small">
            <div class="w50">
                <p class="mr-bottom-tiny">Your shops</p>
                <h1><?= count($params['shops']); ?></h1>
            </div>
            <a class="icon-default text-right">
                <i class="ri-quill-pen-fill"></i> 
            </a>
        </div>
        <div class="box w30 items-flex align-center just-space-between w100-dv-small">
            <div class="w50">
                <p class="mr-bottom-tiny">Users</p>
                <h1><?= count($params['nfts']); ?></h1>
            </div>
            <a class="icon-default text-right">
                <i class="ri-quill-pen-fill"></i> 
            </a>
        </div> 
    </div>
</section>

<section class="mr-top-default">
    <div class="w95 center">
        <h2>More infos</h2>
        <div class="box-chart mr-top-small">
            <div id="chart"></div>
        </div>
    </div>
</section>

<section class="container-table mr-top-default">
    <div class="wrap w95 center">
        <table class="box w100">
            <thead>
                <tr>
                    <td><h4>Currency</h4></td>
                    <td><h4>Currency Scale</h4></td>
                    <td><h4>Min Price</h4></td>
                    <td><h4>Auction Price</h4></td>
                    <td><h4>Auction Size</h4></td>
                    <td><h4>Imbalance</h4></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($params['symbols'] as $symbol){ ?>
                <tr>
                    <td><p><?= $symbol->counter_currency ?></p></td>
                    <td><p><?= $symbol->base_currency_scale ?></p></td>
                    <td><p><?= $symbol->status ?></p></td>
                    <td><p><?= $symbol->min_price_increment_scale ?></p></td>
                    <td><p><?= $symbol->auction_price ?></p></td>
                    <td><p><?= $symbol->auction_size ?></p></td>
                    <td><p><?= $symbol->imbalance ?></p></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'js/charts.php'; ?>