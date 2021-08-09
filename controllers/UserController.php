<?php

require_once ROOT . '/models/User.php';
require_once ROOT . '/models/Rent.php';
require_once ROOT . '/models/Sale.php';
require_once ROOT . '/models/Message.php';

class UserController
{
    public function profile()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $id = $_SESSION['isLogin'];
        $user = User::getUserById($id)->fetch();
        $full_name = $user['full_name'];
        $email = $user['email'];
        $phone_number = $user['phone_number'];
        $profile = true;
        $rents = Rent::getAllAnnouncementById($id)->fetchAll();
        $sales = Sale::getAllAnnouncementById($id)->fetchAll();
        require_once ROOT . '/views/profile/profile.php';
        return true;
    }

    public function edit()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $id = $_SESSION['isLogin'];
        $user = User::getUserById($id)->fetch();
        $full_name = $user['full_name'];
        $email = $user['email'];
        $phone_number = $user['phone_number'];

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $full_name = $_POST['full_name'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            $phone_number = $_POST['phone_number'];
            if ($confirm !== $password) {
                $error = 'Пароли не совпадают';
            } else {

                if (session_status() === PHP_SESSION_NONE) session_start();
                $password = password_hash($password, PASSWORD_DEFAULT);
                User::updateById($id, $email, $full_name, $phone_number, $password);
                Router::redirectLink('/user/profile');
            }
        }

        require_once ROOT . '/views/profile/edit_profile.php';
        return true;
    }

    public function remove()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $id = $_SESSION['isLogin'];
        User::removeById($id)->fetch();
        session_destroy();
        Router::redirectLink();
        return true;
    }

    public function support()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $id = $_SESSION['isLogin'];

        if (isset($_POST['submit'])) {
            $textMessage = $_POST['text'];
            Message::addMessage($id, $textMessage);
            Router::redirectLink();
        }

        require_once ROOT . '/views/profile/support.php';
        return true;
    }
}