<?php include 'components/box-message.php'; ?>
<section class="container-form">
    <div class="wrap w95 center">
        <form method="POST" action="/dashboard/register-shop" enctype="multipart/form-data" class="form-box items-flex flex-wrap just-space-between">
            <div class="w50">    
                <input type="text" name="name" class="w100 mr-bottom-small" placeholder="Name of your NFT" />
                <input type="file" name="banner" class="w100 mr-bottom-small" />
                <button type="submit" name="register-shop" class="w100">Register Shop <i class="ri-quill-pen-fill mr-left-small"></i></button>
            </div>
            <div class="w40">
                <label class="send-file mr-bottom-small">
                    <i class="ri-landscape-fill"></i>
                </label>
            </div>
        </form>
    </div>
</section>

<script src="<?= BASE_PATH ?>/js/mask.js"></script>