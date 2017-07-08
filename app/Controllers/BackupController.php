<?php

namespace Projet\Controllers;

use DateTime;
use Projet\Models\Backup;


class BackupController extends \System\Controller
{
    const PRODUCTS_LOCATION = __DIR__ . '/../../ressources/views/pages/products.phtml';

    public function save()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        checkCsrf();

        $content = file_get_contents(static::PRODUCTS_LOCATION);

        $backup = (new Backup)->saveFile($content)
                ->create();

        $this->redirect('admin/products');

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
                $errors[] = 'Désolé nous n\'avons pas trouvé cet utilisateur dans la base de données';
            }

            if (empty($errors)) {
                $content = $backup->getContent();

                if ($content) {
                    file_put_contents(static::PRODUCTS_LOCATION, $content);
                }
            }
        }

        $this->redirect('admin/products');
    }
}
