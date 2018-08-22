<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    $commentsNumber = $commentManager->getCommentsNumber($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment, $comment_type)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment, $comment_type);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function askReport()
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    
    $comment = $commentManager->getComment($_GET['commentId']);

    require('view/frontend/reportingView.php');
}

function report()
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    echo $isMistake = (isset($_POST['mistake'])) ? 1 : 0;
    echo $isInnapropriate = (isset($_POST['innapropriate'])) ? 1 : 0;
    echo $isConflict = (isset($_POST['conflict'])) ? 1 : 0;
    
    $affectedLines = $commentManager->reportComment($_GET['commentId'], $isMistake, $isInnapropriate, $isConflict);

    if ($affectedLines === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=1');
    }

    require('view/frontend/reportingView.php');
}