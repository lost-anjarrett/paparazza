<?php
namespace Projet\Models;

use Projet\Models\Image;

class GalleryImg extends Image
{
    const TABLE = 'ppz_gallery_img';
    const REPO = 'gallery';

    protected $show;


    /**
     * Get the value of Show
     *
     * @return mixed
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * Set the value of Show
     *
     * @param mixed show
     *
     * @return self
     */
    public function setShow($show)
    {
        $this->show = $show;

        return $this;
    }

    
}
