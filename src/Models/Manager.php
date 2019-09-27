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
     * @return array
     */
    public static function findAll(): array
    {
        $req = static::$bdd->query(
            'SELECT *
            FROM `' . static::TABLE_NAME . '`
            ORDER BY id DESC'
        );

        return $req->fetchAll();
    }

    /**
     * Find all the informations of the table where id is equal to the id find by the getParams method
     * @param int $id       [id of the element]
     * @return array
     */
    public static function findOneById(int $id): array
    {
        $req = static::$bdd->prepare(
            'SELECT *
            FROM `' . static::TABLE_NAME . '`
            WHERE id = ?'
        );
        $req->execute(array($id));

        return $req->fetch();
    }

    /**
     * Find the last element of the table
     * @return array
     */
    public static function findLast(): array
    {
        $req = static::$bdd->query(
            'SELECT *
            FROM`' . static::TABLE_NAME . '`
            ORDER BY id DESC
            LIMIT 0, 1'
        );

        return $req->fetch();
    }

    /**
     * Delete the entry with the id find by the getParams method
     * @param int $id       [id of the element]
     * @return array 
     */
    public static function deleteById(int $id): array
    {
        $req = static::$bdd->prepare(
           'DELETE
           FROM`' . static::TABLE_NAME . '`
           WHERE id = ?'
        );

       return $req->execute(array($id));
    }
}
