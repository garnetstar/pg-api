<?php

namespace Command;

use Elasticsearch\Client;
use Nette\Database\Connection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function dump;

class IndexationCommand extends Command
{

	/** @var Client */
	protected $client;

	/** @var Connection */
	protected $database;

	public function __construct(Client $client, Connection $database, mixed $name = null)
	{
		$this->client = $client;
		$this->database = $database;
		parent::__construct($name);
	}

	protected function configure()
	{
		$this->setName('app:index')
			->setDescription('Indexation runner');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$this->getData();
		$this->getData2();
	}

	protected function getData()
	{
		// Create the index
		$params = [
			'index' => 'gym_index'
		];
//		$response = $this->client->indices()->create($params);

		$result = $this->database->query('SELECT * FROM `gym`');

		$data = $result->fetchAll();

		foreach ($data as $one) {
			$params = [
				'index' => 'gym_index',
				'type' => 'my_type',
				'id' => $one['gym_id'] . "_id",
				'body' => $one,
			];

// Document will be indexed to my_index/my_type/my_id
			$response = $this->client->index($params);
			dump($response);
		}
	}

	protected function getData2()
	{
		// Create the index
		$params = [
			'index' => 'article_index'
		];
//		$response = $this->client->indices()->create($params);
		$result = $this->database->query('SELECT * FROM `article`');

		$data = $result->fetchAll();

		foreach ($data as $one) {
			$params = [
				'index' => 'article_index',
				'type' => 'article_type',
				'id' => $one['article_id'] . "_id",
				'body' => $one,
			];

// Document will be indexed to my_index/my_type/my_id
			$response = $this->client->index($params);
			dump($response);
		}
	}
}
