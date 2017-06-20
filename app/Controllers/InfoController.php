<?php
namespace Projet\Controllers;

use Projet\Models\Info;

class InfoController extends \System\Controller
{

    public function index()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        $infos = (new Info)->findOneBy('id', 1);

        

        $data = compact('infos');

        return $this->view('infos', $data);
    }


    public function edit()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        if (isset($_POST) && !empty($_POST)) {
            checkCsrf();

            extract($_POST);
            $errors = [];


            // if (!$admin || !password_verify($oldPassword, $admin->getPassword()) ) {
            //     $errors[] = 'Votre mot de passe est incorrect';
            // }
            // if ($password == '') {
            //     $errors[] = 'Vous devez choisir un mot de passe';
            // }
            // if (!preg_match('#^(?=.*\d)(?=.*[a-z])(\S).{5,}$#', $password)) {
            //     $errors[] = 'Le mot de passe doit contenir 6 caractères minimum dont au moins une lettre et un chiffre';
            // }
            // if ($password != $confirmPassword) {
            //     $errors[] = 'Les mots de passe ne correspondent pas';
            // }
            //
            // if (empty($errors)) {
            //     $_SESSION['admin']->setPassword($password)
            //         ->update();
            //     $success = 'Le mot de passe a bien été changé';
            // }


        }

        $data = compact('errors', 'success', 'password');

        return $this->view('edit-admin', $data);
    }


}
