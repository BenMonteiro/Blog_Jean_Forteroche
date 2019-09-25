<?php
require_once ROOT_PATH.'/core/PDOConnection.php';

/**
 * This class make the sql request common tot the different Entitymanagers.
 * All of the EntityManagers have to extend this class
 */
class Manager
{
    protected static $bdd;
    // default constant of the database table name
    const TABLE_NAME ='';

    /**
     * The construct method make the connection to the database and load the Request class
     */
    public function __construct()
    {
        static::$bdd = PDOConnection::getMySqlConnection();
    }

    /**
     * This function find all the informations contained in the table 
     */
    public static function findAll()
    {
        $req = static::$bdd->query('SELECT * FROM `' . static::TABLE_NAME . '`ORDER BY id DESC');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find all the informations of the table where id is equal to the id find by the getParams method
     */
    public static function findOneById(int $id)
    {
        $req = static::$bdd->prepare('SELECT * FROM `' . static::TABLE_NAME . '`WHERE id = ?');
        $req->execute(array($id));
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public static function findLast()
    {
        $req = static::$bdd->query('SELECT* FROM`' . static::TABLE_NAME . '` ORDER BY id DESC LIMIT 0, 1');
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Delete the entry with the id find by the getParams method
     */
    public static function deleteById(int $id)
    {
       $req = static::$bdd->prepare('DELETE FROM`' . static::TABLE_NAME . '`WHERE id = ?');
       return $req->execute(array($id));
    }
}