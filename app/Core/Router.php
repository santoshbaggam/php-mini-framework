<?php

namespace App\Core;

use App\Core\Exceptions\{
    RouteNotFoundException,
    MethodNotAllowedException
};

class Router
{
    protected $path;

    protected $routes = [];

    protected $methods = [];

	public function addRoute($uri, $handler, $method)
	{
    	$slash_found = preg_match('/^\//', $uri);

    	if ( ! $slash_found) {
    		$uri = '/' . $uri;
    	}

		$this->routes[$uri] = $handler;

        $this->methods[$uri] = $method;
	}

    public function setPath($path)
    {
        $this->path = $path;
    }

	public function getHandler()
	{
        if ( ! isset($this->routes[$this->path]) ) {
            throw new RouteNotFoundException;
        }

        if ($_SERVER['REQUEST_METHOD'] != $this->methods[$this->path]) {
            throw new MethodNotAllowedException;
        }

		return $this->routes[$this->path];
	}
}