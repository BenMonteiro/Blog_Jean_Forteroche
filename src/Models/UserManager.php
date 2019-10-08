<?php

require_once ROOT_PATH.'/src/Models/Manager.php';

class UserManager extends Manager
{
    const TABLE_NAME = 'user';

    /**
     * Find all the informations of a user where login and password are equal to the given infos
     * @param $login     [login to find]
     * @param $password      [password to find]
     */
    public static function findOne($login, $password)
    {
        $req = static::getPDO()->prepare(
            'SELECT *
            FROM user
            WHERE login = ? AND password = ?'
        );
        $req->execute(array($login, $password));

        return $req->fetch();
    }
}
