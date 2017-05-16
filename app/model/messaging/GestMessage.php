<?php

class GestMessage{
     
     public function addMessage($Message){
          $text = $Message->getText();
          $author = $Message->getAuthor();
          $date = $Message->getMessage_date();
          $sth = $PDOStatement->prepare("INSERT INTO MESSAGING VALUES ('','?','?','?')");
          $sth->bindParam(1, $author, PDO::PARAM_INT);
          $sth->bindParam(2, $text, PDO::PARAM_STR);
          $sth->bindParam(3, $date, PDO::PARAM_DATE);
          $sth->execute();
     }

     public function getMessages(){
          $sth = $PDOStatement->prepare("SELECT MESSAGING.*, USER.username, USER.profile_img FROM MESSAGING INNER JOIN USER ON MESSAGING.uthor_idr=USER.id ORDER BY message_date DESC");
          $sth->execute();
          return json_encode($sth->fetch_assoc());    
     }
}

?>