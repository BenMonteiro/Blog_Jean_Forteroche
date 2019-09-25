<?php

require_once ROOT_PATH.'/src/Models/Manager.php';

class UserManager extends Manager
{
    const TABLE_NAME = 'user';

                /**
     * Find all the informations of a user where login and password are equal to the given infos
     */
    public static function findOne($login, $password)
    {
        $req = static::$bdd->prepare('SELECT * FROM `' . static::TABLE_NAME . '`WHERE login = ? AND password = ?');
        $req->execute(array($login, $password));
        return $req->fetch(PDO::FETCH_ASSOC);
    }

}