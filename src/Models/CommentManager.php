<?php
require_once ROOT_PATH.'/core/Manager.php';
/**
 * Make the database requests relative to the comments
 */
class CommentManager extends Manager
{
    protected static $tableName = 'comment';
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

    public static function countToModerate()
    {
        $req = static::getPDO()->query(
            'SELECT COUNT(*) AS nb_toModerate
            FROM comment
            Where moderate = false'
        );

        $toModerate = $req->fetch();

        return $toModerate['nb_toModerate'];
    }

    /**
     * Count all the reported comments that are not moderated
     */
    public static function countReported()
    {
        $req = static::getPDO()->query(
            'SELECT COUNT(*) AS nb_reported
            FROM comment
            WHERE reported = true AND moderate = false'
        );

        $reported = $req->fetch();

        return $reported['nb_reported'];
    }

    /**
     * Add a comment to the database
     * @param $article_id       [the id of the comment article]
     * @param $comment        [an array of the params of the new comment]
     */
    public static function add($articleId, $comment)
    {
        $req = static::getPDO()->prepare(
            'INSERT INTO comment(article_id, author, comment, creation_date)
            VALUES(?, ?, ?, NOW())'
        );

        return $req->execute(array(
            $articleId,
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
