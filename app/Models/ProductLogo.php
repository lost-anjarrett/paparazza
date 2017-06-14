<?php
namespace Projet\Models;

use Image;

class ProductLogo extends Image
{
    const TABLE = 'ppz_products_logo';

    protected $product_id;
}
