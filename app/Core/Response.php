<?php

namespace App\Core;

class Response
{
	protected $body;

	protected $statusCode = 200;

	protected $headers = [];

	public function view(string $view, $data)
	{
		extract($data);

		$body = require __DIR__ . "/../Views/{$view}.view.php";

		$this->setBody($body);

		return $this;
	}

	public function json(array $data)
	{
		$this->setBody( json_encode($data) );

		$this->setHeader('Content-Type', 'application/json');

		return $this;
	}

	public function text(string $data)
	{
		$this->setBody($data);

		return $this;
	}

	public function setHeader($name, $value)
    {
        $this->headers[] = [$name, $value];

        return $this;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

	public function withHeaders()
	{
		header(sprintf(
            'HTTP/%s %s %s',
            '1.1',
            $this->statusCode,
            ''
        ));

        foreach ($this->getHeaders() as $header) {
            header($header[0] . ': ' . $header[1]);
        }
	}

	public function getBody()
	{
		$this->withHeaders();

		return $this->body;
	}

	public function setBody($body)
	{
		$this->body = $body;

		return $this;
	}

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

}
