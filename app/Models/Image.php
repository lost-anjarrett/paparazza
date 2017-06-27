<?php
namespace Projet\Models;

use System\Model;


class Image extends Model
{
    protected $img_src;
    protected $description;
    protected $added_at;


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

    public function deleteImg($img) {
      unlink(__DIR__.'/../../uploads/' . static::REPO . '/'.$this->img_src);
      return $this;
    }

    /**
     * Get the value of Added At
     *
     * @return mixed
     */
    public function getAddedAt()
    {
        return $this->added_at;
    }

    /**
     * Set the value of Added At
     *
     * @param mixed added_at
     *
     * @return self
     */
    public function setAddedAt($added_at)
    {
        $this->added_at = $added_at;

        return $this;
    }


    public function create(){

        $datas = $this->toArray();

        $columns = array_keys($datas);  // ex: ['name', 'birthday','email','password']

        $columnsList = implode(', ', $columns);   // "name, birthday ,email ,password"

        $paramsList = ':' . implode(', :', $columns);  // ":name, :birthday, :email ,:password, :city"

        $sql = "INSERT INTO ". static::TABLE ." (". $columnsList  . ", added_at) VALUES (". $paramsList . ", NOW())";

        $this->db->execute($sql, $datas);


        $id = $this->db->getPdo()->lastInsertId();

        return $this->find($id);


    }


}
