<?php
namespace Projet\Models;

use System\Model;

class Info extends Model
{
    const TABLE = 'ppz_infos';

    protected $email;
    protected $tel1;
    protected $adress1;
    protected $complt_adress1;
    protected $cp1;
    protected $city1;
    protected $tel2;
    protected $adress2;
    protected $complt_adress2;
    protected $cp2;
    protected $city2;



    /**
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of Tel
     *
     * @return mixed
     */
    public function getTel1()
    {
        return $this->tel1;
    }

    /**
     * Set the value of Tel
     *
     * @param mixed tel1
     *
     * @return self
     */
    public function setTel1($tel1)
    {
        $this->tel1 = $tel1;

        return $this;
    }

    /**
     * Get the value of Adress
     *
     * @return mixed
     */
    public function getAdress1()
    {
        return $this->adress1;
    }

    /**
     * Set the value of Adress
     *
     * @param mixed adress1
     *
     * @return self
     */
    public function setAdress1($adress1)
    {
        $this->adress1 = $adress1;

        return $this;
    }

    /**
     * Get the value of Complt Adress
     *
     * @return mixed
     */
    public function getCompltAdress1()
    {
        return $this->complt_adress1;
    }

    /**
     * Set the value of Complt Adress
     *
     * @param mixed complt_adress1
     *
     * @return self
     */
    public function setCompltAdress1($complt_adress1)
    {
        $this->complt_adress1 = $complt_adress1;

        return $this;
    }

    /**
     * Get the value of Cp
     *
     * @return mixed
     */
    public function getCp1()
    {
        return $this->cp1;
    }

    /**
     * Set the value of Cp
     *
     * @param mixed cp1
     *
     * @return self
     */
    public function setCp1($cp1)
    {
        $this->cp1 = $cp1;

        return $this;
    }

    /**
     * Get the value of City
     *
     * @return mixed
     */
    public function getCity1()
    {
        return $this->city1;
    }

    /**
     * Set the value of City
     *
     * @param mixed city1
     *
     * @return self
     */
    public function setCity1($city1)
    {
        $this->city1 = $city1;

        return $this;
    }

    /**
     * Get the value of Tel
     *
     * @return mixed
     */
    public function getTel2()
    {
        return $this->tel2;
    }

    /**
     * Set the value of Tel
     *
     * @param mixed tel2
     *
     * @return self
     */
    public function setTel2($tel2)
    {
        $this->tel2 = $tel2;

        return $this;
    }

    /**
     * Get the value of Adress
     *
     * @return mixed
     */
    public function getAdress2()
    {
        return $this->adress2;
    }

    /**
     * Set the value of Adress
     *
     * @param mixed adress2
     *
     * @return self
     */
    public function setAdress2($adress2)
    {
        $this->adress2 = $adress2;

        return $this;
    }

    /**
     * Get the value of Complt Adress
     *
     * @return mixed
     */
    public function getCompltAdress2()
    {
        return $this->complt_adress2;
    }

    /**
     * Set the value of Complt Adress
     *
     * @param mixed complt_adress2
     *
     * @return self
     */
    public function setCompltAdress2($complt_adress2)
    {
        $this->complt_adress2 = $complt_adress2;

        return $this;
    }

    /**
     * Get the value of Cp
     *
     * @return mixed
     */
    public function getCp2()
    {
        return $this->cp2;
    }

    /**
     * Set the value of Cp
     *
     * @param mixed cp2
     *
     * @return self
     */
    public function setCp2($cp2)
    {
        $this->cp2 = $cp2;

        return $this;
    }

    /**
     * Get the value of City
     *
     * @return mixed
     */
    public function getCity2()
    {
        return $this->city2;
    }

    /**
     * Set the value of City
     *
     * @param mixed city2
     *
     * @return self
     */
    public function setCity2($city2)
    {
        $this->city2 = $city2;

        return $this;
    }

    /**
     * Get all object properties 
     *
     * @return mixed Array
     */
    public function toArray()
    {

        $attributes = get_object_vars($this);

        unset($attributes['db']);  // On supprime l'index db qui ne fait pas référence à une colonne de table

        return $attributes;

    }
}
