<?php
require_once ROOT . '/models/Announcement.php';

class Rent extends Announcement
{
    private $id;
    private $userId;
    private $street;
    private $typeOfRent;
    private $dueDate;
    private $totalArea;
    private $livingArea;
    private $kitchenArea;
    private $typeHouse;
    private $floor;
    private $countOfFloors;
    private $balcony;
    private $description;
    private $price;
    private $photos;

    private $directory;

    protected function setDataFromForm()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->userId = $_SESSION['isLogin'];
        $this->street = $_POST['street'];
        $this->typeOfRent = $_POST['typeOfRent'];
        $this->dueDate = $_POST['dueDate'];
        $this->totalArea = $_POST['totalArea'];
        $this->livingArea = $_POST['livingArea'];
        $this->kitchenArea = $_POST['kitchenArea'];
        $this->typeHouse = $_POST['typeHouse'];
        $this->floor = $_POST['floor'];
        $this->typeHouse = $_POST['typeHouse'];
        $this->countOfFloors = $_POST['countOfFloors'];
        $this->balcony = $_POST['balcony'];
        $this->description = $_POST['description'];
        $this->price = $_POST['price'];

        $this->directory = $this->getPhotoDirectory('rent');
        $this->photos = $this->loadPhotos($this->directory);
    }

    public function addAnnouncement()
    {
        $this->setDataFromForm();
        try {
            $result = $this->addAnnouncementToDb();
            if ($result !== '0') {
                $this->id = $result;
                $this->addPhotoToDb();
                $this->loadPhotoToServer($this->directory);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function renderAddAnnouncement()
    {
        require_once ROOT . '/views/announcement/addRent.php';
    }

    public function renderAnnouncement($id)
    {
        $announcementResult = $this->getDataAnnouncement($id);
        $photosResult = $this->getPhotoAnnouncement($id);
        $announcement = $announcementResult->fetch();
        $photos = $photosResult->fetchAll();
        require_once ROOT . '/views/announcement/outputRent.php';
    }

    public function renderAllAnnouncement()
    {
        $elementsOnPage = 8;
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $skip = $elementsOnPage * ($page - 1);
        if (isset($_GET['submit'])) {
            $params = $this->getParamsAnnouncement();
            $rents = $this->getAnnouncementParamsForPage($skip, $skip + $elementsOnPage, $params)->fetchAll();
        } else {
            $rents = $this->getAnnouncementForPage($skip, $skip + $elementsOnPage)->fetchAll();
        }
        $countPage = ceil(count($rents) / $elementsOnPage);
        require_once ROOT . '/views/announcement/allRent.php';
    }

    private function getParamsAnnouncement(): array
    {
        $params = [];
        $params[] = (isset($_GET['typeOfRent']) && !empty($_GET['typeOfRent'])) ? "'$_GET[typeOfRent]'" : "'%%'";
        $params[] = (isset($_GET['dueDate']) && !empty($_GET['dueDate'])) ? "'$_GET[dueDate]'" : "'%%'";
        $params[] = (isset($_GET['typeHouse']) && !empty($_GET['typeHouse'])) ? "'$_GET[typeHouse]'" : "'%%'";
        $params[] = (isset($_GET['balcony']) && !empty($_GET['balcony'])) ? "'$_GET[balcony]'" : "'%%'";
        $params[] = (isset($_GET['priceMin']) && !empty($_GET['priceMin'])) ? $_GET['priceMin'] : 0;
        $params[] = (isset($_GET['priceMax']) && !empty($_GET['priceMax'])) ? $_GET['priceMax'] : "(SELECT MAX(price) FROM `rent`)";
        $params[] = $this->getSortAnnouncement();
        return $params;
    }

    private function getSortAnnouncement()
    {
        switch ($_GET['sortValue']) {
            case 'priceASC':
                return 'ORDER BY price ASC';
            case 'priceDESC':
                return 'ORDER BY price DESC';
            default:
                return '';
        }
    }

    //
    //
    //Queries to to BD
    protected function addAnnouncementToDb()
    {
        $db = Db::getConnection();
        $db->query("INSERT INTO rent (id, id_user, is_banned, street, type_of_rent, due_date, total_area, living_area, kitchen_area, balcony, description, price, type_house, floor, count_floor) VALUES (NULL, '$this->userId', NULL, '$this->street', '$this->typeOfRent', '$this->dueDate', '$this->totalArea', '$this->livingArea', '$this->kitchenArea', '$this->balcony', '$this->description', '$this->price', '$this->typeHouse', '$this->floor', '$this->countOfFloors');");
        return $db->lastInsertId();
    }

    private function addPhotoToDb()
    {
        $db = Db::getConnection();
        $query = "INSERT INTO rent_photo (id_rent, name_photo) VALUES ('$this->id', :name);";
        $statement = $db->prepare($query);
        foreach ($this->photos as $photo) {
            $statement->execute([
                ':name' => $photo
            ]);
        }
    }

    public static function getAllAnnouncementById($id)
    {
        $db = Db::getConnection();
        return $db->query("SELECT * FROM rent JOIN ( SELECT * FROM rent_photo GROUP BY(id_rent)) AS photo ON rent.id = photo.id_rent WHERE rent.id_user={$id}");
    }

    public static function getAllAnnouncement()
    {
        $db = Db::getConnection();
        return $db->query("SELECT * FROM rent JOIN ( SELECT * FROM rent_photo GROUP BY(id_rent)) AS photo ON rent.id = photo.id_rent LIMIT 8");
    }

    private function getDataAnnouncement($id)
    {
        $db = Db::getConnection();
        return $db->query("SELECT * FROM user JOIN rent ON user.id = rent.id_user WHERE rent.id={$id}");
    }

    private function getPhotoAnnouncement($id)
    {
        $db = Db::getConnection();
        return $db->query("SELECT name_photo FROM rent_photo WHERE id_rent={$id}");
    }

    private function getAnnouncementForPage($skip, $count)
    {
        $db = Db::getConnection();
        return $db->query("SELECT * FROM rent JOIN ( SELECT * FROM rent_photo GROUP BY(id_rent)) AS photo ON rent.id = photo.id_rent LIMIT $skip, $count");
    }

    private function getAnnouncementParamsForPage($skip, $count, $params)
    {
        $db = Db::getConnection();


        //
        //
        // Данным способом запросы не обрабатывались, поэтому сделал через $db->query();

//        $query = "SELECT * FROM rent
//        JOIN ( SELECT * FROM rent_photo GROUP BY(id_rent)) AS photo ON rent.id = photo.id_rent
//        WHERE type_of_rent LIKE ?
//          AND due_date LIKE ?
//          AND type_house LIKE ?
//          AND balcony LIKE ?
//          AND price >= ? AND price <= ? ? LIMIT $skip, $count";
//        $stmt = $db->prepare($query);
//        $stmt->execute($params);
//        $result = $stmt->fetchAll();
        $query = "SELECT * FROM rent
        JOIN ( SELECT * FROM rent_photo GROUP BY(id_rent)) AS photo ON rent.id = photo.id_rent 
        WHERE type_of_rent LIKE $params[0] 
          AND due_date LIKE $params[1]
          AND type_house LIKE $params[2] 
          AND balcony LIKE $params[3] 
          AND price >= $params[4] AND price <= $params[5] $params[6] LIMIT $skip, $count";
        return $db->query($query);
    }

    public function removeById($id)
    {
        $db = Db::getConnection();
        return $db->query("DELETE FROM rent WHERE id=$id;");
    }
}