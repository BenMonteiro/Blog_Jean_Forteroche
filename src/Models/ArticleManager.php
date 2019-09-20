<?php
require_once ROOT_PATH.'/src/Models/Manager.php';

class ArticleManager extends Manager
{
    const TABLE_NAME = 'article';

    /**
     * Add a new article to the database
     */
    public static function add($imageURL, $imageDescription, $title, $content, $chapterDescription, $user_id)
    {
        $req = static::$bdd->prepare(
            'INSERT INTO article( image_url, alt_image, title, content, chapter_description, user_id, creation_date) 
            Values(?,?,?,?,?,?,NOW())'
        );

        return $req->execute(array(
            $imageURL, 
            $imageDescription, 
            $title, 
            $content, 
            $chapterDescription, 
            $user_id
        ));
    }

    /**
     * Update an existing article of the database
     */
    public static function update($newTitle, $newContent, $newUser_id, $newDate, $id)
    {
        $req = static::$bdd ->prepare(
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