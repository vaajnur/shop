<?php

use Core\Route;

require_once 'lib/registry.php';
require_once 'config.php';
require_once 'lib/datebase.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'core/autoload.php';
$router = new Route();
$router->start(); // запускаем маршрутизатор