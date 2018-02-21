<?php 
//FRONT CONTROLLER

// 1. Общие настройки

//Включение отображения ошибок:
ini_set('display_errors',1);
error_reporting(E_ALL);

//Запуск сессии
session_start();

// 2. Подключение файлов системы

//Определяем переменную автоопределения пути к файлу:
define('ROOT', dirname(__FILE__));

//Подключаем файл автоподключения компонентов сайта:
require_once(ROOT.'/components/Autoload.php');

// 3. Вызов Router
$router = new Router();
$router->run();

?>