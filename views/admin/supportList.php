<?php require_once ROOT . '/views/partials/header.php' ?>

<div class="container">
    <h1>Админка</h1>
    <div class="row">
        <?php foreach ($messages as $message):?>
        <div class="card__wrapper-inner">
            <div class="card" style="padding: 15px;">
                <h4><?= $message['email']?></h4>
                <p><?= $message['text']?></p>

                <a class="btn" href="/admin/support/<?= $message['id']?>">Перейти</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once ROOT . '/views/partials/footer.php' ?>
