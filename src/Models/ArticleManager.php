<?php
header( 'content-type: text/html; charset=utf-8' );
require_once ROOT_PATH.'/src/Models/Manager.php';

class ArticleManager extends Manager
{
    const TABLE_NAME = 'article';

    /**
     * Add a new article to the database
     */
    public static function add($title, $content, $user_id, $creation_date)
    {
        return $req = static::$bdd->prepare(
            'INSERT INTO article(title, content, user_id, creation_date) 
            Values(:title, :content, :user_id, :creation_date)'
        );

        return $req->execute(array(
            'title' => $title,
            'content' => $content,
            'user_id' => $user_id,
            'creation_date' => $creation_date
        ));

    }

    /**
     * Update an existing article of the database
     */
    public static function update($newTitle, $newContent, $newUser_id, $newDate, $id)
    {
        return $req = static::$bdd ->prepare(
            'UPDATE article 
            SET title = :newTitle, 
            content = newContent, 
            user_id = newUser_id, 
            date_of_update = newDate
            WHERE id = :id'
        );

        return $req->execute(array(
            'newTitle' => $newTitle,
            'newContent' => $newContent,
            'newUser_id' => $newUser_id,
            'newDate' => $newDate,
            'id' => $id
        ));
    }
}