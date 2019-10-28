<?php
require_once ROOT_PATH.'/core/Manager.php';

/**
 * Make the database requests relative to the articles
 */
class ArticleManager extends Manager
{
    protected static $tableName = 'article';

    /**
     * Find the three last updated articles
     */
    public static function findLastUpdates()
    {
        $req = static::getPDO()->query(
            'SELECT article.*, user.name 
            FROM article
            INNER JOIN user
            ON user.id = article.user_id
            WHERE date_of_update IS NOT NULL 
            ORDER BY date_of_update DESC 
            LIMIT 0, 3'
        );

        return $req->fetchAll();
    }

    /**
     * Find all articles
     */
    public static function findAll()
    {
        $req = static::getPDO()->query(
            'SELECT article.*, user.name 
            FROM article
            INNER JOIN user
            ON user.id = article.user_id
            ORDER BY id DESC'
        );

        return $req->fetchAll();
    }

    /**
     * Count the number of articles
     */
    public static function count()
    {
        $req = static::getPDO()->query(
            'SELECT COUNT(id) AS nb_articles
            FROM article'
        );

        return $req->fetchColumn();
    }

    /**
     * Find an article by his chapter number
     * @param  $chapter_number      [the chapter number of the article we want]
     */
    public static function findOneByChapterNumber($chapterNumber)
    {
        $req = static::getPDO()->prepare(
            'SELECT article.*, user.name
            FROM article
            INNER JOIN user
            ON user.id = article.user_id
            WHERE chapter_number = ?'
        );
        $req->execute(array($chapterNumber));

        return $req->fetch();
    }

    /**
     * Add a new article to the database
     * @param  $newArticle     [an array of the params of the new article]
     */
    public static function add($newArticleData)
    {
        $req = static::getPDO()->prepare(
            'INSERT INTO article(chapter_number, title, image_url, alt_image, user_id, chapter_description, content, creation_date) 
            VALUES(?,?,?,?,?,?,?,NOW())'
        );

        return $req->execute(array(
            $newArticleData['chapter_number'],
            $newArticleData['title'],
            $newArticleData['imageURL'],
            $newArticleData['imageDescription'],
            $newArticleData['author'],
            $newArticleData['chapterDescription'],
            $newArticleData['chapterText'],
        ));
    }

    /**
     * Update an existing article of the database
     * @param $updateArticle      [an array of the params of the updated article]
     * @param $id    [the id of thearticle to update]
     */
    public static function update($updateData, $id)
    {
        $req = static::getPDO()->prepare(
            'UPDATE article 
            SET
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
            $updateData['chapter_number'],
            $updateData['title'],
            $updateData['imageURL'],
            $updateData['imageDescription'],
            $updateData['author'],
            $updateData['chapterDescription'],
            $updateData['chapterText'],
            $id
        ));
    }
}
