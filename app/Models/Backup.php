<?php
namespace Projet\Models;

use System\Model;

use DateTime;

class Backup extends Model
{

    const TABLE = 'ppz_backups';
    const REPO = 'backups';
    const FILES_LOCATION = [
        __DIR__ . '/../../ressources/views/pages/contact.phtml',
        __DIR__ . '/../../ressources/views/pages/gallery.phtml',
        __DIR__ . '/../../ressources/views/pages/partenaires.phtml',
        __DIR__ . '/../../ressources/views/pages/prestations.phtml',
        __DIR__ . '/../../ressources/views/pages/products-mosaique.phtml',
        __DIR__ . '/../../ressources/views/pages/products-pastilles.phtml',
        __DIR__ . '/../../ressources/views/pages/products.phtml',
        __DIR__ . '/../../ressources/views/pages/selling.phtml'
    ];

    protected $folder;
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
     * Get the value of Folder
     *
     * @return mixed
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set the value of Folder
     *
     * @param mixed folder
     *
     * @return self
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;

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

    /**
     * Copy the files to save in the backup repository
     *
     * @return self
     */
    public function saveFiles(){
        // Nomme le dossier d'après la date/heure courante
        $this->folder = (new DateTime)->format('Y-m-d_H-i-s');
        $backupFolderPath = $this->getFolderPath(); // génère le chemin correspondant
        mkdir($backupFolderPath); // crée le dossier

        // Sauvegarde un à un les fichiers éditables (renseignés dans FILES_LOCATION)
        foreach (static::FILES_LOCATION as $location) {
            $content = file_get_contents($location);
            if ($content === false) return false;

            $backupFileLocation = $this->getBackupFileLocation($location); // Donne le chemin du fichier à écrire de type ../views/backups/{date}/nom-de-fichier.phtml

            if(file_put_contents($backupFileLocation, $content) === false) return false;
        }

        return $this;
    }

    public function loadFiles()
    {
        $backupFolderPath = $this->getFolderPath();

        foreach (self::FILES_LOCATION as $location) {
            $backupFileLocation = $this->getBackupFileLocation($location);

            $content = file_get_contents($backupFileLocation);
            if ($content === false) return false;

            if(file_put_contents($location, $content) === false) return false;
        }

        return $this;
    }

    public function getFilenameFromLocation($location)
    {
        return substr($location, strrpos($location, '/')+1);
    }

    public function getFolderPath()
    {
        return __DIR__.'/../../ressources/views/'.static::REPO.'/'.$this->folder;
    }

    public function getBackupFileLocation($location)
    {
        return $this->getFolderPath().'/'.$this->getFilenameFromLocation($location);
    }

    public function deleteFile() {
        unlink($this->getFolderPath());
        return $this;
    }

    public function getContent()
    {
        return file_get_contents(__DIR__ . '/../../ressources/views/'.static::REPO.'/'.$this->filename);
    }

}
