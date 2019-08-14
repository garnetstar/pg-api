<?php
declare(strict_types=1);

use Controllers\ArticleController;
use Controllers\LoginController;

/**
 * Article
 */
$app->group('', function (\Slim\App $app) {
	$app->get('/article[/{id}]', ArticleController::class . ':get');
	$app->get('/article/filter/{field}/{word}', ArticleController::class . ':filter');
	$app->put('/article', ArticleController::class . ':put');
	$app->post('/article/{id}', ArticleController::class . ':post');
	$app->delete('/article/{id}', ArticleController::class . ':delete');
})->add(\Middleware\Auth::class);
/**
 * Gym
 */
$app->group('', function (\Slim\App $app) {
	$app->get('/gym[/{id}]', \Controllers\GymController::class . ':get');
	$app->post('/gym', \Controllers\GymController::class . ':post');
	$app->delete('/gym/{id}', \Controllers\GymController::class . ':delete');
})->add(\Middleware\Auth::class);
/**
 * Tag
 */
$app->get('/tag[/{id}]', TagController::class . ':get');

/**
 * Login
 */
$app->post('/login', LoginController::class . ':post');
