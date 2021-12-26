<?php include 'components/box-message.php' ?>

<section class="container-auth h100vh items-flex align-center just-center">
    <form method="POST" action="/sign-in" class="wrap w50 box-auth items-flex align-center just-center direction-column">
        <input type="text" name="email" placeholder="Your email" class="w100 mr-bottom-small" />
        <input type="password" name="password" placeholder="Your password" class="w100 mr-bottom-small" />
        <button type="submit" name="sign-in" class="button-black w30 center">Sign In</button>
        <div class="mr-top-small text-right w100">
            <p>Don't have an account? <a href="/sign-up"> Click here! </a></p>
        </div>
    </form>
</section>