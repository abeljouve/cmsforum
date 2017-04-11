<?php
class ForumController{

    public function handleRequest(){

        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch($action){
            case null:
              $cats = $this->getCategories();
              include("./app/view/forum/categories.php");
            break;
        }
    }

    public function getCategories(){
        $pdo = Db::getInstance();
        $query = $pdo->prepare("SELECT name FROM category");
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }
}
?>
