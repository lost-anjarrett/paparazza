<?php

namespace Projet\Controllers;

use DateTime;

class ProductController extends \System\Controller
{

    //@get index.php/landing


    public function index()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        return $this->view('products');

    }

    public function savePage()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        $location = __DIR__ . '/../../ressources/views/pages/products.phtml';
        $html = file_get_contents($location);

        foreach ($_POST as $product => $content) {
            $search = "/(<!-- editable ".$product." -->)([\n\t\r].*)*(<!-- endeditable ".$product." -->)/";
            $replace = "<!-- editable ".$product." -->\n" . $content . "\n<!-- endeditable ".$product." -->";
            $html = preg_replace($search,$replace,$html);
        }


        file_put_contents($location, $html);

        return 'ok';

    }

    public function saveBackup()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        $products = __DIR__ . '/../../ressources/views/pages/products.phtml';
        $html = file_get_contents($products);

        $filename = (new DateTime)->format('Y-m-d_H-i-s');
        $backup = __DIR__ . '/../../ressources/views/backups/'.$filename.'.phtml';

        file_put_contents($backup, $html);

        $this->redirect('admin/products');

    }

    public function loadBackup($filename)
    {
        if (!isLogged()) {
            $this->redirect('home');
        }


        $backup = __DIR__ . '/../../ressources/views/backups/'.$filename;
        $html = file_get_contents($backup);

        if ($html) {
            $products = __DIR__ . '/../../ressources/views/pages/products.phtml';
            file_put_contents($products, $html);
        } else {
            die 'Une erreur est survenue lors de la récupération';
        }

        $this->redirect('admin/products');

    }
}
