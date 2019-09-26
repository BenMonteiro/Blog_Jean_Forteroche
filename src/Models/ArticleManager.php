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

    public static function findByChapterNumber(int $chapter)
    {
        $req = static::$bdd->prepare('SELECT * FROM `' . static::TABLE_NAME . '`WHERE chapter_number = ?');
        $req->execute(array($chapter));
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Add a new article to the database
     */
    public static function add(array $newArticle = ['chapter_number', 'title', 'imageURL', 'imageDescription', 'author', 'chapterDescription','chapterText'])
    {
        $req = static::$bdd->prepare(
            'INSERT INTO article(chapter_number, title, image_url, alt_image, user_id, chapter_description, content, creation_date) 
            VALUES(?,?,?,?,?,?,?,NOW())'
        );

        return $req->execute(array(
            $newArticle['chapter_number'],
            $newArticle['title'],
            $newArticle['imageURL'],
            $newArticle['imageDescription'],
            $newArticle['author'],
            $newArticle['chapterDescription'],
            $newArticle['chapterText'],
        ));
    }

    /**
     * Update an existing article of the database
     */
    public static function update(array $updateArticle = ['chapter_number', 'title', 'imageURL', 'imageDescription', 'author', 'chapterDescription','chapterText'], $id)
    {
        $req = static::$bdd->prepare(
            'UPDATE article SET
                chapter_number = ?,
                title = ?, 
                image_url = ?,
                alt_image = ?,
                user_id = ?,
                chapter_description = ?,
                content = ?,
                date_of_update = NOW()
            WHERE id = ?'
        );

        return $req->execute(array(
            $updateArticle['chapter_number'],
            $updateArticle['title'],
            $updateArticle['imageURL'],
            $updateArticle['imageDescription'],
            $updateArticle['author'],
            $updateArticle['chapterDescription'],
            $updateArticle['chapterText'],
            $id
        ));
    }
}