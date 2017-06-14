<?php
namespace Projet\Models;

use System\Model;

class Product extends Model
{
    const TABLE = 'ppz_products';

    protected $name;
    protected $password;
    protected $doc;
    protected $last_connection;
}
