<?php
require_once ROOT . '/models/User.php';
require_once ROOT . '/models/Message.php';

class AdminController
{
    private function getIdMessage()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $linkArray = explode('/', $uri);
        return end($linkArray);
    }

    public function allSupport()
    {
        $result = Message::getAllMessage();
        $messages = $result->fetchAll();
        require_once ROOT . '/views/admin/supportList.php';
        return true;
    }

    public function supportAnswer()
    {
        $id = $this->getIdMessage();
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $textAnswer = $_POST['answer'];
            if (mail($email, 'Admin answer', $textAnswer)) {
                Message::removeMessageById($id);
                Router::redirectLink('/admin/support/');
            }
        }
        $result = Message::getMessageById($id);
        $message = $result->fetch();
        require_once ROOT . '/views/admin/supportAnswer.php';
        return true;
    }
}