<?php

namespace Projet\Controllers;

use Projet\Models\Backup;

class TextController extends \System\Controller
{

    //@get index.php/landing


    public function index()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        $backups = (new Backup)->findAll();

        $data = compact('backups');

        return $this->view('text', $data);

    }

}
