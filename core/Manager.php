<?php
require_once ROOT_PATH.'/core/PDOConnection.php';

/**
 * This class make the sql request common tot the different Entitymanagers.
 * All of the EntityManagers have to extend this class
 */
abstract class Manager
{
    // default constant of the database table name
    protected static $tableName;

    /**
     * The construct method make the connection to the database and load the Request class
     */
    public static function getPDO()
    {
        return PDOConnection::getMySqlConnection();
    }

    /**
     * This function find all the informations contained in the table
     */
    public static function findAll()
    {
        $req = static::getPDO()->query(
            'SELECT *
            FROM ' . static::$tableName . '
            ORDER BY id DESC'
        );

        return $req->fetchAll();
    }

    /**
     * Find all the informations of the table where id is equal to the id find by the getParams method
     * @param $id       [id of the element]
     */
    public static function findOneById($id)
    {
        $req = static::getPDO()->prepare(
            'SELECT *
            FROM ' . static::$tableName . '
            WHERE id = ?'
        );

        $req->execute(array($id));

        return $req->fetch();
    }

    /**
     * Find the last element of the table
     */
    public static function findLast()
    {
        $req = static::getPDO()->query(
            'SELECT *
            FROM '. static::$tableName .'
            ORDER BY id DESC
            LIMIT 0, 1'
        );

        return $req->fetch();
    }

    /**
     * Delete the entry with the id find by the getParams method
     * @param $id       [id of the element]
     */
    public static function deleteById($id)
    {
        $req = static::getPDO()->prepare(
           'DELETE
           FROM ' . static::$tableName . '
           WHERE id = ?'
        );

       return $req->execute(array($id));
    }
}
