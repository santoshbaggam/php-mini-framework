<?php

if (! function_exists('config') ) {
	function config($param = '') {
		$path = "config/{$param}.php";
		
		if (! file_exists($path)) {
			throw new \Exception('Configuration not found.');	
		}

		$config = require $path;
	}
}


