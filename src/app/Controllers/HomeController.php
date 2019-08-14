<?php

namespace Controllers;

use Nette\Database\Connection;

/**
 * Description of HomeController
 *
 * @author machacej
 */
class HomeController
{
	/* @var Connection */
	private $database;
	
	private $env;

	public function __construct(Connection $connection, $env)
	{
		$this->database = $connection;
		$this->env = $env;
	}

	public function home($one, $two, $args)
	{
		echo getenv('DB_USER');
		dump($this->env);
		echo "homeController";        
	}
}
