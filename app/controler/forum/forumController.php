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
                        $sub_category->description = $sub_cat['description'];

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
            $menu="";
            foreach($categories as $cat){
                $menu.= "<div class=\"forum_category\">".html_entity_decode($cat->cat_name)."</div>";
                foreach ($cat->sub_categories as $subcat){
                    $menu.="<ul class=\"forum_subcategory\" style=\"list-style-type: none;\">
          							<li style=\"height:50px;\">
          									<dl>
          										<dt style=\"float:left;width: 560px;height: 100%;\" class=\"forum_subcategory_title\">
          											<a href=\"forum?action=topics&subcat=".$subcat->id.">".html_entity_decode($subcat->name)."</a><br>
          											<p class=\"forum_subcategory_desc\">".html_entity_decode($subcat->description)."</p>
          										</dt>
          										<dd style=\"float:left;width: 70px;text-align: center;font-size:11px\">".$this->getTopicCountSubCategoryId($subcat->id)."<p>Topics</p></dd>
          										<dd style=\"float:left;width: 70px;text-align: center;font-size:11px\">".$this->getMessageCountSubCategoryId($subcat->id)."<p>Posts</p></dd>
          										<dd style=\"float:left;width: 322px;padding: 5px 3px 3px 15px;font-size: 12px;\">
          											<a href=\"#\">".html_entity_decode($subcat->last_topic)."</a><br>".$subcat->last_reply_creation_date."&nbsp;<a href=\"#\">".$subcat->last_reply_author."</a>
          										</dd>
          									</dl>
          								</li>
          							</ul>";
                }

            }
            include("./app/view/forum/categories.php");
            break;

        case ("topics"):

            if (isset($_GET['subcat'])){

                $menu = "<ul class=\"topiclist\">";
                $_topics = $this->getTopicsBySubCategoryId($_GET['subcat']);

                foreach ($_topics as $_topic){
                    if ($this->getLastReplyAuthorByTopicId($_topic['id']) != null){
                        $last_reply= $this->getLastReplyAuthorByTopicId($_topic['id']);

                    } else{
                        $last_reply = $this->getTopicAuthorByTopicId($_topic['id']);
                    }
                    $menu.= "<li>
              			<a href=\"index.php?view_topic=".$_topic["id"]."\"></a>
              			<dl>
              				<a href=\"index.php?view_topic=".$_topic["id"]."\">
              					<dt>".html_entity_decode($_topic['name'])."</dt>
              				</a>
              				<dd class=\"reponse\">".$this->getReplyCountByTopic($_topic["id"])."<p>Reponses</p></dd>
              				<dd class=\"auteur\>".html_entity_decode($_topic['author'])."</dd>
              				<dd class=\"lastpost\">
              					<div class=\"beurk\">
              					".ucfirst(strftime('%A %d %B %Y %H:%M',strtotime($_topic['creation_date'])))."<br>
              					Dernier message par:<a href='#'>".html_entity_decode($last_reply["name"])."</a>
              					</div>
              				</dd>
              			</dl>
              			</li>";

            }
            $menu.="</ul>";
            include "./app/view/forum/topics.php";
        }
        break;

}
}

public function getCategories(){
    $pdo = Db::getInstance();
    $query = $pdo->prepare("SELECT id, name FROM category ORDER BY position");
    $query->execute();
    $res = $query->fetchAll();
    return $res;
}
public function getTopicCountSubCategoryId($id){
    $pdo = Db::getInstance();
    $query = $pdo->prepare("SELECT COUNT(*) FROM topic WHERE id_sub_category = ?");
    $query->execute([$id]);
    $query->execute();
    $res = $query->fetchAll();
    return $res[0]["COUNT(*)"];
}
public function getMessageCountSubCategoryId($id){
    $pdo = Db::getInstance();
    $query = $pdo->prepare("SELECT COUNT(reply.id) FROM reply INNER JOIN topic ON reply.id_topic=topic.id WHERE topic.id_sub_category = ?");
    $query->execute([$id]);
    $query->execute();
    $res = $query->fetchAll();
    return $res[0]["COUNT(reply.id)"];
}

public function getReplyCountByTopic($id){
    $pdo = Db::getInstance();
    $query = $pdo->prepare("SELECT COUNT(reply.id) FROM reply INNER JOIN topic ON reply.id_topic=topic.id WHERE topic.id = ?");
    $query->execute([$id]);
    $query->execute();
    $res = $query->fetchAll();
    return $res[0]["COUNT(reply.id)"];
}

public function getSubCategoriesByCategoryId($id){
    $pdo = Db::getInstance();
    $query = $pdo->prepare("SELECT id, name, description FROM sub_category WHERE id_category = ? ORDER BY position");
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
