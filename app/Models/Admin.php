<?php
namespace Projet\Models;

use System\Model;

class Admin extends Model
{
    const TABLE = 'ppz_admin';

    protected $name;
    protected $password;
    protected $doc;
    protected $last_connection;
}
