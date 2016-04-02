<?php

define('DS', DIRECTORY_SEPARATOR);
define('DEFAULT_CONTROLLER', 'Index');
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . DS .'save_app_1'.DS);
define('DEFAULT_LAYOUT', 'default');
define('BASE', 'http://' . $_SERVER['SERVER_NAME'] . '/save_app_1/');
define("ROL_ADMINISTRADOR", "1");
define("ROL_REPARTIDOR", "2");
define("ROL_CLIENTE", "3");
define("DB_ROUTE","mysql:host=proyectosave.com;dbname=save_db");
define("DB_USER","save_db");
define("DB_PASSWORD","StevenYeahh123");

?>