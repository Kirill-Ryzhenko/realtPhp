<?php


class Db
{
    public static function getConnection()
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = require($paramsPath);

        $db = new PDO(
            "mysql:host={$params['host']};dbname={$params['dbname']}",
            $params['user'],
            $params['password']
        );
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}