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
     * @param int $id       [the id of the article]
     * @return array
     */
    public static function findArticleComments(int $id): array
    {
        $req = static::$bdd->prepare(
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
     * @return array
     */
    public static function toModerate(): array
    {
        $req = static::$bdd->query(
            'SELECT *
            FROM comment
            WHERE moderate = false
            ORDER BY reported DESC'
        );

        return $req->fetchAll();
    }

    /**
     * Find all the reported comments that are not moderated
     * @return array
     */
    public static function findReported(): array
    {
        $req = static::$bdd->query(
            'SELECT *
            FROM comment
            WHERE reported = true AND moderate = false'
        );

        return $req->fetchAll();
    }

    /**
     * Add a comment to the database
     * @param int $article_id       [the id of the comment article]
     * @param array $comment        [an array of the params of the new comment]
     * @return array
     */
    public static function add(int $article_id, array $comment = ['name', 'message']): array
    {
        $req = static::$bdd->prepare(
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
     * @param int $id       [id of the comment]
     * @return array
     */
    public static function report(int $id): array
    {
        $req = static::$bdd->prepare(
            'UPDATE comment
            SET reported = true
            WHERE id = ?'
        );

        return $req->execute(array($id));
    }

    /**
     * Set the moderated field of the selected comment to true
     * @param int $id       [id of the comment]
     * @return array
     */
    public static function validate(int $id): array
    {
        $req = static::$bdd->prepare(
            'UPDATE comment
            SET moderate = true
            WHERE id = ?'
        );

        return $req->execute(array($id));
    }
}
