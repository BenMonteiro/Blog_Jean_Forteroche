<?php

class Article {

    public function __construct($article)
    {
        $chapter_number = $article['chapter_number'];
        $title = $article['title'];
        $imageURL = $article['imageURL'];
        $imageDescription = $article['imageDescription'];
        $author = $article['author'];
        $chapterDescription = $article['chapterDescription'];
        $chapterText = $article['chapterText'];
    }
}