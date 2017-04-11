<?php 

class message{

     private $author_id;
     private $message;
     private $message_date;

     public function __construct($author, $mess){
          $author_id = $author;
          $message = $mess;
          $message_date = date('Y-m-d H:i:s');
     }

     public function getAuthor() :INT{
          return $author;
     }

     public function getText() :string{
          return $message;
     }

     public function getMessage_date(){
          return $message_date;
     }
}

?>

