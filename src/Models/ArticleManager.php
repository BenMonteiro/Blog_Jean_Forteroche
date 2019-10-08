<?php
require_once ROOT_PATH.'/src/Models/Manager.php';

/**
 * Make the database requests relative to the articles
 */
class ArticleManager extends Manager
{
    const TABLE_NAME = 'article';

    /**
     * Find the three last updated articles
     */
    public static function findLastUpdates()
    {
        $req = static::getPDO()->query(
            'SELECT * 
            FROM article 
            WHERE date_of_update IS NOT NULL 
            ORDER BY date_of_update DESC 
            LIMIT 0, 3'
        );

        return $req->fetchAll();
    }

    /**
     * Find an article by his chapter number
     * @param  $chapter      [the chapter number of the article we want]
     */
    public static function findByChapterNumber($chapter)
    {
        $req = static::getPDO()->prepare(
            'SELECT * 
            FROM article 
            WHERE chapter_number = ?'
        );
        $req->execute(array($chapter));

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
    public static function update($updateArticleData, $id)
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
            $updateArticleData['chapter_number'],
            $updateArticleData['title'],
            $updateArticleData['imageURL'],
            $updateArticleData['imageDescription'],
            $updateArticleData['author'],
            $updateArticleData['chapterDescription'],
            $updateArticleData['chapterText'],
            $id
        ));
    }
}
