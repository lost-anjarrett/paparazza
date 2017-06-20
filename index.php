<?php
require_once __DIR__.'/vendor/autoload.php';
session_start();


$app = new Silex\Application();
$app['debug'] = true;

// Listes des routes:
$app->get('/', 'Projet\Controllers\PageController::index');
$app->match('home', 'Projet\Controllers\PageController::index');

$app->match('admin', 'Projet\Controllers\AuthController::login');
$app->match('logout', 'Projet\Controllers\AuthController::logout');

$app->match('admin/dashboard', 'Projet\Controllers\DashBoardController::index');

$app->match('admin/slider', 'Projet\Controllers\SliderController::index');
$app->match('admin/slider/create', 'Projet\Controllers\SliderController::create');
$app->match('admin/infos', 'Projet\Controllers\InfosController::index');
// $app->match('admin/{slug}', 'Projet\Controllers\DashBoardController::show');

// GESTION DES ADMIN
$app->match('admin/manager', 'Projet\Controllers\AdminController::index');
$app->match('admin/manager/create', 'Projet\Controllers\AdminController::create');
$app->match('admin/manager/edit', 'Projet\Controllers\AdminController::edit');
$app->post('admin/manager/delete/{id}', 'Projet\Controllers\AdminController::delete')
    ->assert('id', '\d+');




$app->run();
