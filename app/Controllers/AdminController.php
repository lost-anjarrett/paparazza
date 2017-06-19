<?php
namespace Projet\Controllers;

use Projet\Models\Admin;

class AdminController extends \System\Controller
{

    public function index()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        $adminList = (new Admin)->findAll();

        $data = compact('adminList');

        return $this->view('manager', $data);
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

            if (strlen($name) <= 3 || strlen($name) >= 20) {
                $errors[] = 'Le nom d\'administrateur doit faire entre 4 et 20 caractères';
            }
            if (!ctype_alnum($name)) {
                $errors[] = 'Le nom d\'administrateur doit contenir uniquement des caractères alphanumériques';
            }
            if ((new Admin)->findOneBy('UPPER(name)', strtoupper($name))) {
                $errors[] = 'Ce nom d\'administrateur existe déjà';
            }
            if ($password == '') {
                $errors[] = 'Vous devez choisir un mot de passe';
            }
            if (!preg_match('#^(?=.*\d)(?=.*[a-z])(\S).{5,}$#', $password)) {
                $errors[] = 'Le mot de passe doit contenir 6 caractères minimum dont au moins une lettre et un chiffre';
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

        $data = compact('errors', 'success', 'name', 'password');

        return $this->view('add-admin', $data);
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


            if (!$admin || !password_verify($oldPassword, $admin->getPassword()) ) {
                $errors[] = 'Votre mot de passe est incorrect';
            }
            if ($password == '') {
                $errors[] = 'Vous devez choisir un mot de passe';
            }
            if (!preg_match('#^(?=.*\d)(?=.*[a-z])(\S).{5,}$#', $password)) {
                $errors[] = 'Le mot de passe doit contenir 6 caractères minimum dont au moins une lettre et un chiffre';
            }
            if ($password != $confirmPassword) {
                $errors[] = 'Les mots de passe ne correspondent pas';
            }

            if (empty($errors)) {
                $_SESSION['admin']->setPassword($password)
                    ->update();
                $success = 'Le mot de passe a bien été changé';
            }


        }

        $data = compact('errors', 'success', 'password');

        return $this->view('edit-admin', $data);
    }

    public function delete($id)
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        if (isset($_POST) && !empty($_POST)) {
            checkCsrf();

            extract($_POST);
            $errors = [];
            $admin = (new Admin)->findOneBy('id', $id);

            if ($id == $_SESSION['admin']->getId()) {
                $errors[] = 'Vous ne pouvez pas supprimer votre propre compte';
            }

            if (!password_verify($password, $_SESSION['admin']->getPassword())) {
                $errors[] = 'Votre mot de passe est incorrect';
            }

            if (!$admin) {
                $errors[] = 'Désolé nous n\'avons pas trouvé cet utilisateur dans la base de données';
            }

            if (empty($errors)) {
                $admin->delete();
                $success = 'L\'administrateur a bien été supprimé';

            }


        }

        $data = compact('errors', 'success');

        return $this->view('resume-admin', $data);
    }

}
