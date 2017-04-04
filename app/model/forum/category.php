<?php

class Category{

    public $id;
    public $id_section;
    public $name;
    public $description;
    public $position;

    public function __construct($id, $id_section, $name, $description, $position){
        $this->id = $id;
        $this->id_section = $id_section;
        $this->name = $name;
        $this->description = $description;
        $this->position = $position;
    }

    


}


?>