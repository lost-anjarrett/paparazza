<?php
namespace Projet\Models;

use System\Model;

class Admin extends Model
{
    const TABLE = 'ppz_admin';

    protected $name;
    protected $password;
    protected $doc;
    protected $last_connexion;

    // GETTERS
    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getDoc()
    {
        return $this->doc;
    }

    public function getLastConnexion()
    {
        return $this->last_connexion;
    }

    // SETTERS
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }

    // surcharge la fonction create de Model
    public function create(){

        $datas = $this->toArray();

        $columns = array_keys($datas);  // ex: ['name', 'birthday','email','password']

        $columnsList = implode(', ', $columns);   // "name, birthday ,email ,password"

        $paramsList = ':' . implode(', :', $columns);  // ":name, :birthday, :email ,:password, :city"

        $sql = "INSERT INTO ". static::TABLE ." (". $columnsList  . ", doc) VALUES (". $paramsList . ", NOW())";

        $this->db->execute($sql, $datas);


        $id = $this->db->getPdo()->lastInsertId();

        return $this->find($id);


    }


    public function logConnexion()
    {
        $id = $this->getId();

        $sql = "UPDATE ". static::TABLE ." SET last_connexion = NOW() WHERE id = ?";

        $this->db->execute($sql, [$id]);

        return $this;

    }

}
