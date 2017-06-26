<?php
namespace Projet\Models;

use Projet\Models\Image;

class GalleryImg extends Image
{
    const TABLE = 'ppz_gallery_img';
    const REPO = 'gallery';

    protected $show;
    protected $added_at;
}
