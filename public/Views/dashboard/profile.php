<?php include 'components/box-message.php'; ?>

<section class="container-form">
    <div class="wrap w95 center">
        <form method="POST" action="/dashboard/profile" enctype="multipart/form-data" class="form-box items-flex flex-wrap just-space-between">
            <div class="w50 w100-dv-small mr-dv-bottom-small">    
                <input type="text" name="name" value="<?= $params['user']['name'] ?>" class="w100 mr-bottom-small" placeholder="Name of your NFT" autocomplete="off" />
                <input type="text" name="email" value="<?= $params['user']['email'] ?>" class="w100 mr-bottom-small" placeholder="Description of your NFT" />
                <input type="password" name="blockchain" value="<?= $params['blockchain']['blockchain'] ?>" class="w100 mr-bottom-small" value="<?= $params['blockchain']['blockchain'] ?>" placeholder="Your blockchain" />
                <input type="password" name="blockchain_password" value="<?= $params['blockchain']['blockchain_password'] ?>" class="w100 mr-bottom-small" value="<?= $params['blockchain']['blockchain_password'] ?>" placeholder="Your blockchain" />
                <input type="file" name="image" value="<?= $params['user']['image'] ?>" class="w100 mr-bottom-small" />
            </div>
            <div class="w40 w100-dv-small">
                <label class="send-file mr-bottom-small">
                    <img src="<?= BASE_STORAGE_USERS . '/' . $params['user']['image'] ?>" />
                </label>
                <button type="submit" name="update-profile" class="w100">Update Profile <i class="ri-quill-pen-fill mr-left-small"></i></button>
            </div>
        </form>
    </div>
</section>

