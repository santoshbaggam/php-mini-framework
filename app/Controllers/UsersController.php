<?php

namespace App\Controllers;

class UsersController extends Controller
{
	public function index()
	{
		$users = [
			[
				'name' => 'Santosh',
				'age'  => 24
			],
			[
				'name' => 'John',
				'age'  => 40
			]
		];

		return $this->app()->response()->json($users);
	}

	public function store()
	{
		return 'storing';
	}
}