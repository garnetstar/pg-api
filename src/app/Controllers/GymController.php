<?php

namespace Controllers;

use Nette\Database\Connection;
use Slim\Http\Request;
use Slim\Http\Response;

class GymController
{

	/** @var Connection */
	private $database;

	public function __construct(Connection $database)
	{
		$this->database = $database;
	}

	public function get(Request $request, Response $response, $args)
	{
		$params = $request->getParams();

		if (array_key_exists('order', $params) && in_array($params['order'], ['asc', 'desc'])) {
			$order = $params['order'];
		} else {
			$order = 'asc';
		}
		
		$columns = 'gym_id, type, value, unix_timestamp(date) as timestamp';

		if (array_key_exists('type', $params)) {
			$sql = 'SELECT '.$columns.' FROM gym WHERE type = ' . (int) $params['type'] . ' ORDER BY `date` ' . $order;
		} else {
			$sql = 'SELECT '.$columns.' FROM gym  ORDER BY `date` ' . $order;
		}

		$data = $this->database->query($sql)->fetchAll();
		return $response->withJson($data);
	}

	public function post(Request $request, Response $response, $args)
	{
		$data = json_decode($request->getBody()->getContents());
		$this->database->query('INSERT INTO gym', ['type' => $data->type, 'date' => $data->date, 'value' => $data->value]);
		return $response->withJson(['state' => 'ok']);
	}
	
	public function delete(Request $request, Response $response, $args) {
		$data = json_decode($request->getBody()->getContents());
		$this->database->query('DELETE FROM `gym` WHERE gym_id = ?', $args['id']);
		return $response->withJson(['state' => 'ok '. $args['id']]);
	}
}
