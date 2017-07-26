<?php
namespace Projet\Controllers;

use Projet\Models\PartnersLogo;


class PartnerController extends \System\Controller
{
    protected $image;

    public function __construct(){
        $this->image = new PartnersLogo;
    }

    public function index()
    {
        if (!isLogged()) {
            $this->redirect('home');
        }

        $partnersLogos = $this->image->findAll();

        $data = compact('partnersLogos');

        return $this->view('partenaires', $data);
    }

    public function create(){

      if(!isLogged()){
          redirect('home');
      }

      $title = 'Partenaires';

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
        redirect('../../admin/partners?success=true');
      }

      $datas = compact('title', 'errors');

      return $this->view('partenaires', $datas);
    }


    public function destroy(){

        if (!empty($_POST['imgToDelete'])) {


          foreach ($_POST['imgToDelete'] as $img) {
            $image = $this->image->find($img);

            $image->deleteImg($image)
                  ->delete();
          }

          redirect('../../admin/partners?success=true');
        }else{
          redirect('../../admin/partners');
        }


    }

}
