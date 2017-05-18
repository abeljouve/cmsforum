<?php
class ForumController{
    
    public function handleRequest(){
        
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch($action){
            case null:
                $categories = [];
                $cats = $this->getCategories();
                
                foreach ($cats as $cat){
                    $category = new stdClass;
                    $category->cat_name = $cat['name'];
                    
                    $category->sub_categories = [];
                    $sub_cats = $this->getSubCategoriesByCategoryId($cat['id']);
                    
                    foreach($sub_cats as $sub_cat){
                        $sub_category = new stdClass;
                        $sub_category->id = $sub_cat['id'];
                        $sub_category->name = $sub_cat['name'];
                        
                        $last_topic = $this->getLastTopicBySubCategoryId($sub_cat['id']);
                        $sub_category->last_topic = $last_topic['name'];
                        
                        if ($this->getLastReplyAuthorByTopicId($last_topic['id']) != null){
                            $last_reply= $this->getLastReplyAuthorByTopicId($last_topic['id']);
                            
                        } else{
                            $last_reply = $this->getTopicAuthorByTopicId($last_topic['id']);
                        }
                    
                    
                    
                    $sub_category->last_reply_author = $last_reply['name'];
                    
                    $last_reply_creation_date = date("D j M H:i:s", strtotime($last_reply['creation_date']));
                    
                    $sub_category->last_reply_creation_date = $last_reply_creation_date;
                    $category->sub_categories[] = $sub_category;
                    
                }
                $categories[] = $category;
            }
            
            $menu="<table class='table table-hovered'>";
            foreach($categories as $cat){
                
                $menu.= "<tr><td><b>" . $cat->cat_name .  "</b></td><td><b>Dernier sujet</b></td><td><b>Auteur</b></td><td><b>Date</b></td></tr>";
                foreach ($cat->sub_categories as $subcat){
                    $menu.= "<tr><td><a href='forum?action=topics&subcat=" .$subcat->id . "'>" .$subcat->name .  "</a></td><td>" . $subcat->last_topic . "</td><td>". $subcat->last_reply_author."</td><td>". $subcat->last_reply_creation_date ."</td></tr>";
                }
                
            }
            $menu.= "</table>";
            include("./app/view/forum/categories.php");
            break;
        
        case ("topics"):
            
            if (isset($_GET['subcat'])){
                
                $menu = "<table class='table table-hovered'>";
                $menu.= "<tr><th>Sujet</th><th>Auteur</th><th>Date de création</th></tr>";
                $_topics = $this->getTopicsBySubCategoryId($_GET['subcat']);
                
                foreach ($_topics as $_topic){
                    $menu.= "<tr><td>". $_topic['name']."</td><td>". $_topic['author'] ."</td><td>". $_topic['creation_date'] . "</td></tr>";
                    
            }
            $menu.="</table>";
            include "./app/view/forum/topics.php";
        }
        break;
    
}
}

public function getCategories(){
    $pdo = Db::getInstance();
    $query = $pdo->prepare("SELECT id, name FROM category");
    $query->execute();
    $res = $query->fetchAll();
    return $res;
}

public function getSubCategoriesByCategoryId($id){
    $pdo = Db::getInstance();
    $query = $pdo->prepare("SELECT id, name FROM sub_category WHERE id_category = ?");
    $query->execute([$id]);
    $res = $query->fetchAll();
    return $res;
}

public function getLastTopicBySubCategoryId($id){
    $pdo = Db::getInstance();
    $query = $pdo->prepare("SELECT id, name, max(creation_date) as creation_date FROM topic WHERE id_sub_category = ? ");
    $query->execute([$id]);
    $res = $query->fetch();
    return $res;
}

public function getLastReplyAuthorByTopicId($id){
    $pdo = Db::getInstance();
    $query = $pdo->prepare("SELECT user.username as name, id_user, max(creation_date) as creation_date FROM reply inner join user on user.id = reply.id_user WHERE id_topic = ?  ");
    $query->execute([$id]);
    $res = $query->fetch();
    return $res;
}

public function getTopicsBySubCategoryId($id){
    $pdo = Db::getInstance();
    $query = $pdo->prepare("SELECT topic.*, user.username as author FROM topic INNER JOIN user ON topic.id_user = user.id WHERE id_sub_category = ?");
    $query->execute([$id]);
    $res = $query->fetchAll();
    return $res;
}

public function getTopicAuthorByTopicId($id){
    $pdo = Db::getInstance();
    $query = $pdo->prepare("SELECT user.username as name, id_user, max(creation_date) as creation_date FROM topic inner join user on user.id = topic.id_user WHERE topic.id = ? ");
    $query->execute([$id]);
    $res = $query->fetch();
    return $res;
}
}
?>