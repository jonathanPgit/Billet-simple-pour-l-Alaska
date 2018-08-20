<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, comment_type, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function getCommentsNumber($postId)
    {
        $db = $this->dbConnect();
        $number = $db->prepare('SELECT COUNT(*) FROM comments WHERE post_id = ?');
        $number->execute(array($postId));

        return $number->fetch();
    }

    public function postComment($postId, $author, $comment, $comment_type)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date, comment_type) VALUES(?, ?, ?, NOW(), ?)');
        $affectedLines = $comments->execute(array($postId, $author, $comment, $comment_type));

        return $affectedLines;
    }
}