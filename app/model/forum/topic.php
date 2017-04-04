<?php 

class Topic{

    public $id;
    public $id_user;
    public $id_sub_category;
    public $name;
    public $content;
    public $creation_date;
    public $update_date;


    public function __construct($id, $id_user, $id_sub_category, $name, $content, $creation_date,$update_date){
        
        $this->id = $id;
        $this->id_user =$id_user;
        $this->id_sub_category;
        $this->name = $name;
        $this->content = $content;
        $this->creation_date= $creation_date;
        $this->update_date = $update_date;
    }


}

?>