<?php require ROOT . '/views/partials/header.php' ?>

<?php require ROOT . '/views/partials/navbar.php' ?>


<div class="container">
    <div class="row auth">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s6"><a class="active" href="#login">Войти</a></li>
                <li class="tab col s6"><a href="#register">Регистрация</a></li>
            </ul>
        </div>
        <div id="login" class="col s6 offset-s3">
            <h1>Войти в магазин</h1>
            <?php if (isset($error_login)) {
                echo '<p class="alert">' . "$error_login" . '</p>';
            } ?>
            <form action="/auth/login" method="POST">
                <input type="hidden" name="type" value="login">
                <div class="input-field">
                    <input id="email_login" name="email" type="email" class="validate" required>
                    <label for="email_login">Email</label>
                    <span class="helper-text" data-error="Введите email"></span>
                </div>

                <div class="input-field">
                    <input id="password_login" name="password" type="password" class="validate" required>
                    <label for="password_login">Пароль</label>
                    <span class="helper-text" data-error="Введите пароль"></span>
                </div>

                <input type="submit" name="submit" class="btn btn-primary" value="Войти">
            </form>
        </div>

        <div id="register" class="col s6 offset-s3">
            <h1>Регистрация</h1>
            <?php if (isset($error_register)) {
                echo '<p class="alert">' . "$error_register" . '</p>';
            } ?>
            <form action="/auth/login" method="POST">
                <input type="hidden" name="type" value="register">
                <div class="input-field">
                    <input id="email_register" name="email" type="email" class="validate" value="<?php echo $email; ?>"
                           required>
                    <label for="email_register">Email</label>
                    <span class="helper-text" data-error="Введите email"></span>
                </div>

                <div class="input-field">
                    <input id="username_register" name="full_name" type="text" class="validate"
                           value="<?php echo $full_name; ?>" required>
                    <label for="username_register">ФИО</label>
                    <span class="helper-text" data-error="Введите ваше фио"></span>
                </div>

                <div class="input-field">
                    <input id="phone_register" name="phone_number" type="tel" minlength="19"
                           value="<?php echo $phone_number; ?>" required>
                    <label for="phone_register">Номер телефона</label>
                    <span class="helper-text" data-error="Введите номер телефона"></span>
                </div>

                <div class="input-field">
                    <input id="password_register" name="password" type="password" class="validate" minlength="8"
                           maxlength="20"
                           required>
                    <label for="password_register">Пароль</label>
                    <span class="helper-text" data-error="Введите пароль [8-20]"></span>
                </div>

                <div class="input-field">
                    <input id="confirm" name="confirm" type="password" class="validate" minlength="8" maxlength="20"
                           required>
                    <label for="confirm">Пароль еще раз</label>
                    <span class="helper-text" data-error="Введите пароль повторно [8-20]"></span>
                </div>

                <input type="submit" name="submit" class="btn btn-primary" value="Регистрация">
            </form>
        </div>
    </div>
</div>

<?php require ROOT . '/views/partials/footer.php' ?>