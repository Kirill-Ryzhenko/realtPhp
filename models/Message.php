<?php


class Message
{
    public static function addMessage($id_user, $text)
    {
        $db = Db::getConnection();
        return $db->query("INSERT INTO message (id, id_user, text) VALUES (NULL, '$id_user', '$text');");
    }

    public static function getAllMessage()
    {
        $db = Db::getConnection();
        return $db->query("SELECT user.email, message.* FROM message JOIN user ON message.id_user=user.id");
    }

    public static function getMessageById($id)
    {
        $db = Db::getConnection();
        return $db->query("SELECT user.email, message.* FROM message JOIN user ON message.id_user=user.id WHERE message.id=$id");
    }

    public static function removeMessageById($id)
    {
        $db = Db::getConnection();
        return $db->query("DELETE FROM message WHERE id=$id;");
    }
}