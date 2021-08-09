<?php
require_once ROOT . '/models/Announcement.php';

class Sale extends Announcement
{
    private $id;
    private $userId;
    private $street;
    private $roomsCount;
    private $totalArea;
    private $livingArea;
    private $kitchenArea;
    private $typeHouse;
    private $floor;
    private $countOfFloors;
    private $balcony;
    private $description;
    private $ownership;
    private $price;
    private $photos;

    private $directory;

    protected function setDataFromForm()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->userId = $_SESSION['isLogin'];
        $this->street = $_POST['street'];
        $this->roomsCount = $_POST['roomsCount'];
        $this->totalArea = $_POST['totalArea'];
        $this->livingArea = $_POST['livingArea'];
        $this->kitchenArea = $_POST['kitchenArea'];
        $this->typeHouse = $_POST['typeHouse'];
        $this->floor = $_POST['floor'];
        $this->typeHouse = $_POST['typeHouse'];
        $this->countOfFloors = $_POST['countOfFloors'];
        $this->balcony = $_POST['balcony'];
        $this->description = $_POST['description'];
        $this->ownership = $_POST['ownership'];
        $this->price = $_POST['price'];

        $this->directory = $this->getPhotoDirectory('sale');
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
        require_once ROOT . '/views/announcement/addSale.php';
    }

    public function renderAnnouncement($id)
    {
        $announcementResult = $this->getDataAnnouncement($id);
        $photosResult = $this->getPhotoAnnouncement($id);
        $announcement = $announcementResult->fetch();
        $photos = $photosResult->fetchAll();
        require_once ROOT . '/views/announcement/outputSale.php';
    }

    public function renderAllAnnouncement()
    {
        $elementsOnPage = 8;
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $skip = $elementsOnPage * ($page - 1);
        if (isset($_GET['submit'])) {
            $params = $this->getParamsAnnouncement();
            $sales = $this->getAnnouncementParamsForPage($skip, $skip + $elementsOnPage, $params)->fetchAll();
        } else {
            $sales = $this->getAnnouncementForPage($skip, $skip + $elementsOnPage)->fetchAll();
        }
        $countPage = ceil(count($sales) / $elementsOnPage);
        require_once ROOT . '/views/announcement/allSale.php';
    }

    private function getParamsAnnouncement(): array
    {
        $params = [];
        $params[] = (isset($_GET['roomsCount']) && !empty($_GET['roomsCount'])) ? "'$_GET[roomsCount]'" : "'%%'";
        $params[] = (isset($_GET['typeHouse']) && !empty($_GET['typeHouse'])) ? "'$_GET[typeHouse]'" : "'%%'";
        $params[] = (isset($_GET['balcony']) && !empty($_GET['balcony'])) ? "'$_GET[balcony]'" : "'%%'";
        $params[] = (isset($_GET['ownership']) && !empty($_GET['ownership'])) ? "'$_GET[ownership]'" : "'%%'";
        $params[] = (isset($_GET['priceMin']) && !empty($_GET['priceMin'])) ? $_GET['priceMin'] : 0;
        $params[] = (isset($_GET['priceMax']) && !empty($_GET['priceMax'])) ? $_GET['priceMax'] : "(SELECT MAX(price) FROM `sale`)";
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
        $db->query("INSERT INTO sale (id, id_user, is_banned, street, total_area, living_area, kitchen_area, balcony, description, price, type_house, floor, count_floor, rooms_count, ownership) VALUES (NULL, '$this->userId', NULL, '$this->street', '$this->totalArea', '$this->livingArea', '$this->kitchenArea', '$this->balcony', '$this->description', '$this->price', '$this->typeHouse', '$this->floor', '$this->countOfFloors', '$this->roomsCount', '$this->ownership');");
        return $db->lastInsertId();
    }

    private function addPhotoToDb()
    {
        $db = Db::getConnection();
        $query = "INSERT INTO sale_photo (id_sale, name_photo) VALUES ('$this->id', :name);";
        $statement = $db->prepare($query);
        foreach ($this->photos as $photo) {
            $statement->execute([
                ':name' => $photo
            ]);
        }
    }

    public static function getAllAnnouncement()
    {
        $db = Db::getConnection();
        return $db->query("SELECT * FROM sale JOIN ( SELECT * FROM sale_photo GROUP BY(id_sale)) AS photo ON sale.id = photo.id_sale LIMIT 8");
    }

    public static function getAllAnnouncementById($id)
    {
        $db = Db::getConnection();
        return $db->query("SELECT * FROM sale JOIN ( SELECT * FROM sale_photo GROUP BY(id_sale)) AS photo ON sale.id = photo.id_sale WHERE sale.id_user={$id}");
    }

    private function getDataAnnouncement($id)
    {
        $db = Db::getConnection();
        return $db->query("SELECT * FROM user JOIN sale ON user.id = sale.id_user WHERE sale.id={$id}");
    }

    private function getPhotoAnnouncement($id)
    {
        $db = Db::getConnection();
        return $db->query("SELECT name_photo FROM sale_photo WHERE id_sale={$id}");
    }

    private function getCountAnnouncement()
    {
        $db = Db::getConnection();
        return $db->query("SELECT COUNT(*) FROM sale");
    }

    private function getAnnouncementForPage($skip, $count)
    {
        $db = Db::getConnection();
        return $db->query("SELECT * FROM sale JOIN ( SELECT * FROM sale_photo GROUP BY(id_sale)) AS photo ON sale.id = photo.id_sale LIMIT $skip, $count");
    }

    private function getAnnouncementParamsForPage($skip, $count, $params)
    {
        $db = Db::getConnection();


        //
        //
        // Данным способом запросы не обрабатывались, поэтому сделал через $db->query();

//        $query = "SELECT * FROM sale
//        JOIN ( SELECT * FROM sale_photo GROUP BY(id_sale)) AS photo ON sale.id = photo.id_sale
//        WHERE rooms_count LIKE ?
//          AND type_house LIKE ?
//          AND ownership LIKE ?
//          AND price >= ? AND price <= ? ? LIMIT $skip, $count";
//        $stmt = $db->prepare($query);
//        $stmt->execute($params);
//        $result = $stmt->fetchAll();
        $query = "SELECT * FROM sale
        JOIN ( SELECT * FROM sale_photo GROUP BY(id_sale)) AS photo ON sale.id = photo.id_sale 
        WHERE rooms_count LIKE $params[0] 
          AND type_house LIKE $params[1]
          AND balcony LIKE $params[2] 
          AND ownership LIKE $params[3] 
          AND price >= $params[4] AND price <= $params[5] $params[6] LIMIT $skip, $count";
        return $db->query($query);
    }

    public function removeById($id)
    {
        $db = Db::getConnection();
        return $db->query("DELETE FROM sale WHERE id=$id;");
    }
}