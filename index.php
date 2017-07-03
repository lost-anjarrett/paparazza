<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
session_start();


$app = new Silex\Application();
$app['debug'] = true;

// Listes des routes:
// $app->get('/', 'Projet\Controllers\PageController::index');
$app->match('home', 'Projet\Controllers\PageController::index');

// INDEX DEV
$app->get('/', 'Projet\Controllers\PageController::dev');

$app->match('admin', 'Projet\Controllers\AuthController::login');
$app->match('logout', 'Projet\Controllers\AuthController::logout');

$app->match('admin/dashboard', 'Projet\Controllers\DashBoardController::index');

// SLIDER
$app->match('admin/slider', 'Projet\Controllers\SliderController::index');
$app->post('admin/slider/create', 'Projet\Controllers\SliderController::create');
$app->post('admin/slider/destroy', 'Projet\Controllers\SliderController::destroy');

//GESTION DU SLIDER
$app->match('admin/slider', 'Projet\Controllers\SliderController::index');
$app->post('admin/slider/create', 'Projet\Controllers\SliderController::create');
$app->post('admin/slider/destroy', 'Projet\Controllers\SliderController::destroy');

//GESTION DE LA GALLERIE
$app->match('admin/gallery', 'Projet\Controllers\GalleryController::index');
$app->post('admin/gallery/create', 'Projet\Controllers\GalleryController::create');
$app->post('admin/gallery/destroy', 'Projet\Controllers\GalleryController::destroy');


// GESTION DES ADMIN
$app->match('admin/manager', 'Projet\Controllers\AdminController::index');
$app->match('admin/manager/create', 'Projet\Controllers\AdminController::create');
$app->match('admin/manager/edit', 'Projet\Controllers\AdminController::edit');
$app->post('admin/manager/delete/{id}', 'Projet\Controllers\AdminController::delete')
    ->assert('id', '\d+');

// INFOS PUBLIQUES
$app->match('admin/infos', '\Projet\Controllers\InfoController::index');
$app->post('admin/infos/edit', '\Projet\Controllers\InfoController::edit');

// CONTACT
$app->match('contact', '\Projet\Controllers\MailController::contact');

//ERREURS
$app->match('{url}', '\Projet\Controllers\PageController::error');
$app->match('admin/{url}', '\Projet\Controllers\PageController::error');




$app->run();
