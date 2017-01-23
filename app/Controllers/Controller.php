<?php

namespace App\Controllers;

use App\Core\App;

abstract class Controller
{
	private $app;

	private $view;

	public function __construct(App $app)
	{
		$this->app = $app;
	}

	protected function app()
	{
		return $this->app;
	}
}
