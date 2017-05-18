<?php

include "libraries/classes/db.php";
include(APP.'view/'.$page.'/toppage.php');
include(APP.'controler/'.$page.'/forumController.php');
$controller = new ForumController();
$controller->handleRequest();
include(APP.'view/'.$page.'/bottompage.php');
?>
    