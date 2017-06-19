<?php

namespace Projet\Controllers;

use Projet\Models\Admin;

class AuthController extends \System\Controller
{

    //@get index.php/landing

    public function login()
    {
        if (isset($_POST) && !empty($_POST)) {
            extract($_POST);

            $admin = (new Admin)->findOneBy('UPPER(name)', strtoupper($name));

            if (!$admin || !password_verify($password, $admin->getPassword()) ) {
                $error = 'Le nom d\'utilisateur n\'existe pas ou le mot de passe est incorrect';
            }

            if(!isset($error)) {
                $admin->logConnexion();
                $_SESSION['admin'] = $admin;
                $_SESSION['adminId'] = $admin->getId();
                $_SESSION['csrf_token'] = randString(50);
                $this->redirect('admin/dashboard');
            }
        }

        ob_start();
        include(__DIR__.'/../../ressources/views/auth/login.phtml');
        $view = ob_get_clean();

        return $view;
    }


    public function logout()
    {
        $_SESSION = [];

        session_destroy();

        $this->redirect('home');
    }

}
