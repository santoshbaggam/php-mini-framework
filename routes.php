<?php

# returns view
// $app->get('/', ['PagesController', 'home']);

# returns json
// $app->post('users', ['UsersController', 'index']);

# return plain text
$app->get('status', function () {
	echo '<pre> I\'m OK </pre>';
});
