<?php

$app->bind('config', function () {
	return require __DIR__ . '/../config.php';
});

# array implementation of $app->bind (Callable or call_user_func)
$app->bind('databaseConnection', [new App\Core\Database\Connection, 'make']);

$app->bind('database', function ($app) {
	return new App\Core\Database\QueryBuilder($app->databaseConnection);
});

// or bind anything to the app container..
$app->bind('foo', function () {
	return 'bar';
});
