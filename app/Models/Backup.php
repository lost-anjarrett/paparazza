<?php
namespace Projet\Models;

use System\Model;

use DateTime;

class Backup extends Model
{

    const REPO = 'backups';
    const TABLE = 'ppz_backup';

    protected $filename;
    protected $description;
    protected $added_at;


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
        $columns = array_keys($datas);
        $columnsList = implode(', ', $columns);
        $paramsList = ':' . implode(', :', $columns);

        $sql = "INSERT INTO ". static::TABLE ." (". $columnsList  . ", added_at) VALUES (". $paramsList . ", NOW())";
        $this->db->execute($sql, $datas);

        $id = $this->db->getPdo()->lastInsertId();
        return $this->find($id);


    }



    /**
     * Get the value of Filename
     *
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the value of Filename
     *
     * @param mixed filename
     *
     * @return self
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function saveFile($content){

        $this->filename = (new DateTime)->format('Y-m-d_H-i-s');
        $this->filename .= '.phtml';
        $location = __DIR__ . '/../../ressources/views/'.static::REPO.'/'.$this->filename;

        if(file_put_contents($location, $content) === false){
            redirect('../products?error="Saving file"');
        }

        return $this;

    }

    public function deleteFile($img) {
        unlink(__DIR__.'/../../ressources/views/'.static::REPO.'/'.$this->filename);
        return $this;
    }

    public function getContent()
    {
        return file_get_contents(__DIR__ . '/../../ressources/views/'.static::REPO.'/'.$this->filename);
    }

}
