<?php


class User
{
    public static function addNewUser($email, $full_name, $phone_number, $password)
    {
        $db = Db::getConnection();
        return $db->query("INSERT INTO user (id, email, full_name, phone_number, password) VALUES (NULL, '$email', '$full_name', '$phone_number', '$password');");
    }

    public static function getFullNameById($id)
    {
        $db = Db::getConnection();
        return $db->query("SELECT full_name FROM user WHERE id=$id;");
    }

    public static function removeById($id)
    {
        $db = Db::getConnection();
        return $db->query("DELETE FROM user WHERE id=$id;");
    }

    public static function getUserById($id)
    {
        $db = Db::getConnection();
        return $db->query("SELECT * FROM user WHERE id='$id'");
    }

    public static function updateById($id, $email, $full_name, $phone_number, $password)
    {
        $db = Db::getConnection();
        return $db->query("UPDATE user SET email='$email', full_name='$full_name', phone_number='$phone_number', password='$password' WHERE id=$id");
    }

    public static function getUserByEmail($email)
    {
        $db = Db::getConnection();
        return $db->query("SELECT * FROM user WHERE email='$email'");
    }
}