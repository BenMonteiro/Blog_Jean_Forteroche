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
        if (null === static::$dbConnection) {
            static::$dbConnection = new PDO('mysql:
                host=' . static::$host . ';
                dbname=' . static::$dbName . ';
                charset=utf8', 
                static::$login, 
                static::$password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                )
            );
        }

        return static::$dbConnection;
    }
}
