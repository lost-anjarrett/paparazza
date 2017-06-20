<?php
namespace Projet\Controllers;

use Projet\Models\SliderImg;


class SliderController extends \System\Controller{

    protected $image;

    public function __construct(){
        // parent::__construct();
        $this->image = new SliderImg;
    }

    public function index()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        $slides = $this->image->findAll();

        $data = compact($slides);

        return $this->view('slider', $data);
    }

    public function create(){

      if(!isLogged()){
          redirect('pages/home');
      }

      $title = 'Slider';

      $image = $this->image;


      if(!empty($_POST)){


        checkCsrf();

        extract($_POST);

        $errors = [];

        switch($_FILES['uploaded_img']['error']){
          case 2:
            $errors[] = 'L\'image est trop volumineuse';
            break;
            case 3:
              $errors[] = 'Fichier partiellement téléchargé';
              break;
          case 4:
            $errors[] = 'Merci de sélectionner une image à envoyer';
            break;
            case 7:
              $errors[] = 'Erreur lors de l\'écriture sur le disque';
              break;
        }


        if (!checkExtension($_FILES['uploaded_img']['name'])) {
          $errors[] = 'type de fichier non valide (jpg, jpeg, png)';
        }
       if (empty($errors)) {
         $image->setDescription($description)
                ->setImgSrc(randString(20).'.png')
                ->saveImg($_FILES['uploaded_img']['tmp_name'])
                ->create();
          $success = 'L\'image a bien été ajoutée';
        }
      }

      $datas = compact('title', 'errors', 'success');

      return $this->view('slider', $datas);
    }
   // post/5/delete
    public function destroy($id){

        $post = $this->post->find($id);

        if ($post->isAuthor()) {
            $post->delete();
            $fileName = $post->getDrawing_src(true);
            unlink(__DIR__.'/../../uploads/drawings/'.$fileName);
            redirect('pages/home');
        }
    }

    public function update($id){

        $title = 'Modifier le dessin';

        $post = $this->post->find($id);

        $datas = compact('title', 'post');

        if(!empty($_POST)){

            checkCsrf();

            unset($_POST['drawing_src']);



            $fileName = $post->getDrawing_src(true); // La fonction randString est dans le fichier app/helpers.php

            $this->saveDrawing($_POST['drawing'], $fileName);

            $post->setDrawing_src($fileName);

            $post->update();

            redirect('pages/home');
        }

        return $this->view('admin/slider', $datas);
    }

}
