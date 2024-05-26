<?php

session_start();

require '../vendor/autoload.php';
require_once '../app/config.php';
require_once '../app/middlewares.php';
require_once '../app/helpers.php';

try {
    Flight::register('db', \flight\database\PdoWrapper::class, ['sqlite:../app/djanogunidb.db']);
} catch (PDOException $e) {
    die("Can't connect to database.");
}

require_once '../app/routes.php';

Flight::start();
