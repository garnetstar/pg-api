<?php

namespace Controllers;

use Nette\Database\Connection;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Description of UserController
 *
 * @author machacej
 */
class TagController
{

	/** @var Connection */
	private $database;

	public function __construct(Connection $database)
	{
		$this->database = $database;
	}

	/**
	 * 
	 * @param Request $request
	 * @param Response $response
	 * @param type $args
	 * @return type
	 */
	public function get(Request $request, Response $response, $args)
	{
		if (isset($args['id'])) {
			$data = $this->database->query('SELECT * FROM tag WHERE tag_id=?', $args['id'])->fetch();
			return $response->withJson($data);
		} else {
			$data = $this->database->query('SELECT * FROM tag')->fetchAll();
			return $response->withJson($data);
		}
	
		
	}
	
	public function update(Request $request, Response $response, $args) {
		
		dump($args);
			dump($request->getParam('name'));
		die("bbb");
		return $response->withJson($args);
	}
		
}
