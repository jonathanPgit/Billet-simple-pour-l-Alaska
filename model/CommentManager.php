<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, comment_type, reported, mistake, conflict, innapropriate, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function getReportedComments()
    {
        $db = $this->dbConnect();
        $reportedComments = $db->query('SELECT id, author, comment, comment_type, reported, mistake, conflict, innapropriate, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE reported > 0 ORDER BY reported DESC');

        return $reportedComments;
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

    public function deleteComment($commentId)
    {
        $db = $this->dbConnect();
        $delete = $db->prepare('DELETE FROM comments WHERE id = ?');
        $affectedLines = $delete->execute(array($commentId));

        return $affectedLines;
    }

    public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT id, author, comment, comment_type, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $comment->execute(array($commentId));
        
        return $comment;
    }

    public function reportComment($commentId, $isMistake, $isInnapropriate, $isConflict)
    {
        $db = $this->dbConnect();
        $report = $db->prepare('UPDATE comments SET reported = reported + 1, mistake = mistake + ?, innapropriate = innapropriate + ? , conflict = conflict + ?  WHERE id = ?');
        $affectedLines = $report->execute(array($isMistake, $isInnapropriate, $isConflict, $commentId));
        
        return $affectedLines;
    }
}