<?php require_once ROOT . '/views/partials/header.php' ?>

<?php require_once ROOT . '/views/partials/navbar.php' ?>

    <div class="container">
        <h1>Главная страница</h1>
        <h3>Продажа квартир</h3>
        <div class="card__wrapper row">
            <?php
            if (isset($sales) && count($sales)) {
                foreach ($sales as $announcement) {
                    $type = 'sale';
                    require ROOT . '/views/partials/card.php';
                }
            } else {
                echo '<h2>Нет объявлений о продаже</h2>';
            }
            ?>
        </div>
        <hr>
        <h3>Аренда квартир</h3>
        <div class="card__wrapper row">
            <?php
            if (isset($rents) && count($rents)) {
                foreach ($rents as $announcement) {
                    $type = 'rent';
                    require ROOT . '/views/partials/card.php';
                }
            } else {
                echo '<h2>Нет объявлений об аренде</h2>';
            }
            ?>
        </div>
    </div>

<?php require_once ROOT . '/views/partials/footer.php' ?>