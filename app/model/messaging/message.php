<?php 

class Message{

     private $author_id;
     private $message;
     private $message_date;

     public function __construct($author, $mess){
          $author_id = $author;
          $message = $mess;
          $message_date = date('Y-m-d H:i:s');
     }

     public function getAuthor(){
          return $author;
     }

     public function getText(){
          return $message;
     }

     public function getMessage_date(){
          return $message_date;
     }
}

?>