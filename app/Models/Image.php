<?php
namespace Projet\Models;

use System\Model;


class Image extends Model
{
    protected $img_src;
    protected $description;

    // GETTERS
    public function getImgSrc()
    {
        return $this->img_src;
    }

    public function getDescription()
    {
        return $this->description;
    }

    // SETTERS
    public function setImgSrc($src)
    {
        $this->img_src = $src;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function saveImg($img){

        // sauvegarde dans le dossier uploads/$repo
        move_uploaded_file($img, __DIR__.'/../../uploads/' . static::REPO . '/'.$this->img_src);
        return $this;

    }

    public function deleteImg() {
        // TODO : doit supprimer le fichier du serveur (unlink)
    }
}
