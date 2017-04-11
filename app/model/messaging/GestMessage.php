<?php

class GestMessage{
     
     public function addMessage($message){
          $text = $message->getText();
          $author = $message->getAuthor();
          $date = $message->getMessage_date();
          $sth = $PDOStatement->prepare("INSERT INTO MESSAGING VALUES ('','?','?','?')");
          $sth->bindParam(1, $author, PDO::PARAM_INT);
          $sth->bindParam(2, $text, PDO::PARAM_STR);
          $sth->bindParam(3, $date, PDO::PARAM_DATE);
          $sth->execute();
     }

     public function getMessages(){
          $sth = $PDOStatement->prepare("SELECT * FROM MESSAGING");
          $sth->execute();
          return $sth->fetch_assoc();    
     }
}

?>