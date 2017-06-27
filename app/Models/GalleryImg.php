<?php
namespace Projet\Models;

use Projet\Models\Image;

class GalleryImg extends Image
{
    const TABLE = 'ppz_gallery_img';
    const REPO = 'gallery';

    protected $show;
    protected $added_at;

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

}
