<?php require ROOT . '/views/partials/header.php' ?>

<?php require ROOT . '/views/partials/navbar.php' ?>

    <div class="container">
        <h1><?php echo $full_name; ?></h1>
        <h3><?php echo $email; ?></h3>
        <h3><?php echo $phone_number; ?></h3>

        <a href="/user/edit">Редактировать</a>
        <br>
        <a href="/user/remove">Удалить</a>

        <div class="col s12" style="margin-top: 50px;">
            <ul class="tabs">
                <li class="tab col s6"><a class="active" href="#sales">Продажа</a></li>
                <li class="tab col s6"><a href="#rents">Аренда</a></li>
            </ul>
        </div>

        <div id="sales">
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
        <div id="rents">
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

<?php require ROOT . '/views/partials/footer.php' ?>