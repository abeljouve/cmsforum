<?php

class GestMessage{

     public function addMessage($Message){
          $text = $Message->getText();
          $author = $Message->getAuthor();
          $date = $Message->getMessage_date();
          $pdo = db::getInstance();
          $sth = $pdo->prepare("INSERT INTO messaging VALUES ('',?,?,?)");
          $sth->bindParam(1, $author, PDO::PARAM_INT);
          $sth->bindParam(2, $text, PDO::PARAM_STR);
          $sth->bindParam(3, $date, PDO::PARAM_STR);
          $sth->execute();
     }

     public function getMessages(){
          $pdo = db::getInstance();
          $sth = $pdo->prepare("SELECT messaging.*, user.username, user.profile_img FROM messaging INNER JOIN user ON messaging.author_id=user.id ORDER BY id ASC LIMIT 20");
          $sth->execute();
          return json_encode($sth->fetchAll());
     }

     public function getConnectedUser(){
         $pdo = db::getInstance();
          $sth = $pdo->prepare("SELECT username, profile_img FROM user WHERE ROUND(TIME_TO_SEC(timediff(NOW(), last_login_date))/60) < 5");
          $sth->execute();
          return json_encode($sth->fetchAll());
     }
}

?>
