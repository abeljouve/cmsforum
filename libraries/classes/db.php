<?php
DEFINE("DSN","mysql:host=149.91.91.223;dbname=cmsforum");
DEFINE("USER", "cmsforum");
DEFINE("PASSWORD", "pAIhx8GgnvxzKxuk");
class Db{




    private static $instance = NULL;

    private function __construct() {}
    private function __clone(){}



    public static function getInstance(){

        if (!isset(self::$instance)){
            try{
                self::$instance = new PDO(DSN,USER,PASSWORD);
                self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
              	self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e){
                echo "Connexion échouée " . $e->getMessage();
            }
        }
        return self::$instance;
    }

}
