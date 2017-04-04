<?php

class Post{

    public $id;
    public $date;
    public $message;
    public $authorId;
    public $topicId;

    public function __construct($id, $date, $message, $authorId,$topicId){

        $this->id=$id;
        $this->date=$date;
        $this->message=$message;
        $this->authorId=$authorId;
        $this->topicId=$topicId;

    }

}

?>