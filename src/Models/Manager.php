<?php

require_once ROOT_PATH.'/core/PDOConnection.php';
/**
 * This class make the sql request common tot the different Entitymanagers.
 * All of the EntityManagers have to extend this class
 */
class Manager
{
    protected $bdd;
    protected $request;

    // default constant of the database table name
    const TABLE_NAME ='';

    /**
     * The construct method make the connection to the database and load the Request class
     */
    public function __construct()
    {
        $this->bdd = PDOConnection::getMySqlConnection();
        $this->request = Request::getRequest();
    }
    
    /**
     * This function find all the informations contained in the table 
     */
    public function findAll()
    {
        return $this->bdd->query('SELECT * FROM `' . static::TABLE_NAME . '`ORDER BY id DESC');
    }

    /**
     * Find all the informations of the table where id is equal to the id find by the getParams method
     */
    public function findOne()
    {
        $req = $this->bdd->prepare('SELECT * FROM ' . static::TABLE_NAME . 'WHERE id = :id');
        return $req->execute(array(
            'id' => $this->request->getParams('id')
        ));
    }

    /**
     * Delete the entry with the id find by the getParams method
     */
    public function delete()
    {
        $req = $this->bdd->prepare('DELETE FROM' . static::TABLE_NAME . 'WHERE id = :id');
        return $req->execute(array(
            'id' => $this->request->getParams('id')
        ));
    }
}