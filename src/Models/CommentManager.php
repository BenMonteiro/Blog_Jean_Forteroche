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
        $req = static::$bdd->prepare('SELECT * FROM comment WHERE article_id = ? AND (reported = false OR moderate = true)  ORDER BY creation_date DESC LIMIT 0,50');
        $req->execute(array($id));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function toModerate()
    {
        $req = static::$bdd->query('SELECT * FROM comment WHERE moderate = false ORDER BY reported DESC');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function findReported()
    {
        $req = static::$bdd->query('SELECT * FROM comment WHERE reported = true AND moderate = false');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add a comment to the database
     */
    public static function add($article_id, array $comment = ['name', 'message'])
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

    public static function report($id)
    {
        $req = static::$bdd->prepare(
            'UPDATE comment SET reported = true WHERE id = ?'
        );

        return $req->execute(array($id));
    }

    public static function validate($id)
    {
        $req = static::$bdd->prepare('UPDATE comment SET moderate = true WHERE id = ?');

        return $req->execute(array($id));
    }
}