<?php

namespace App\Core;

use App\Core\Exceptions\{
    RouteNotFoundException,
    MethodNotAllowedException
};

class Router
{
    protected $path;

    protected $action;

    protected $routes = [];

    protected $methods = [];

	public function addRoute($uri, $handler, $method)
	{
    	$slash_found = preg_match('/^\//', $uri);

    	if ( ! $slash_found) {
    		$uri = '/' . $uri;
    	}

		$this->routes[$uri][$method] = $handler;
	}

    public function setAction($action)
    {
        $this->action = $action;
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

        if ( ! isset($this->routes[$this->path][$this->action])) {
            throw new MethodNotAllowedException;
        }

		return $this->routes[$this->path][$this->action];
	}
}