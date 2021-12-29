<?php include 'components/box-message.php'; ?>

<div class="divisor"></div>

<section class="container-form mr-top-small items-flex align-center just-center">
    <div class="wrap w80 w90-dv-small">
        <form method="POST" action="/profile" enctype="multipart/form-data" class="form-profile items-flex flex-wrap just-space-between">
            <div class="w50 w100-dv-small">    
                <input type="text" name="name" value="<?= $params['user']['name'] ?>" class="w100 mr-bottom-small" placeholder="Name of your NFT" autocomplete="off" />
                <input type="text" name="email" value="<?= $params['user']['email'] ?>" class="w100 mr-bottom-small" placeholder="Description of your NFT" />
                <input type="file" name="image" value="<?= $params['user']['image'] ?>" class="w100 mr-bottom-small" />
            </div>
            <div class="w40 w100-dv-small">
                <label class="send-file mr-bottom-small">
                    <img src="<?= BASE_STORAGE_USERS . '/' . $params['user']['image'] ?>" />
                </label>
                <button type="submit" name="update-profile-client" class="w100">Update Profile <i class="ri-quill-pen-fill mr-left-small"></i></button>
            </div>
        </form>
        <form method="POST" action="/update-blockchain" class="form-blockchain form-profile mr-top-small">
            <p>Blockchain</p>
            <div class="items-flex align-center mr-top-small flex-wrap-dv-small">
                <input type="password" name="blockchain-client" value="<?= $params['blockchain']['blockchain'] ?>" class="w40 mr-right-small w100-dv-small mr-dv-bottom-small mr-right-none" value="<?= $params['blockchain']['blockchain'] ?>" placeholder="Your blockchain" />
                <input type="password" name="blockchain-password" value="<?= $params['blockchain']['blockchain_password'] ?>" class="w40 mr-right-small w100-dv-small mr-dv-bottom-small mr-right-none" value="<?= $params['blockchain']['blockchain_password'] ?>" placeholder="Your blockchain" />
                <button type="submit" name="register-blockchain-client" class="w15 button-black w100-dv-small">Update</button>
            </div>
        </form>
    </div>
</section>


<section class="container-collections mr-top-bigger">
    <div class="wrap w80 center">
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

