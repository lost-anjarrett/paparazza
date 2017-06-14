<?php

namespace Projet\Controllers;

use Models\Admin;

class AuthController extends \System\Controller
{

    //@get index.php/landing

    public function login()
    {
        if (isset($_POST) && !empty($_POST)) {
            extract($_POST);

            $admin = (new Admin)->findOneBy('name', $name);

            /*
                verif password
                ...
            */
        }

        return $this->view('pages/products');
    }

}
