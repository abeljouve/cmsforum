<?php
session_start();
date_default_timezone_set("Europe/Paris");
define('APP', 'app/');
define('LIB', 'libraries/');
define('ASSETS', LIB.'assets/');
define('IMG', LIB.ASSETS.'/img');
define('CSS', LIB.ASSETS.'css/');
define('JS', LIB.ASSETS.'js/');
define('CONF', LIB.ASSETS.'conf/')
define('FOOTER', 'libraries/footer.php');
define('MENU', 'libraries/menu.php');
define('META', 'libraries/meta.php');
$config = require('CONF/bdd.php');
try {
	$BDD = new PDO('mysql:host='.$config['hostname'].';port='.$config['port'].';dbname='.$config['bddname'], $config['username'], $config['password']);
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}
if(isset($_SERVER['PATH_INFO']))
{
	$page = str_replace('/', '', $_SERVER['PATH_INFO']);
} else $page = 'index';

if(!empty($page))
{
	if (file_exists('app/controler/' . $page) == true) {
		include(APP . 'controler/'.$page.'/index.php');
	}else { include('error/404/index.php'); }
}
?>