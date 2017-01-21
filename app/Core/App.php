<?php

namespace App\Core;

use App\Core\Container;

class App
{
	public function __construct()
	{
		$this->container = new Container([
            'router' => function () {
                return new Router;
            },
            // 'response' => function () {
            //     return new Response;
            // }
        ]);
	}

    public function get($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler);
    }

    public function run()
    {
        $router = $this->container->router;

        $router->setPath($_SERVER['PATH_INFO'] ?? '/');

        $handler = $router->getHandler();

        return $this->route($handler);
    }

    public function route(Callable $handler)
    {
        return call_user_func($handler);
    }

	public function bind($key, Callable $callable)
	{
		$this->container[$key] = $callable;
	}

    // public function __get($property)
    // {
    //     return $this->container->{$property};
    // }
}
