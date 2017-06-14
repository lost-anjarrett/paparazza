<?php
namespace System;

 (PDO, DateTime, etc)
use PDO;

class DB
{
    const DB_HOST = 'mysql:host=localhost;';
    const DB_DATABASE = 'dbname=paparazza;charset=utf8';
    const DB_USERNAME = 'paparazza';
    const DB_PASSWORD = 'yg1234';

    protected static $pdo = null;

    function __construct()
    {
        if (self::$pdo == null) {
            try {
                self::$pdo = new PDO(
                    self::DB_HOST.self::DB_DATABASE,
                    self::DB_USERNAME,
                    self::DB_PASSWORD,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
                self::$pdo->exec('SET NAMES utf8');
            }
            catch (PDOException $e) {
                die('Erreur : ' .$e->getMessage());
            }
        }
    }

    /**
     * @return null|PDO
     */
    public static function getPdo()
    {
        return self::$pdo;
    }

    public function queryOne($sql, $values = [])
    {
        $query = self::$pdo->prepare($sql);
        $query->execute($values);
        return $query->fetch();
    }

    public function query($sql, $values = [])
    {
        $query = self::$pdo->prepare($sql);
        $query->execute($values);
        return $query->fetchAll();
    }

    public function execute($sql, $values = [])
    {
        $query = self::$pdo->prepare($sql);
        $query->execute($values);
        return $query;
    }
}
