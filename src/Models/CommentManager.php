<?php
require_once ROOT_PATH.'/src/Models/Manager.php';

class CommentManager extends Manager
{
    const TABLE_NAME = 'comment';
/**
 * rewriting of the findAll function of the Manager class in order to fit with the table
 */
    public static function findArticleComments($id)
    {
        $req = static::$bdd->prepare('SELECT * FROM comment WHERE article_id = ? ORDER BY creation_date DESC LIMIT 0,20');
        $req->execute(array($id));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add a comment to the database
     */
    public static function add($article_id, $comment, $author)
    {
        $req = static::$bdd ->prepare(
            'INSERT INTO comment(article_id, author, comment, creation_date)
             Values(?, ?, ?, NOW())'
        );

        return $req->execute(array(
            $article_id,
            $author,
            $comment
        ));
    }
}