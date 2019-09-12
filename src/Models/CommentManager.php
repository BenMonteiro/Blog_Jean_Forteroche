<?php

require_once ROOT_PATH.'/src/Models/Manager.php';

class CommentManager extends Manager
{

    const TABLE_NAME = 'comment';
/**
 * rewriting of the findAll function of the Manager class in order to fit with the table
 */
    public function findAll()
    {
        $req = $this->bdd->prepare('SELECT * FROM comment WHERE article_id = :id');
        $req->execute(array(
            'id' => $this->request->getParams('id')
        ));
    }

    /**
     * Add a comment to the database
     */
    public function add()
    {
        $req = $this->bdd->prepare('INSERT INTO comment(article_id, author, comment, creation_date) Values(:article_id, :author, :content, :creation_date)');
        $req->execute(array(
            'article_id' => $this->request->getParams('article_id'),
            'author' => $this->request->getParams('author'),
            'comment' => $this->request->getParams('comment'),
            'creation_date' => $this->request->getParams('article_id')
        ));
    }
}