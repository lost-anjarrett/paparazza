<?php

namespace System;

// use Projet\Models\User;

abstract class Controller{

    // private $user;
    //
    //
    // public function __construct(){
    //     if(isLogged()){
    //         $this->user = (new User)->find($_SESSION['userId']);
    //     }
    // }
    //
    // public function getUser(){
    //     return $this->user;
    // }

    public function view($template, $datas = [])
    {

        extract($datas);

        ob_start();

        include(__DIR__ . '/../ressources/views/landing.phtml');

        $view = ob_get_contents();

        ob_end_clean();

        return $view;

    }



}
