<?php


class Section{

    public $id;
    public $name;
    public $position;

    public function __construct($id, $name, $position){
        $this->id = $id;
        $this->name = $name;
        $this->position = $position;
    }
    

}
?>