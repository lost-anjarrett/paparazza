<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
session_start();


$app = new Silex\Application();
$app['debug'] = true;

// Listes des routes:
$app->get('/', 'Projet\Controllers\PageController::index');
$app->match('home', 'Projet\Controllers\PageController::index');
$app->match('/{page}', 'Projet\Controllers\PageController::galleryAjax')
    ->assert('page', '\d+');
// INDEX DEV
// $app->get('/', 'Projet\Controllers\PageController::dev');
// AUTH
$app->match('admin', 'Projet\Controllers\AuthController::login');
$app->match('logout', 'Projet\Controllers\AuthController::logout');
// TABLEAU DE BORD
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
// PRODUITS
$app->match('admin/products', 'Projet\Controllers\ProductController::index');
// INFOS PUBLIQUES
$app->match('admin/infos', '\Projet\Controllers\InfoController::index');
$app->post('admin/infos/edit', '\Projet\Controllers\InfoController::edit');
// CONTACT
$app->match('contact', '\Projet\Controllers\MailController::contact');
// EDITEUR DE TEXTE
$app->post('save-page', '\Projet\Controllers\PageController::savePage');
// HELP
$app->match('admin/help', '\Projet\Controllers\PageController::help');
// BACKUP
$app->post('admin/products/save-backup', 'Projet\Controllers\BackupController::save');
$app->post('admin/products/load-backup', 'Projet\Controllers\BackupController::load');
// MENTIONS LEGALES
$app->match('mentions-legales', '\Projet\Controllers\PageController::mentions');
// PARTENAIRES
$app->match('partenaires', '\Projet\Controllers\PageController::partenaires');
$app->match('admin/partners', 'Projet\Controllers\PartnerController::index');
$app->match('admin/partners/create', 'Projet\Controllers\PartnerController::create');
$app->match('admin/partners/destroy', 'Projet\Controllers\PartnerController::destroy');
//ERREURS
$app->match('{url}', '\Projet\Controllers\PageController::error');
$app->match('admin/{url}', '\Projet\Controllers\PageController::error');




$app->run();
