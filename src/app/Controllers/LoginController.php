<?php
declare(strict_types=1);

namespace Controllers;

use Model\TokenRepository;
use Model\UserRepository;
use Slim\Http\Request;
use Slim\Http\Response;

class LoginController
{

	/**
	 * @var string
	 */
	private $clientId;

	/**
	 * @var UserRepository
	 */
	private $userRepository;

	public function __construct(string $clientId, UserRepository $userRepository)
	{
		$this->clientId = $clientId;
		$this->userRepository = $userRepository;
	}

	public function post(Request $request, Response $response, array $args)
	{
		$data = json_decode($request->getBody()->getContents());
		if (isset($data->id_token)) {

			$client = new \Google_Client(['client_id' => $this->clientId]);
			$payload = $client->verifyIdToken($data->id_token);

			if ($user = $this->getUser($payload)) {
				$response = $response->withJson(
					[
						'token' => $user['token'],
					]
				);
			} else {
				$response = $response->withStatus(401)->write('Invalid credentials');
			}
		} else {
			$response = $response->withStatus(401)
				->write('Missing parameter');
		}

		return $response;
	}

	private function getUser($payload): ?array
	{
		if ($payload === false) {
			return null;
		}

		return $this->userRepository->getUserByLogin($payload['email']);
	}
}
