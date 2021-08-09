<?php

require_once(ROOT . '/models/User.php');

class AuthController
{
    public function logout()
    {
        if ( session_status() === PHP_SESSION_NONE ) session_start();
        session_destroy();
        Router::redirectLink();
        return true;
    }

    public function login()
    {
        $error_login = null;
        $error_register = null;

        $email = '';
        $phone_number = '';
        $full_name = '';

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($_POST['type'] === 'login') {
                $result = User::getUserByEmail($email);
                $user = $result->fetch();
                $password = password_hash($password, PASSWORD_DEFAULT);
                if (!$user) {
                    $error_login = 'Такой пользователь не зарегестрирован';
                } elseif (password_verify($user['password'], $password)) {
                    $error_login = 'Пароли не совпадают';
                } else {
                    if ( session_status() === PHP_SESSION_NONE ) session_start();
                    $_SESSION['isLogin'] = $user['id'];
                    Router::redirectLink();
                }
//                while ($row = $result->fetch()) {
//                    echo 'id => ' . $row['id'] . '<br>';
//                    echo 'email => ' . $row['email'] . '<br>';
//                    echo 'full_name => ' . $row['full_name'] . '<br>';
//                    echo 'phone_number => ' . $row['phone_number'] . '<br>';
//                    echo 'password => ' . $row['password'] . '<br>';
//                }
            } else {
                $phone_number = $_POST['phone_number'];
                $full_name = $_POST['full_name'];
                $confirm = $_POST['confirm'];
                if ($password !== $confirm) {
                    $error_register = 'Пароли не совпадают';
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $result = User::addNewUser($email, $full_name, $phone_number, $password);
                    if (!$result) {
                        $error_register = 'Такой пользователь зарегестрирован';
                    }
                }
            }
        }

        require_once ROOT . '/views/auth/auth.php';
        return true;
    }
}