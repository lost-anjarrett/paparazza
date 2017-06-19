<?php

namespace Projet\Traits;


trait saveDrawing{

  public function saveDrawing($img, $fileName, $repo = ''){

      // sauvegarde dans le dossier uploads/$repo
      file_put_contents(__DIR__.'/../../uploads/' . $repo . '/'.$fileName, $img);

  }

}
