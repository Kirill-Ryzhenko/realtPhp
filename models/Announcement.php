<?php


abstract class Announcement
{
    abstract public function addAnnouncement();
    abstract public function renderAddAnnouncement();
    abstract public function renderAnnouncement($id);
    abstract public function removeById($id);
    abstract protected function addAnnouncementToDb();
    abstract protected function setDataFromForm();

    protected function loadPhotos($directory) {
        $uploadPhotos = $_FILES['photos']['name'];
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        foreach ($uploadPhotos as $key => $value) {
            $file = $this->generateFilename($value, $directory);
            $_FILES['photos']['name'][$key] = $file;
        }
        return $_FILES['photos']['name'];
    }

    protected function getPhotoDirectory($type)
    {
        return ROOT . '\uploads\image\\' . $type . '\\';
    }

    protected function generateFilename($filename, $directory)
    {
        $extension = substr($filename, strrpos($filename, '.') + 1);
        $files = scandir($directory);
        $isUnique = true;
        while ($isUnique) {
            $isUnique = false;
            $filename = uniqid() . '.' . $extension;
            foreach ($files as $file) {
                if ($file === $filename) {
                    $isUnique = true;
                    break;
                }
            }
        }
        return $filename;
    }

    public function loadPhotoToServer($photoDirectory) {
        $uploadPhotos = $_FILES['photos']['name'];
        if (!file_exists($photoDirectory)) {
            mkdir($photoDirectory, 0777, true);
        }
        foreach ($uploadPhotos as $key => $value) {
            move_uploaded_file($_FILES['photos']['tmp_name'][$key], $photoDirectory . $value);
        }
    }

}