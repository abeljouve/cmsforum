<?php

class SubCategory{

    public $id;
    public $id_category;
    public $name;
    public $description;
    public $position;

    public function __construct($id, $id_category, $name, $description, $position){
        $this->id = $id;
        $this->id_category = $id_category;
        $this->name = $name;
        $this->description = $description;
        $this->position = $position;
    }

    


}


?>