<?php require ROOT . '/views/partials/header.php' ?>

<?php require ROOT . '/views/partials/navbar.php' ?>

<div class="container">

    <h1>Редактирование</h1>
    <?php if (isset($error)) {
        echo '<p class="alert">' . $error . '</p>';
    } ?>
    <form action="/user/edit" method="POST">
        <div class="input-field">
            <input id="email" name="email" type="email" class="validate" value="<?php echo $email; ?>" required>
            <label for="email">Email</label>
            <span class="helper-text" data-error="Введите email"></span>
        </div>

        <div class="input-field">
            <input id="full_name" name="full_name" type="text" class="validate" value="<?php echo $full_name; ?>"
                   required>
            <label for="full_name">ФИО</label>
            <span class="helper-text" data-error="Введите ваше фио"></span>
        </div>

        <div class="input-field">
            <input id="phone_number" name="phone_number" type="tel" minlength="19" value="<?php echo $phone_number; ?>"
                   required>
            <label for="phone_number">Номер телефона</label>
            <span class="helper-text" data-error="Введите номер телефона"></span>
        </div>

        <div class="input-field">
            <input id="password" name="password" type="password" class="validate" minlength="8" maxlength="20" required>
            <label for="password">Пароль</label>
            <span class="helper-text" data-error="Введите пароль [8-20]"></span>
        </div>

        <div class="input-field">
            <input id="confirm" name="confirm" type="password" class="validate" minlength="8" maxlength="20" required>
            <label for="confirm">Пароль еще раз</label>
            <span class="helper-text" data-error="Введите пароль повторно [8-20]"></span>
        </div>

        <input type="submit" name="submit" class="btn btn-primary" value="Редактирование">
    </form>
</div>
<?php require ROOT . '/views/partials/footer.php' ?>
