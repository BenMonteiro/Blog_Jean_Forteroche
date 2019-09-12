<?php

require_once ROOT_PATH.'/src/Models/Manager.php';

class ArticleManager extends Manager
{
    const TABLE_NAME = 'article';

    /**
     * Add a new article to the database
     */
    public function add()
    {
        $req = $this->bdd->prepare('INSERT INTO article(title, content, user_id, creation_date) Values(:title, :content, :user_id, :creation_date)');
        $req->execute(array(
            'title' => $this->request->getParams('title'),
            'content' => $this->request->getParams('content'),
            'user_id' => $this->request->getParams('user_id'),
            'creation_date' => $this->request->getParams('creation_Date'),
        ));
    }

    /**
     * Update an existing article of the database
     */
    public function update()
    {
        $req = $this->bdd->prepare('UPDATE article SET title = :newTitle, content = newContent, user_id = newUser_id, date_of_update = newDate WHERE id = :id');
        $req->execute(array(
            'id' => $this->request->getParams('id'),
            'newTitle' => $this->request->getParams('newTitle'),
            'newContent' => $this->request->getParams('newContent'),
            'newUser_id' => $this->request->getParams('newUser_id'),
            'newDate' => $this->request->getParams('newDate')
        ));
    }
}