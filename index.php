<?php
session_start();
date_default_timezone_set("Europe/Paris");
define('APP', 'app/');
define('LIB', 'libraries/');
define('ASSETS', LIB.'assets/');
define('IMG', ASSETS.'img/');
define('CSS', ASSETS.'css/');
define('JS', ASSETS.'js/');
define('CONF', LIB.'conf/');
define('FOOTER', LIB.'/footer.php');
define('HEADER', LIB.'/header.php');
define('META', LIB.'/meta.php');
define('FAVICON', IMG.'/favicon.png');
$config = require(CONF.'/bdd.php');
try {
	$PDOStatement = new PDO('mysql:host='.$config['hostname'].';port='.$config['port'].';dbname='.$config['dbname'], $config['username'], $config['password']);
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}
if(isset($_SERVER['PATH_INFO'])) {
	$page = str_replace('/', '', $_SERVER['PATH_INFO']);
} else $page = 'index';

if(!empty($page)) {
	if (file_exists(APP.'/controler/'. $page) == true) {
		include(APP.'controler/'.$page.'/index.php');
	} else {
		include('error/404/index.php');
	}
}
?>
