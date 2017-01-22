<?php

namespace App\Controllers;

use App\Core\App;

abstract class Controller
{
	private $app;

	public function __construct(App $app)
	{
		$this->app = $app;
	}

	protected function app()
	{
		return $this->app;
	}
}
