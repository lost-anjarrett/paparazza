<?php
namespace Projet\Models;

use Image;

class ProductImg extends Image
{
    const TABLE = 'ppz_products_img';

    protected $product_id;
    protected $main_img;
}
