<?php

namespace Projet\Traits;


trait SaveDrawing{

  public function saveDrawing($img, $fileName, $repo = ''){

      // sauvegarde dans le dossier uploads/$repo
      move_uploaded_file($img, __DIR__.'/../../uploads/' . $repo . '/'.$fileName);

  }

}
