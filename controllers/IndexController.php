<?php
require_once ROOT . '/models/Sale.php';
require_once ROOT . '/models/Rent.php';

class IndexController
{
    public function index()
    {
        $result = Sale::getAllAnnouncement();
        $sales = $result->fetchAll();
        $result = Rent::getAllAnnouncement();
        $rents = $result->fetchAll();

//        echo '<pre>';
//        var_dump($sales);
//        echo '</pre>';

        require_once ROOT . '/views/start.php';
        return true;
    }

}