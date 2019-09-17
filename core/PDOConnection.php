<?php

/**
 * Connection to the database
 * we use a singleton pattern in to order to only have one object of the PDOConnection
 */
class PDOConnection
{

    private static $host = 'localhost';
    private static $dbName = 'blog_p4';
    private static $login = 'root';
    private static $password = '';
    private static $dbConnection = null;

    public static function getMySqlConnection()
    {
        if (null === static::$dbConnection){

            static::$dbConnection = new PDO('mysql:host='.static::$host.';dbname='.static::$dbName.'', static::$login, static::$password);
        } 

        return static::$dbConnection;
    }
}