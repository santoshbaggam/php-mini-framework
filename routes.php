<?php

# return view
$app->get('/', ['PagesController', 'home']);

# return json
$app->post('users', ['UsersController', 'index']);
$app->get('users', ['UsersController', 'index']);

# return plain text
$app->get('status', function ($app) {
	$data = '<pre> I\'m OK </pre>';

	return $app->response()->text($data);
});
