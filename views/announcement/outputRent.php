<?php require_once ROOT . '/views/partials/header.php' ?>

<?php require_once ROOT . '/views/partials/navbar.php' ?>

<style>
    .input-field {
        margin: 15px 0 !important;
    }
</style>
<div class="container">

    <h1>Аренда</h1>
    <div class=" photosPreview carousel carousel-slider">
        <?php
        foreach ($photos as $photo) {
            ?>
            <a class="carousel-item"><img src="<?= "/uploads/image/rent/$photo[name_photo]" ?>"
                                          style="object-fit: contain; height: 100%"></a>
            <?php
        }
        ?>
    </div>

    <div class="row s12" style="margin-top: 50px;">
        <div class="input-field col s4">
            <fieldset style="border-color: #EE6E73;">
                <legend>Общая площадь</legend>
                <h5 style="margin: 0;"><?= $announcement['total_area'] ?></h5>
            </fieldset>
        </div>


        <div class="input-field col s4">
            <fieldset style="border-color: #EE6E73;">
                <legend>Жилая площадь</legend>
                <h5 style="margin: 0;"><?= $announcement['living_area'] ?></h5>
            </fieldset>
        </div>


        <div class="input-field col s4">
            <fieldset style="border-color: #EE6E73;">
                <legend>Площадь кухни</legend>
                <h5 style="margin: 0;"><?= $announcement['kitchen_area'] ?></h5>
            </fieldset>
        </div>

        <div class="input-field col s8">
            <fieldset style="border-color: #EE6E73;">
                <legend>Балкон</legend>
                <h5 style="margin: 0;"><?= $announcement['balcony'] ?></h5>
            </fieldset>
        </div>


        <div class="input-field col s4">
            <fieldset style="border-color: #EE6E73;">
                <legend>Цена</legend>
                <h5 style="margin: 0;"><?= $announcement['price'] ?> BYN</h5>
            </fieldset>
        </div>

        <div class="input-field col s4">
            <fieldset style="border-color: #EE6E73;">
                <legend>Тип дома</legend>
                <h5 style="margin: 0;"><?= $announcement['type_house'] ?></h5>
            </fieldset>
        </div>

        <div class="input-field col s4">
            <fieldset style="border-color: #EE6E73;">
                <legend>Этаж</legend>
                <h5 style="margin: 0;"><?= $announcement['floor'] ?>/<?= $announcement['count_floor'] ?></h5>
            </fieldset>
        </div>

        <div class="input-field col s4">
            <fieldset style="border-color: #EE6E73;">
                <legend>Тип аренды</legend>
                <h5 style="margin: 0;"><?= $announcement['type_of_rent'] ?></h5>
            </fieldset>
        </div>

        <div class="input-field col s8">
            <fieldset style="border-color: #EE6E73;">
                <legend>Срок сдачи</legend>
                <h5 style="margin: 0;"><?= $announcement['due_date'] ?></h5>
            </fieldset>
        </div>
    </div>

    <hr>

    <div>
        <h4>Описание</h4>
        <p><?= $announcement['description'] ?></p>
    </div>

    <hr>

    <div>
        <h4>Контактная информация</h4>
        <p>ФИО: <?= $announcement['full_name'] ?></p>
        <p><a href="tel:<?= preg_replace('/\s|[(]|[)]|[-]/', '', $announcement['phone_number']) ?>">Позвонить</a>
        </p>
        <p><a href="mailto:<?= $announcement['email'] ?>">Написать на почту</a></p>

    </div>

    <h5><?= $announcement['street'] ?></h5>
    <div id="YMapsID" style="width: 100%; height: 550px;"></div>
    <input id="coordinate" type="hidden" name="coordinate" value="<?= $announcement['street'] ?>">
    <input id="photosValue" type="hidden" name="photosValue" value="{{saleUser.photos}}">

</div>
<script>
    ymaps.ready(function () {
        let myMap = new ymaps.Map('YMapsID', {
            center: [53.9, 27.56],
            zoom: 11,
            controls: ['zoomControl', 'typeSelector', 'fullscreenControl']
        });
        let myGeocoder = ymaps.geocode(`Беларусь, Минск, ${document.querySelector("#coordinate").value}`)
        myGeocoder.then(function (res) {
            myMap.geoObjects.add(res.geoObjects)
        });
    });
</script>


<?php require_once ROOT . '/views/partials/footer.php' ?>