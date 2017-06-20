<?php
namespace Projet\Controllers;

use Projet\Models\Image;

use Pojet\Traits\SaveDrawing;

class SliderController extends \System\Controller{

    protected $image;

    public function __construct(){
        // parent::__construct();
        $this->post = new Image;
    }

    // public function show($id){
    //
    //     $post = $this->post->getOneFromAuthor($id);
    //
    //     $comments = (new Comment)->getPostCommentsWithAutor($post->getId());
    //
    //     $title = $post->getTitle();
    //
    //     $datas = compact('title', 'post', 'comments');
    //
    //     return $this->view('post/post', $datas);
    // }

    public function create(){

        if(!isLogged()){
            redirect('pages/home');
        }

        $title = 'Slider';

        $image = $this->image;

        if(!empty($_POST)){

          checkCsrf();

          $errors = [];

          if(!isset($_FILES) OR empty($_FILES)){
            $error = 'Merci de choisir une image';
          }

          $image->setDescription($description);

          $img_src = randString(20).'.png'; // La fonction randString est dans le fichier app/helpers.php

          $image->setImgSrc($img_src);

          $this->saveDrawing($_FILES['uploaded_img']['tmp_name'], $fileName, 'slider');

          // $image->create();

          redirect('post/slider');
        }

        $datas = compact('title', 'post', 'error');

        return $this->view('post/form', $datas);
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
