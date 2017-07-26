<?php

namespace Projet\Controllers;

use Projet\Models\Info;
use Projet\Models\SliderImg;
use Projet\Models\GalleryImg;

class PageController extends \System\Controller
{

    //@get index.php/landing

    public function index($page = '')
    {
        $infos = (new Info)->findOneBy('id', 1);

        $slides = (new SliderImg)->findAll();
        //Getting images for the Gallery
        //Number of pictures
        $limit = 4;
        //if there's a page param...
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $galleryImg = new GalleryImg;

        $imgsCounted = $galleryImg->getFromTo($page, $limit);

        $imgs = $imgsCounted['objects'];
        //the total of imgs registered
        $rowNumber = $imgsCounted['rowNumber'];
        //total of pages needed
        $numberOfPages = ceil($rowNumber / $limit);

        ob_start();

        include(__DIR__ . '/../../ressources/views/landing.phtml');

        $view = ob_get_contents();

        ob_end_clean();

        return $view;
    }

    public function galleryAjax($page){

      $limit = 4;

      $imgsCounted = (new GalleryImg)->getFromTo($page, $limit);

      $imgs = $imgsCounted['objects'];
      //the total of imgs registered
      $rowNumber = $imgsCounted['rowNumber'];
      //total of pages needed
      $numberOfPages = ceil($rowNumber / $limit);

      ob_start();

      include(__DIR__ . '/../../ressources/views/pages/getResult.phtml');

      $view = ob_get_contents();

      ob_end_clean();

      return $view;
    }

    public function dev()
    {
        ob_start();

        include(__DIR__ . '/../../ressources/views/pages/work-in-progress.phtml');

        $view = ob_get_contents();

        ob_end_clean();

        return $view;
    }

    public function error(){

      ob_start();

      include(__DIR__ . '/../../ressources/views/error404.phtml');

      $view = ob_get_contents();

      ob_end_clean();

      return $view;
    }

    public function mentions()
    {
        $infos = (new Info)->findOneBy('id', 1);

        ob_start();
        include(__DIR__ . '/../../ressources/views/mentions-legales.phtml');
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }

    public function savePage()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        $location = [
            'products' => __DIR__ . '/../../ressources/views/pages/products.phtml'
        ];


        foreach ($_POST as $region => $content) {
            $html = file_get_contents($location['products']);

            $search = "/(<!-- editable ".$region." -->)([\n\t\r].*)*(<!-- endeditable ".$region." -->)/";
            $replace = "<!-- editable ".$region." -->\n" . $content . "\n<!-- endeditable ".$region." -->";
            $html = preg_replace($search,$replace,$html);

            file_put_contents($location['products'], $html);
        }

        return $location['products'];

    }

}
