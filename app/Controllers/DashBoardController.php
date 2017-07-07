<?php
namespace Projet\Controllers;

use Projet\Models\Admin;

class DashBoardController extends \System\Controller
{

    public function index()
    {

      if (!isLogged()) {
          $this->redirect('home');
      }

      return $this->view('accueil');
    }

    public function savePage()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        $location = __DIR__ . '/../../ressources/views/pages/test.phtml';
        // $page = fopen($location, 'r+');
        $html = file_get_contents($location);

        $search = "/(<!-- editable jukeback -->)([\n\t\r].*)*(<!-- endeditable jukeback -->)/";
        $replace = "<!-- editable jukeback -->\n" . $_POST['jukeback'] . "\n<!-- endeditable jukeback -->";
        $html = preg_replace($search,$replace,$html);

        // fwrite($page, $html);
        //fermetuer du fichier
        // fclose($page);
        file_put_contents($location, $html);

        return $html;

    }

}
