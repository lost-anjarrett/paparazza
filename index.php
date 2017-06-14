<?php
// index.php

	require_once __DIR__.'/vendor/autoload.php';

	$app = new Silex\Application();
	$app['debug'] = true;

	// Listes des routes:
	$app->get('/', 'Projet\Controllers\PageController::index');
    
	$app->get('/admin', 'Projet\Controllers\AuthController::login');

	$app->run();
