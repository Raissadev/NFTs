<?php include 'components/box-message.php'; ?>

<section class="container-form">
    <div class="wrap w95 center">
        <form method="POST" action="/dashboard/register-collection" enctype="multipart/form-data" class="form-box items-flex flex-wrap just-space-between">
            <div class="w50 w100-dv-small mr-dv-bottom-small">    
                <input type="text" name="name" class="w100 mr-bottom-small" placeholder="Name of collection" autocomplete="off" />
                <input type="text" name="about" class="w100 mr-bottom-small" placeholder="Description of collection" />
                <input type="file" name="banner" class="w100 mr-bottom-small" />
            </div>
            <div class="w40 w100-dv-small">
                <label class="send-file mr-bottom-small">
                    <i class="ri-landscape-fill"></i>
                </label>
                <button type="submit" name="register-collection" class="w100">Register Collection <i class="ri-quill-pen-fill mr-left-small"></i></button>
            </div>
        </form>
    </div>
</section>

