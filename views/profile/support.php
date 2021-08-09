<?php require_once ROOT . '/views/partials/header.php' ?>

<?php require_once ROOT . '/views/partials/navbar.php' ?>

    <div class="container">

        <h1 style="margin-bottom: 100px">Обращение в поддержку</h1>
        <form action="/user/support" method="POST">
            <textarea class="materialize-textarea" name="text" id="text" rows="20"></textarea>
            <input type="submit" name="submit" class="btn" value="Отправить">
        </form>


    </div>

<?php require_once ROOT . '/views/partials/footer.php' ?>