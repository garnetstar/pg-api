<?php
declare(strict_types=1);

namespace Model;

use Nette\Database\Connection;

class UserRepository
{

	/**
	 * @var Connection
	 */
	private $database;

	public function __construct(Connection $database)
	{
		$this->database = $database;
	}

	public function createUser(string $login)
	{
		$this->database->query(
			'INSERT INTO `user`', [
				'login' => $login,
				'allowed' => 0,
			]
		);
	}

	public function getUserByLogin(string $login): ?array
	{
		$sql = 'SELECT * FROM `user` WHERE `login`=?';
		$result = $this->database->query($sql, $login);

		if ($result->getRowCount() === 1) {
			return (array) $result->fetchAll()[0];
		}

		return null;
	}

	public function findUserByToken(string $token): ?\stdClass
	{
		$result = $this->database->query('SELECT * FROM `user` WHERE token=?', $token);

		return $result->fetchAll()[0] ?? null;
	}
}
