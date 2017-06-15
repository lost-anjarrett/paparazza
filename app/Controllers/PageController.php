<?php

namespace Projet\Controllers;

class PageController extends \System\Controller
{

    //@get index.php/landing

    public function index()
    {

      ob_start();

      include(__DIR__ . '/../../ressources/views/landing.phtml');

      $view = ob_get_contents();

      ob_end_clean();

      return $view;
    }

}
