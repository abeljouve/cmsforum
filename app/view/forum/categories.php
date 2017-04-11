azertyui
<?php
$controller = new ForumController();
$controller->handleRequest();

    
    foreach($cats as $cat){
        echo "<li>" . $cat['name'] .  "</li>";
    
}
?>
