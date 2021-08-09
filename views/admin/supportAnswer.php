<?php require_once ROOT . '/views/partials/header.php' ?>

<div class="container">
    <h2>Сообщение</h2>
    <p><?= $message['text']?></p>
    <hr>
    <h2>Ответ</h2>
    <form action="/admin/support/<?= $message['id'] ?>" method="POST">
        <input type="hidden" name="email" value="<?= $message['email']?>">
        <textarea class="materialize-textarea" name="answer" id="answer" rows="20"></textarea>
        <input type="submit" name="submit" class="btn" value="Отправить">
    </form>
</div>

<?php require_once ROOT . '/views/partials/footer.php' ?>
