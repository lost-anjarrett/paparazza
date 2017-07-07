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
        $html = file_get_contents($location);

        foreach ($_POST as $product => $content) {
            $search = "/(<!-- editable ".$product." -->)([\n\t\r].*)*(<!-- endeditable ".$product." -->)/";
            $replace = "<!-- editable ".$product." -->\n" . $content . "\n<!-- endeditable ".$product." -->";
            $html = preg_replace($search,$replace,$html);
        }


        file_put_contents($location, $html);

        return 'ok';

    }

}
