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
}
