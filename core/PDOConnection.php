<?php

/**
 * Connection to the database
 * we use a singleton pattern in to order to only have one object of the PDOConnection
 */
class PDOConnection
{
    const PDO_ERROR = 'Une erreur s\'est produite en tenant d\'accéder à la base de donnée';
    private static $dbConnection = null;

    public static function getMySqlConnection()
    {

            if (null === static::$dbConnection){
                static::$dbConnection = new PDO('mysql:host=localhost;dbname=blog_p4', 'root', '');
            } else {

                throw new PDOException (self::PDO_ERROR);
            }
            return static::$dbConnection;
    }
}