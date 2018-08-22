<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY id DESC');

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function publishPost($title, $content)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES( ?, ?, NOW())');
        $affectedLines = $comments->execute(array($title, $content));

        return $affectedLines;
    }

    public function publishUpdatedPost($postId, $title, $content)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE posts SET title = ?, content = ?, creation_date = NOW()  WHERE id = ?');
        $affectedLines = $comments->execute(array($title, $content, $postId));

        return $affectedLines;
    }

    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $delete = $db->prepare('DELETE FROM posts WHERE id = ?');
        $affectedLines = $delete->execute(array($postId));

        return $affectedLines;
    }
}