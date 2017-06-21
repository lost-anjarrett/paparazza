<?php

namespace Projet\Controllers;

use Projet\Models\Info;
use Projet\Models\SliderImg;

class PageController extends \System\Controller
{

    //@get index.php/landing

    public function index()
    {
        $infos = (new Info)->findOneBy('id', 1);

        $slides = (new SliderImg)->findAll();

        ob_start();

        include(__DIR__ . '/../../ressources/views/landing.phtml');

        $view = ob_get_contents();

        ob_end_clean();

        return $view;
    }

}
