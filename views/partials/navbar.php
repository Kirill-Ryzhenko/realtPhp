<?php
if ( session_status() === PHP_SESSION_NONE ) @session_start();
require_once(ROOT . '/models/User.php');
?>
<nav>
    <div class="nav-wrapper">
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/rent">Аренда</a></li>
            <li><a href="/sale">Продажа</a></li>
            <?php
            if (isset($_SESSION['isLogin'])) {
                $full_name = User::getFullNameById($_SESSION['isLogin'])->fetch()["full_name"];
                echo '<a class="dropdown-trigger btn" href="#" data-target="dropdown1">' . $full_name . '</a>
                <ul id="dropdown1" class="dropdown-content">
                    <li><a href="/user/profile">Профиль</a></li>
                    <li><a href="/announcement/add/sale">Продать квартиру</a></li>
                    <li><a href="/announcement/add/rent">Сдать в аренду квартиру</a></li>
                    <li><a href="/user/support">Написать в поддержку</a></li>
                    <li class="divider" tabindex="-1"></li>
                    <li><a href="/auth/logout">Выйти</a></li>
                </ul>';
            } else {
                echo '<li><a href="/auth/login">Войти</a></li>';
            }
            ?>
        </ul>
        <a href="/" class="brand-logo">Риэлторство</a>
    </div>
</nav>
