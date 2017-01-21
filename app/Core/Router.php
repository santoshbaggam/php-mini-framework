<?php

namespace App\Core;

class Router
{
    protected $path;

    protected $routes = [];

	public function addRoute($uri, $handler)
	{
    	$slash_found = preg_match('/^\//', $uri);

    	if ( ! $slash_found) {
    		$uri = '/' . $uri;
    	}

		$this->routes[$uri] = $handler;
	}

    public function setPath($path)
    {
        $this->path = $path;
    }

	public function getHandler()
	{
		return $this->routes[$this->path];
	}
}