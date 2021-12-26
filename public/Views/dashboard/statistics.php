<section class="mr-top-small">
    <div class="w95 center">
        <h2>Statistics</h2>
    </div>
</section>

<section class="mr-top-small">
    <div class="wrap w95 center items-flex align-center just-space-between">
        <div class="box w30 items-flex align-center just-space-between">
            <div class="w50">
                <p class="mr-bottom-tiny">Number of NFTs</p>
                <h1><?= count($params['nfts']); ?></h1>
            </div>
            <a class="icon-default text-right">
                <i class="ri-quill-pen-fill"></i> 
            </a>
        </div>
        <div class="box w30 items-flex align-center just-space-between">
            <div class="w50">
                <p class="mr-bottom-tiny">Your shops</p>
                <h1><?= count($params['shops']); ?></h1>
            </div>
            <a class="icon-default text-right">
                <i class="ri-quill-pen-fill"></i> 
            </a>
        </div>
        <div class="box w30 items-flex align-center just-space-between">
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


<?php include 'js/charts.php'; ?>