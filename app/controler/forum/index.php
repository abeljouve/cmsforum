<?php

include "libraries/classes/db.php";
include(APP.'view/'.$page.'/toppage.php');
class ForumController{
    
    public function handleRequest(){
        
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch($action){

            case null:
            $categories = $this->getCategories();
            $cats = [];
            foreach ($categories as $cat){
                $cats[] = $cat["name"];
            }
            include("../view/forum/categories.php");
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
include(APP.'view/'.$page.'/bottompage.php');

?>