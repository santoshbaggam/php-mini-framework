<?php

namespace App\Controllers;

use App\Models\User;

class UsersController extends Controller
{
	public function index()
	{
		$query = $this->app()->database;

		$users = $query->on(User::class)->selectAll();

		return $this->app()->response()->json($users);
	}

	public function store()
	{
		return 'storing the user..';
	}
}