<?php

class Message{

     private $author_id;
     private $message;
     private $message_date;

     public function __construct($author, $mess){
          $this->author_id = $author;
          $this->message = $mess;
          $this->message_date = date('Y-m-d H:i:s');
     }

     public function getAuthor(){
          return $this->author_id;
     }

     public function getText(){
          return $this->message;
     }

     public function getMessage_date(){
          return $this->message_date;
     }
}

?>
