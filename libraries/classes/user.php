<?php

class User{

    public $id;
    public $username;
    public $password;
    public $email;
    public $birthday;
    public $firstname;
    public $name;
    public $registration_date;
    public $last_login_date;
    public $rank;
    public $profile_img;
    public $signature;
    public $ip;


    public function __construct($id, $username, $password, $email, $birthday, $firstname, $name, $registration_date, $last_login_date, $rank, $profile_img, $signature, $ip){

        $this->id = $id;
        $this->username=$username;
        $this->password=$password;
        $this->email=$email;
        $this->birthday=$birthday;
        $this->firstname=$firstname
        $this->name=$name;
        $this->registration_date=$registration_date;
        $this->last_login_date=$last_login_date;
        $this->rank=$rank;
        $this->profile_img=$profile_img;
        $this->signature=$signature;
        $this->ip =$ip;


    }


}

?>
