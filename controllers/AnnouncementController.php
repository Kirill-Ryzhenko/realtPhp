<?php
require_once ROOT . '/models/Sale.php';
require_once ROOT . '/models/Rent.php';

class AnnouncementController
{


    private function getTypeAnnouncement()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $linkArray = explode('/', $uri);
        return end($linkArray);
    }

    private function getAnnouncement($type)
    {
        switch ($type) {
            case 'sale':
                return new Sale();
            case 'rent':
                return new Rent();
            default:
                return null;
        }
    }

    public function addAnnouncement()
    {
        $type = $this->getTypeAnnouncement();

        $announcement = $this->getAnnouncement($type);

        if (gettype($announcement) === "NULL") {
            Router::redirectLink();
        } else {
            if (isset($_POST['submit'])) {
                $announcement->addAnnouncement();
                Router::redirectLink();
            }
            $announcement->renderAddAnnouncement();
        }
        return true;
    }

    public function allAnnouncement()
    {
        $type = strtok(trim($_SERVER['REQUEST_URI'], '/'), '?');
        $announcement = $this->getAnnouncement($type);

        $announcement->renderAllAnnouncement();
        return true;
    }

    public function outputAnnouncement()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $linkArray = explode('/', $uri);
        $type = $linkArray[1];

        $announcement = $this->getAnnouncement($type);

        if (gettype($announcement) === "NULL") {
            Router::redirectLink();
        } else {
            $announcement->renderAnnouncement($this->getTypeAnnouncement());
        }

        return true;
    }

    public function removeAnnouncement()
    {
        $segments = explode('/', $_SERVER['REQUEST_URI']);
        $type = $segments[2];
        $id = end($segments);
        echo $type, $id;
        $announcement = $this->getAnnouncement($type);

        if (gettype($announcement) === "NULL") {
            Router::redirectLink();
        } else {
            $announcement->removeById($id);
            Router::redirectLink('/user/profile');
        }
        return true;
    }
}