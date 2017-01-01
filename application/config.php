<?php

use Lib\Lib_Registry;

 define('PATH_SITE', $_SERVER['DOCUMENT_ROOT']);
// DB params
define('HOST', 'localhost');
 define('USER', 'root');
 define('PASSWORD', 'vfneh44');
 define('NAME_BD', 'shop_cms');
 define ('DS', DIRECTORY_SEPARATOR);
// dirs
define('APP_PATH', PATH_SITE.DS.'application');
define("LIB_PATH", APP_PATH.DS.'lib');
define("MODEL_PATH", APP_PATH.DS.'models');
define("CONTROLLER_PATH", APP_PATH.DS.'controllers');
define("VIEW_PATH", APP_PATH.DS.'views');
// db connector
$mysqli = new mysqli(HOST, USER, PASSWORD,NAME_BD)or die("Невозможно установить соединение c базой данных".$mysqli->connect_errno());
 Lib_Registry::set('mysqli',$mysqli);
 $mysqli->set_charset("utf8");
 $mysqli->query('SET names "utf8"');   //база устанавливаем кодировку данных в базе



?>