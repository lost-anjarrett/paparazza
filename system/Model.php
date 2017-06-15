<?php
namespace System;

use System\DB;

abstract class Model {

   protected $db;
   protected $id;

   public function __construct () {

       $this->db = new DB;

   }

   public function getId()
   {
       return $this->id;
   }

 /**
     * @return array
     */
    public function toArray(){

        $attributes = get_object_vars($this);

        unset($attributes['db']);  // On supprime l'index db qui ne fait pas référence à une colonne de table

        return array_filter($attributes);

    }

    public static function getColumns()
    {
        $properties = get_class_vars(static::class);
        unset($properties['db'], $properties['author']);
        return array_keys($properties);
    }

    /**
     * @return Instance
     */
    public function find($id){

        $result = $this->db->queryOne('SELECT * FROM ' . static::TABLE . ' WHERE id = ?', [$id]);

        return $this->getInstance($result);
    }

    public function findAll(){

        $datas = $this->db->query('SELECT * FROM ' . static::TABLE);
        return $this->getCollection($datas);

    }

    public function findOneBy($column, $value)
    {
		$this->checkColumn($column);

        $result = $this->db->queryOne('SELECT * FROM ' . static::TABLE . ' WHERE '.$column.' = ?', [$value]);

        return $this->getInstance($result);
    }

    public function findAllBy($column, $value)
    {
        $this->checkColumn($column);

        $result = $this->db->query('SELECT * FROM ' . static::TABLE . ' WHERE '.$column.' = ?', [$value]);

        return $this->getCollection($result);
    }

    public function create(){

        $datas = $this->toArray();

        $columns = array_keys($datas);  // ex: ['name', 'birthday','email','password']

        $columnsList = implode(', ', $columns);   // "name, birthday ,email ,password"

        $paramsList = ':' . implode(', :', $columns);  // ":name, :birthday, :email ,:password, :city"

        $sql = "INSERT INTO ". static::TABLE ." (". $columnsList  . ") VALUES (". $paramsList . ")";

        $this->db->execute($sql, $datas);


        $id = $this->db->getPdo()->lastInsertId();

        return $this->find($id);


    }

    public function update()
    {
        $datas = $this->toArray();

        // unset($datas['updated_at'], $datas['created_at']);


        $columns = array_keys($datas);  // ['id','name', 'birthday','email','password','created_at']

        $sql = "UPDATE ". static::TABLE ." SET ";

        foreach($columns as $column){

           $sql .= "$column = :$column, ";

        }

        // $sql .= "updated_at = NOW() WHERE id = :id";


        $this->db->execute($sql, $datas);

        return $this;

    }

    public function delete()
    {
        $sql = "DELETE FROM " . static::TABLE . " WHERE id = ?";

        $this->db->execute($sql, [$this->id]);
    }

    public function getInstance($result){

        if ($result){  // vérifie si $result ne Vaut pas false (dans le cas où la requête n'aurait renvoyé aucun résultat)

            $instance = new static; // nouvel objet de la class "courante"
            foreach ($result as $key => $value) {
                $instance->$key = $value;
            }
            return $instance;

        }
        else
        {
            return null;
        }

    }

    public function getCollection($results){

        if($results) {

            $collection = [];

            foreach ($results as $result){

                $collection[] = $this->getInstance($result);

            }

            return $collection;

       }

       return null;

    }

    public function getLasts($nbr)
    {
        if (!is_int($nbr)) {
            die('Il faut entrer un nombre');
        }

        $datas = $this->db->query('SELECT * FROM ' . static::TABLE . ' ORDER BY created_at DESC LIMIT 0, '.$nbr);

        return $this->getCollection($datas);
    }


    protected function checkColumn($column)
    {
        if(!preg_match('#^[a-zA-Z0-9_]+$#', $column)){

            die('Error: invalid column param');

        }
    }

}
