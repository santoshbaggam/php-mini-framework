<?php

namespace App\Core;

use App\Core\{
    Router,
    Response,
    Container,
    Exceptions\InvalidRouteArgumentException
};

class App
{
	public function __construct()
	{
		$this->container = new Container([
            'router' => function () {
                return new Router;
            },
            'response' => function () {
                return new Response;
            }
        ]);
	}

    public function get($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, 'GET');
    }

    public function post($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, 'POST');
    }

    public function response()
    {
        return $this->container->response;
    }

    public function run()
    {
        $router = $this->container->router;

        $router->setPath($_SERVER['PATH_INFO'] ?? '/');

        $handler = $router->getHandler();

        $response = $this->route($handler);

        return $this->respond($response);
    }

    public function respond($response)
    {
        if (! $response instanceof Response) {
            // $response = $this->response()->text($response); // another way of looking at it..
            $response = $this->container->response->text($response); 
        }

        echo $response->getBody();
    }

    public function route($handler)
    {
        if (is_array($handler)) {
            $class = "\\App\\Controllers\\{$handler[0]}";
            $handler[0] = new $class($this);
        }

        if ( ! is_callable($handler)) {
            throw new InvalidRouteArgumentException;
        }

        return call_user_func($handler, $this);
    }

	public function bind($key, Callable $callable)
	{
		$this->container[$key] = $callable;
	}

    public function __get($property)
    {
        return $this->container[$property];
    }

}
