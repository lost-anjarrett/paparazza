<?php

namespace Projet\Controllers;

use Projet\Models\Info;
use Projet\Models\SliderImg;
use Projet\Models\GalleryImg;
use Projet\Models\PartnersLogo;

class PageController extends \System\Controller
{
    const VIEWS_PATH = [
        '404'             => __DIR__ . '/../../ressources/views/error404.phtml',
        'dev'             => __DIR__ . '/../../ressources/views/pages/work-in-progress.phtml',
        'contact'         => __DIR__ . '/../../ressources/views/pages/contact.phtml',
        'gallery'         => __DIR__ . '/../../ressources/views/pages/gallery.phtml',
        'galleryAjax'     => __DIR__ . '/../../ressources/views/pages/getResult.phtml',
        'landing'         => __DIR__ . '/../../ressources/views/landing.phtml',
        'mentions'        => __DIR__ . '/../../ressources/views/mentions-legales.phtml',
        'mosaique'        => __DIR__ . '/../../ressources/views/pages/products-mosaique.phtml',
        'partenaires'     => __DIR__ . '/../../ressources/views/pages/partenaires.phtml',
        'parten_one_page' => __DIR__ . '/../../ressources/views/partenaires.phtml',
        'pastilles'       => __DIR__ . '/../../ressources/views/pages/products-pastilles.phtml',
        'prestations'     => __DIR__ . '/../../ressources/views/pages/prestations.phtml',
        'products'        => __DIR__ . '/../../ressources/views/pages/products.phtml',
        'selling'         => __DIR__ . '/../../ressources/views/pages/selling.phtml'
    ];
    //@get index.php/landing

    public function index($page = '')
    {
        $infos = (new Info)->find(1);

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

        include(self::VIEWS_PATH['landing']);

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

      include(self::VIEWS_PATH['galleryAjax']);

      $view = ob_get_contents();

      ob_end_clean();

      return $view;
    }

    public function dev()
    {
        ob_start();

        include(self::VIEWS_PATH['dev']);

        $view = ob_get_contents();

        ob_end_clean();

        return $view;
    }

    public function error(){

      ob_start();

      include(self::VIEWS_PATH['404']);

      $view = ob_get_contents();

      ob_end_clean();

      return $view;
    }

    public function mentions()
    {
        $infos = (new Info)->find(1);

        ob_start();
        include(self::VIEWS_PATH['mentions']);
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }

    public function partenaires()
    {
        $infos = (new Info)->find(1);
        $partnersLogos = (new PartnersLogo)->findAll();

        ob_start();
        include(self::VIEWS_PATH['parten_one_page']);
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }

    public function savePage()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        $modified = [];

        foreach ($_POST as $region => $content) {
            $pathName = substr($region, 0, strpos($region, '_') );

            $html = file_get_contents(self::VIEWS_PATH[$pathName]);

            $search = "/(<!-- editable ".$region." -->)([\n\t\r].*)*(<!-- endeditable ".$region." -->)/";
            $replace = "<!-- editable ".$region." -->\n" . $content . "\n<!-- endeditable ".$region." -->";
            $html = preg_replace($search,$replace,$html);

            if (file_put_contents(self::VIEWS_PATH[$pathName], $html) !== false) {
                $modified[] = $pathName;
            }
        }

        $response = '';

        foreach ($modified as $filename) {
            $response .= 'Fichier modifié : '. $filename . "\n";
        }

        return $response;

    }

}
