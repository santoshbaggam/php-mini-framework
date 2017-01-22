<?php

$app->bind('config', function () {
	return require __DIR__ . '/../config.php';
});

# array implementation of $app->bind (Callable or call_user_func)
$app->bind('db', [new App\Core\Database\Connection, 'make']);

# functional implementation of $app->bind (Callable or call_user_func)
// $app->bind('db', function ($container) {
// 	return (new App\Core\Database\Connection($container))->make();
// });

// or bind anything to the app container..
$app->bind('foo', function () {
	return 'bar';
});
