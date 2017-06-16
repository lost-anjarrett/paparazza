<?php
session_start();

require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

// Listes des routes:
$app->get('/', 'Projet\Controllers\PageController::index');
$app->match('home', 'Projet\Controllers\PageController::index');

$app->match('admin', 'Projet\Controllers\AuthController::login');
$app->match('logout', 'Projet\Controllers\AuthController::logout');

$app->match('admin/dashboard', 'Projet\Controllers\DashBoardController::index');

$app->match('admin/slider', 'Projet\Controllers\SliderController::index');
$app->match('admin/infos', 'Projet\Controllers\InfosController::index');
// $app->match('admin/{slug}', 'Projet\Controllers\DashBoardController::show');


$app->match('admin/manager', 'Projet\Controllers\AdminController::create');

$app->run();
