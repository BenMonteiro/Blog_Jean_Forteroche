<?php
require_once ROOT_PATH.'/src/Models/Manager.php';

/**
 * Make the database requests relative to the comments
 */
class CommentManager extends Manager
{
    const TABLE_NAME = 'comment';
    /**
     * Find the 50 last comments that belongs to the selected article
     * @param $id       [the id of the article]
     */
    public static function findArticleComments($id)
    {
        $req = static::getPDO()->prepare(
            'SELECT * 
            FROM comment 
            WHERE article_id = ? AND (reported = false OR moderate = true)
            ORDER BY creation_date DESC 
            LIMIT 0,50'
        );
        $req->execute(array($id));

        return $req->fetchAll();
    }

    /**
     * Find all the unmoderated comments
     */
    public static function toModerate()
    {
        $req = static::getPDO()->query(
            'SELECT *
            FROM comment
            WHERE moderate = false
            ORDER BY reported DESC'
        );

        return $req->fetchAll();
    }

    /**
     * Find all the reported comments that are not moderated
     */
    public static function findReported()
    {
        $req = static::getPDO()->query(
            'SELECT *
            FROM comment
            WHERE reported = true AND moderate = false'
        );

        return $req->fetchAll();
    }

    /**
     * Add a comment to the database
     * @param $article_id       [the id of the comment article]
     * @param $comment        [an array of the params of the new comment]
     */
    public static function add($article_id, $comment = ['name', 'message'])
    {
        $req = static::getPDO()->prepare(
            'INSERT INTO comment(article_id, author, comment, creation_date)
            VALUES(?, ?, ?, NOW())'
        );

        return $req->execute(array(
            $article_id,
            $comment['name'],
            $comment['message']
        ));
    }

    /**
     * Set the reported field of the selected comment to true
     * @param $id       [id of the comment]
     */
    public static function report($id)
    {
        $req = static::getPDO()->prepare(
            'UPDATE comment
            SET reported = true
            WHERE id = ?'
        );

        return $req->execute(array($id));
    }

    /**
     * Set the moderated field of the selected comment to true
     * @param $id       [id of the comment]
     */
    public static function validate($id)
    {
        $req = static::getPDO()->prepare(
            'UPDATE comment
            SET moderate = true
            WHERE id = ?'
        );

        return $req->execute(array($id));
    }
}
