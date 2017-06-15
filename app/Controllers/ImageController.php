<?php

namespace Projet\Controllers;

class ImageController extends \System\Controller
{

    public function create(){

      if (isset($_POST) && !empty($_POST) {

          $errors = [];

          if(!isset($_FILES) OR empty($_FILES)){
            $error = 'Merci de choisir une image';
          }
          extract($_POST);

          $admin = (new Admin)->findOneBy('name', $name);

          if (!$admin || !password_verify($password, $admin->getPassword()) ) {
              $error = 'Le nom d\'utilisateur n\'existe pas ou le mot de passe est incorrect';
          }

          if(!isset($error)) {
              $admin->logConnexion();
              $_SESSION['admin'] = $admin;
              $_SESSION['csrf_token'] = randString(50);
              $this->redirect('admin/dashboard');
          }
      }
    }

}
