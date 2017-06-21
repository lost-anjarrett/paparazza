<?php
namespace Projet\Controllers;

use Projet\Models\Info;

class InfoController extends \System\Controller
{

    public function index()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        $infos = (new Info)->findOneBy('id', 1);



        $data = compact('infos');

        return $this->view('infos', $data);
    }


    public function edit()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        $infos = (new Info)->findOneBy('id', 1);

        if (isset($_POST) && !empty($_POST)) {
            checkCsrf();

            extract($_POST);
            $errors = [];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Votre adresse email n\'est pas valide';
            }
            if (empty($adress1) || empty($cp1) || empty($city1)) {
                $errors[] = 'Adresse 1 : Vous devez entrer une rue, un code postal et une ville';
            }
            if (strlen($cp1) != 5) {
                $errors[] = 'Adresse 1 : Le code postal doit être composé de 5 chiffres';
            }
            if (strlen($tel1) != 14) {
                $errors[] = 'Tel 1 : Le numéro doit être de format 01 23 45 67 89';
            }
            if (isset($adress2) && !empty($adress2)) {
                if (empty($cp2) || empty($city2)) {
                    $errors[] = 'Adresse 2 : Vous devez entrer une rue, un code postal et une ville';
                }
                if (strlen($cp2) != 5) {
                    $errors[] = 'Adresse 2 : Le code postal doit être composé de 5 chiffres';
                }
            }
            else {
                $adress2 = null;
                $complt_adress2 = null;
                $cp2 = null;
                $city2 = null;
            }
            if (isset($tel2) && !empty($tel2)) {
                if (strlen($tel2) != 14) {
                    $errors[] = 'Tel 2 : Le numéro doit être de format 01 23 45 67 89';
                }
            }
            else {
                $tel2 = null;
            }


            if (empty($errors)) {
                $infos->setEmail($email)
                    ->setAdress1($adress1)
                    ->setCompltAdress1($complt_adress1)
                    ->setCp1($cp1)
                    ->setCity1(ucfirst(strtolower($city1)))
                    ->setTel1($tel1)
                    ->setAdress2($adress2)
                    ->setCompltAdress2($complt_adress2)
                    ->setCp2($cp2)
                    ->setCity2(ucfirst(strtolower($city2)))
                    ->setTel2($tel2)
                    ->update();
                $this->redirect('admin/infos');
            }


        }

        $data = compact('errors', 'infos');

        return $this->view('infos', $data);
    }


}
