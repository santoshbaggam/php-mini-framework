<?php


/*
| Include autoloader
*/
require __DIR__ . '/../vendor/autoload.php';


/*
| Bootstrap application
*/
$app = new App\Core\App;

require __DIR__ . '/../bootstrap/app.php';


/*
| Register application routes
*/
require __DIR__ . '/../routes.php';


$app->run();
