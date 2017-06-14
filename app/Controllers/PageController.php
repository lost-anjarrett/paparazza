<?php

namespace Projet\Controllers;

class PageController extends \System\Controller
{

    //@get index.php/landing

    public function index()
    {
        $datas = [];

        return $this->view('pages/products');
    }

}
