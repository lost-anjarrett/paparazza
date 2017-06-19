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

      return $this->view('slider');
    }

    public function show($slug)
    {
      if (!isLogged()) {
          $this->redirect('home');
      }

      return $this->view($slug);
    }



}
