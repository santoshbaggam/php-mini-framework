<?php

namespace App\Core\Database;

use PDO;
use PDOException;

class Connection
{
	/*
	 * App\Core\Container $container is injected 
	 * automatically by $app (bind)
	 */
    public function make($container)
    {
    	$config = $container['config']['database'];

        try {
            return new PDO(
                $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die( $e->getMessage() );
        }
    }
}