<?php
declare(strict_types=1);

namespace Middleware;

use Model\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;

class Auth
{

	/**
	 * @var UserRepository
	 */
	private $userRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function __invoke(ServerRequestInterface $request, Response $response, callable $next): ResponseInterface
	{
		$token = null;
		$headers = $request->getHeaders();
		$auth = $headers['HTTP_AUTHORIZATION'][0] ?? '';
		$authParts = explode(' ', $auth);

		if (count($authParts) === 2 && $authParts[0] === 'Bearer') {
			$token = $authParts[1];
		}

		if ($this->isTokenValid($token)) {
			$response = $next($request, $response);
		} else {
			$response = $response->withStatus(403)->write('Permission denied');
		}

		return $response;
	}

	private function isTokenValid(?string $token): bool
	{
		if($token === null) {
			return false;
		}

		$user = $this->userRepository->findUserByToken($token);

		return $user ? true : false;
	}
}
