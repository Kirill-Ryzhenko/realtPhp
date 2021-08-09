<?php require_once ROOT . '/views/partials/header.php' ?>

<?php require_once ROOT . '/views/partials/navbar.php' ?>

    <div class="container">


        <div id="sale" class="col s10 offset-s1">
            <h1>Аренда квартиры</h1>
            <form action="/announcement/add/rent" method="POST" enctype="multipart/form-data">

                <div class="input-field">
                    <input id="street" name="street" type="text" class="autocomplete">
                    <label for="street">Улица</label>
                    <span class="helper-text" data-error="Введите улицу"></span>
                </div>

                <div id="YMapsID" style="width: 100%; height: 550px;"></div>

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
                    <input id="totalArea" name="totalArea" type="number" class="validate" step="0.01" min="1" required>
                    <label for="totalArea">Общая площадь</label>
                    <span class="helper-text" data-error="Введите общую площадь"></span>
                </div>

                <div class="input-field">
                    <input id="livingArea" name="livingArea" type="number" class="validate" step="0.01" min="1"
                           required>
                    <label for="livingArea">Жилая площадь</label>
                    <span class="helper-text" data-error="Введите жилую площадь"></span>
                </div>

                <div class="input-field">
                    <input id="kitchenArea" name="kitchenArea" type="number" class="validate" step="0.01" min="1">
                    <label for="kitchenArea">Площадь кухни</label>
                    <span class="helper-text" data-error="Введите площадь кухни"></span>
                </div>

                <div class="input-field">
                    <select name="typeHouse" required>
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
                    <input id="floor" name="floor" type="number" class="validate" min="1">
                    <label for="floor">Этаж</label>
                    <span class="helper-text" data-error="Введите этаж"></span>
                </div>

                <div class="input-field">
                    <input id="countOfFloors" name="countOfFloors" type="number" class="validate" min="1">
                    <label for="countOfFloors">Количество этажей</label>
                    <span class="helper-text" data-error="Введите количество этажей"></span>
                </div>

                <div class="input-field">
                    <select name="balcony" required>
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

                <div class="input-field">
                    <textarea id="description" name="description" class="materialize-textarea"></textarea>
                    <label for="description">Описание</label>
                </div>

                <div class="input-field">
                    <input id="price" name="price" type="number" class="validate" step="0.01" min="1">
                    <label for="price">Цена</label>
                    <span class="helper-text" data-error="Цена"></span>
                </div>

                <div class="photos">
                    <label for="photos">Выберите файлы для загрузки</label>
                    <input id="photos" name="photos[]" type="file" multiple>
                </div>

                <input type="submit" name="submit" class="btn btn-primary" value="Разместить объявление">
            </form>

        </div>


    </div>

<?php require_once ROOT . '/views/partials/footer.php' ?>