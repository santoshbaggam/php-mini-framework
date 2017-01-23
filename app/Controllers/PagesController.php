<?php

namespace App\Controllers;

class PagesController extends Controller
{
	public function home()
	{
		$data = [
			'title' => 'PHP Mini Framework',
			'description' => 'This is a mini PHP framework built from scratch!'
		];

		return $this->app()->view('home', $data);
	}
}
