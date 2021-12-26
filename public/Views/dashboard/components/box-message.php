<?php  if (isset($_SESSION['message'])){ ?>

<div class="alert <?= $_SESSION['type']; ?>">
    <p><?= $_SESSION['message']; ?></p>
</div>

<?php unset($_SESSION['message']); unset($_SESSION['type']); } ?>