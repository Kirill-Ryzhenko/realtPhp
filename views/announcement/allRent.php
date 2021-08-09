<?php require_once ROOT . '/views/partials/header.php' ?>

<?php require_once ROOT . '/views/partials/navbar.php' ?>
    <div class="container">

        <div id="filter" class="modal">
            <form action="/rent" method="get">
                <div class="modal-content">
                    <h4 style="padding-bottom: 20px;">Параметры</h4>

                    <div class="input-field">
                        <select name="typeOfRent">
                            <option value="" disabled selected>Тип аренды</option>
                            <option value="комната">комната</option>
                            <option value="1 комн. квартира">1 комн. квартира</option>
                            <option value="2 комн. квартира">2 комн. квартира</option>
                            <option value="3 комн. квартира">3 комн. квартира</option>
                            <option value="4 комн. квартира">4 комн. квартира</option>
                            <option value="5 комн. квартира">5 комн. квартира</option>
                            <option value="6 комн. квартира">6 комн. квартира</option>
                            <option value="7 комн. квартира">7 комн. квартира</option>
                            <option value="8 комн. квартира">8 комн. квартира</option>
                        </select>
                        <label>Тип аренды</label>
                    </div>

                    <div class="input-field">
                        <select name="dueDate">
                            <option value="" disabled selected>Срок сдачи</option>
                            <option value="сутки/часы">сутки/часы</option>
                            <option value="месяц">месяц</option>
                            <option value="2 месяца">2 месяца</option>
                            <option value="3 месяца">3 месяца</option>
                            <option value="полгода">полгода</option>
                            <option value="год">год</option>
                            <option value="длительный">длительный</option>
                        </select>
                        <label>Срок сдачи</label>
                    </div>

                    <div class="input-field">
                        <select name="typeHouse">
                            <option value="" disabled selected>Тип дома</option>
                            <option value="панельный">панельный</option>
                            <option value="кирпичный">кирпичный</option>
                            <option value="блок-комнаты">блок-комнаты</option>
                            <option value="монолитный">монолитный</option>
                            <option value="каркасно-блочный">каркасно-блочный</option>
                            <option value="силикатные блоки">силикатные блоки</option>
                            <option value="бревенчатый">бревенчатый</option>
                        </select>
                        <label>Тип дома</label>
                    </div>

                    <div class="input-field">
                        <select name="balcony">
                            <option value="" disabled selected>Балкон</option>
                            <option value="нет">нет</option>
                            <option value="балкон">балкон</option>
                            <option value="лоджия">лоджия</option>
                            <option value="балкон застекленный">балкон застекленный</option>
                            <option value="балкон застекленный">балкон застекленный</option>
                            <option value="2 балкона">2 балкона</option>
                            <option value="2 лоджии">2 лоджии</option>
                            <option value="2 балкона застекленные">2 балкона застекленные</option>
                            <option value="2 лоджии застекленные">2 лоджии застекленные</option>
                        </select>
                        <label>Балкон</label>
                    </div>

                    <div class="row">
                        <span class="row" style="padding-bottom: 15px;">Цена</span>
                        <div class="input-field col s6">
                            <input id="priceMin" name="priceMin" type="number" class="validate" step="0.01" min="1">
                            <label for="priceMin">минимум</label>
                        </div>
                        <div class="input-field col s6" style="margin-top: 14.5px">
                            <input id="priceMax" name="priceMax" type="number" class="validate" step="0.01" min="1">
                            <label for="priceMax">максимум</label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="sortValue" value="<?= @ $_GET[sortValue] ?>">
                <div class="modal-footer">
                    <a href="" class="modal-close waves-effect waves-red btn-flat">Закрыть</a>
                    <a href="" class="modal-close waves-effect waves-green btn-flat" id="announcementFilter">
                        <input type="submit" name="submit" value="Фильтровать" style="cursor: pointer">
                    </a>
                </div>
                <input type="hidden" name="page" value="1">
            </form>
        </div>


        <div id="sort" class="modal">
            <form action="/rent" method="get">
                <input type="hidden" name="typeOfRent" value="<?= @ $_GET[typeOfRent] ?>">
                <input type="hidden" name="dueDate" value="<?= @ $_GET[dueDate] ?>">
                <input type="hidden" name="typeHouse" value="<?= @ $_GET[typeHouse] ?>">
                <input type="hidden" name="balcony" value="<?= @ $_GET[balcony] ?>">
                <input type="hidden" name="priceMin" value="<?= @ $_GET[priceMin] ?>">
                <input type="hidden" name="priceMax" value="<?= @ $_GET[priceMax] ?>">

                <div class="modal-content" style="padding-bottom: 100px;">
                    <h4>Сортировки</h4>
                    <div class="input-field">
                        <select name="sortValue">
                            <option value="">По умолчанию</option>
                            <option value="priceASC">от дешевых к дорогим</option>
                            <option value="priceDESC">от дорогих к дешевым</option>
                        </select>
                        <label>Сортировки</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="" class="modal-close waves-effect waves-red btn-flat">Закрыть</a>
                    <a href="" class="modal-close waves-effect waves-green btn-flat" id="announcementSort">
                        <input type="submit" name="submit" value="Сортировать" style="cursor: pointer">
                    </a>

                    <input type="hidden" name="page" value="1">
                </div>
            </form>
        </div>
        <div class="head-panel row" style="margin-top: 40px;">
            <div class="col s4 ">
                <a class="waves-effect waves-light btn modal-trigger" style="min-width: 130px;"
                   href="#filter">Параметры</a>
            </div>
            <div class="col s4 ">
                <a class="waves-effect waves-light btn modal-trigger" style="min-width: 130px;"
                   href="#sort">Сортировки</a>
            </div>
        </div>


        <div class="card__wrapper row">
            <?php
            if (isset($rents) && count($rents)) {
                foreach ($rents as $announcement) {
                    $type = 'rent';
                    require ROOT . '/views/partials/card.php';
                }
            } else {
                echo '<h2>Нет объявлений о продаже</h2>';
            }
            ?>
        </div>

        <?php if ($countPage > 1):
            if (!isset($_GET['page']) || $_GET['page'] == 1)
                $page = 1;
            else
                $page = $_GET['page'];
            ?>

        <ul class="pagination">
            <?php if ($page == 1): ?>
                <li class="disabled">
            <?php else: ?>
                <li class="waves-effect">
            <?php endif; ?>

            <a href="#!"><i class="material-icons">chevron_left</i></a></li>

            <?php for ($i = 1; $i <= $countPage; $i++):
                $newUrl = substr($_SERVER['REQUEST_URI'], 0,strrpos($_SERVER['REQUEST_URI'], 'page=') + 5) . $i;
                if ($page == $i): ?>
                    <li class="active"><a href="<?= $newUrl?>"><?= $i ?></a></li>
                <?php else: ?>
                    <li class="waves-effect"><a href="<?= $newUrl?>"><?= $i ?></a></li>
                <?php endif; ?>
            <?php endfor;?>

            <?php if ($page == $countPage): ?>
                <li class="disabled">
            <?php else: ?>
                <li class="waves-effect">
            <?php endif; ?>
            <a href="#!"><i class="material-icons">chevron_right</i></a></li>
            </ul>
        <?php endif; ?>
    </div>

<?php require_once ROOT . '/views/partials/footer.php' ?>