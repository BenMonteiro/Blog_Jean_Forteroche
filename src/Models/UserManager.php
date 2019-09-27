<?php

require_once ROOT_PATH.'/src/Models/Manager.php';

class UserManager extends Manager
{
    const TABLE_NAME = 'user';

    /**
     * Find all the informations of a user where login and password are equal to the given infos
     * @param string $login     [login to find]
     * @param string $password      [password to find]
     */
    public static function findOne(string $login, string $password): array
    {
        $req = static::$bdd->prepare(
            'SELECT *
            FROM user
            WHERE login = ? AND password = ?'
        );
        $req->execute(array($login, $password));

        return $req->fetch();
    }
}
