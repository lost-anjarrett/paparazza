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

        $data = compact('slides');

        return $this->view('slider', $data);
    }

    public function create(){

      if(!isLogged()){
          redirect('home');
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

        }
      }

      if(empty($errors)){
        redirect('../../admin/slider?success=true');
      }

      $datas = compact('title', 'errors');

      return $this->view('slider', $datas);
    }


    public function destroy(){

        if (!empty($_POST['slidesToDelete'])) {


          foreach ($_POST['slidesToDelete'] as $slide) {
            $image = $this->image->find($slide);

            $image->deleteImg($image)
                  ->delete();
          }

          redirect('../../admin/slider?success=true');
        }else{
          redirect('../../admin/slider');
        }


    }

}
