<?php
namespace Projet\Controllers;

use Projet\Models\Admin;

class AdminController extends \System\Controller
{

    public function index()
    {

      return $this->view('accueil');
    }

    public function create()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        if (isset($_POST) && !empty($_POST)) {
            checkCsrf();

            extract($_POST);
            $errors = [];

            if (strlen($name) < 3 || strlen($name) > 20) {
                $errors[] = 'Le nom d\'utilisateur doit faire entre 3 et 20 caractères';
            }
            if (!ctype_alnum($name)) {
                $errors[] = 'Le nom d\'utilisateur doit contenir uniquement des caractères alphanumériques';
            }
            if ((new Admin)->findOneBy('name', $name)) {
                $errors[] = 'Ce nom d\'utilisateur existe déjà';
            }
            if ($password == '') {
                $errors[] = 'Vous devez choisir un mot de passe';
            }
            if ($password != $confirmPassword) {
                $errors[] = 'Les mots de passe ne correspondent pas';
            }

            if (empty($errors)) {
                $admin = (new Admin)->setName($name)
                    ->setPassword($password)
                    ->create();
                $success = 'L\'administrateur a bien été ajouté';
            }


        }

        ob_start();
        include(__DIR__.'/../../ressources/views/admin/add-admin.phtml');
        $view = ob_get_clean();

        return $view;
    }

}
