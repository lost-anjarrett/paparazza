<?php

namespace Projet\Controllers;

use DateTime;
use Projet\Models\Backup;


class BackupController extends \System\Controller
{
    const FILES_LOCATION = [
        __DIR__ . '/../../ressources/views/pages/products.phtml',
        __DIR__ . '/../../ressources/views/pages/contact.phtml',
        __DIR__ . '/../../ressources/views/pages/gallery.phtml',
        __DIR__ . '/../../ressources/views/pages/products-mosaique.phtml',
        __DIR__ . '/../../ressources/views/pages/partenaires.phtml',
        __DIR__ . '/../../ressources/views/pages/products-pastilles.phtml',
        __DIR__ . '/../../ressources/views/pages/prestations.phtml',
        __DIR__ . '/../../ressources/views/pages/products.phtml',
        __DIR__ . '/../../ressources/views/pages/selling.phtml'
    ];

    public function save()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        // checkCsrf();
        extract($_POST);


        $backup = (new Backup)->setDescription($description)
            ->saveFiles()
            ->create()
        ;

        $this->redirect('admin/text');
    }

    public function load()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        if (!empty($_POST)) {
            checkCsrf();

            extract($_POST);
            $errors = [];
            $backup = (new Backup)->find($id);

            if (!password_verify($password, $_SESSION['admin']->getPassword())) {
                $errors[] = 'Votre mot de passe est incorrect';
            }

            if (!$backup) {
                $errors[] = 'Désolé nous n\'avons pas trouvé cette backup dans la base de données';
            }

            if (empty($errors)) {
                $backup->loadFiles();
            }
        }

        $this->redirect('admin/text');
    }
}
