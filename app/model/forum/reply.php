<?php

class Reply{

    public $id;
    public $id_topic;
    public $id_user;
    public $content;
    public $creation_date;
    public $update_date;


    public function __construct($id, $id_topic, $id_user, $content, $creation_date, $update_date){
        $this->id = $id;
        $this->id_topic = $id_topic
        $this->id_user = $user;
        $this->content = $content;
        $this->creation_date = $creation_date;
        $this->update_date = $update_date;
    }
}

?>