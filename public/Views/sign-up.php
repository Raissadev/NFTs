<?php include 'components/box-message.php' ?>

<section class="container-auth h100vh items-flex align-center just-center">
    <form method="POST" action="/sign-up" enctype="multipart/form-data" class="wrap w50 box-auth items-flex align-center just-center direction-column">
        <input type="text" name="name" placeholder="Your name" class="w100 mr-bottom-small" />
        <input type="text" name="email" placeholder="Your email" class="w100 mr-bottom-small" />
        <input type="password" name="password" placeholder="Your password" class="w100 mr-bottom-small" />
        <input type="file" name="image" class="w100 mr-bottom-small" />
        <button type="submit" name="sign-up" class="button-black w30 center">Sign Up</button>
        <div class="mr-top-small text-right w100">
            <p>Already have an account? <a href="/sign-in"> Click here! </a></p>
        </div>
    </form>
</section>

