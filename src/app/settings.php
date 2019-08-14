<?php
declare(strict_types=1);

return [
	'displayErrorDetails' => true,

	'database' => [
		'dns' => 'mysql:host=db;dbname=' . getenv('DB_NAME'),
		'user' => 'root',
		'password' => getenv('DB_PASSWORD'),
	],
	'googleClientId' => getenv('GOOGLE_CLIENT_ID'),
];