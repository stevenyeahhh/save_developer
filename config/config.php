<?php

define('DS', DIRECTORY_SEPARATOR);
define('DEFAULT_CONTROLLER', 'Index');
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . DS .'save_app_1'.DS);
define('DEFAULT_LAYOUT', 'default');
define('BASE', 'http://' . $_SERVER['SERVER_NAME'] . '/save_app_1/');
define("ROL_ADMINISTRADOR", "1");
define("ROL_REPARTIDOR", "2");
define("ROL_CLIENTE", "3");
define("DB_ROUTE","mysql:host=distrapp.sweetmemoriestudio.com;dbname=distrapp");
define("DB_USER","usuario_24092015");
define("DB_PASSWORD","wOa8*4n7");

?>