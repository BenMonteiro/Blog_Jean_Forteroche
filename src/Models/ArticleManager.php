<?php
require_once ROOT_PATH.'/src/Models/Manager.php';

class ArticleManager extends Manager
{
    const TABLE_NAME = 'article';

    public static function findLastUpdates()
    {
        $req = static::$bdd->query('SELECT * FROM article WHERE date_of_update IS NOT NULL ORDER BY date_of_update DESC LIMIT 0, 3');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
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
    public static function update($imageURL, $imageDescription, $title, $content, $chapterDescription, $user_id, $id)
    {
        $req = static::$bdd->prepare(
            'UPDATE article SET 
                image_url = ?,
                alt_image = ?,
                title = ?,
                content = ?,
                chapter_description = ?,
                user_id = ?,
                date_of_update = NOW()
            WHERE id = ?'
        );

        return $req->execute(array(
            $imageURL,
            $imageDescription,
            $title,
            $content,
            $chapterDescription,
            $user_id,
            $id
        ));
    }
}