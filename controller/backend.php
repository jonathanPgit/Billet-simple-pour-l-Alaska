<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LoginManager.php');

function login($password, $email){
    $loginManager = new \OpenClassrooms\Blog\Model\LoginManager();
    
    $login = $loginManager->getLogin();

    if((password_verify($password, $login['pass'])) AND ($login['email'] == $email)){
        session_start();
        $_SESSION['connected'] = 1;
        header('Location: admin.php?action=chooseAdminOption');
    }
    else{  
        
        throw new Exception('Mauvais email ou mot de passe !');
        
    }    

}

function logout(){
    session_start();

    $_SESSION = array();

    session_destroy();

    header('Location: index.php');

}

function saveUpdatedEmail(){
    $loginManager = new \OpenClassrooms\Blog\Model\LoginManager();

    $affectedLines = $loginManager->updateEmail($_POST['email']);

    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier l\'email !');
    }
    else {
        header('Location: admin.php?action=chooseAdminOption');
    }

}


function enterLogin(){
    require('view/backend/enterLoginView.php');
}

function updateEmail(){
    require('view/backend/updateEmailView.php');
}

function chooseAdminOption(){
    require('view/backend/adminMenuView.php');
}

function moderateComments()
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $postManager = new \OpenClassrooms\Blog\Model\PostManager();

    $reportedComments = $commentManager->getReportedComments();

    require('view/backend/moderateCommentsView.php');
}

function writePost()
{
    
    require('view/backend/writePostView.php');
}

function publishPost($title, $content){

    $postManager = new \OpenClassrooms\Blog\Model\PostManager();

    $affectedLines = $postManager->publishPost($title, $content);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le nouveau billet !');
    }
    else {
        header('Location: admin.php?action=listPosts');
    }
}

function updatePost($postId, $postTitle, $content){

    require('view/backend/writePostView.php');

}

function publishUpdatedPost($postId, $title, $content){

    $postManager = new \OpenClassrooms\Blog\Model\PostManager();

    $affectedLines = $postManager->publishUpdatedPost($postId, $title, $content);

    if ($affectedLines === false) {
        throw new Exception('Impossible de mettre à jour le billet !');
    }
    else {
        header('Location: admin.php?action=listPosts');
    }
}

function listPosts()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/backend/listPostsView.php');
}

function post()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    $commentsNumber = $commentManager->getCommentsNumber($_GET['id']);

    require('view/backend/postView.php');
}

function addComment($postId, $author, $comment, $comment_type)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment, $comment_type);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: admin.php?action=post&id=' . $postId);
    }
}

function commentDeletion($commentId, $postId, $commentsPage)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $affectedLines = $commentManager->deleteComment($commentId);

    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer le commentaire !');
    }
    else {
        header('Location: admin.php?action=post&id=' . $postId . '&commentsPage=' . $commentsPage);
    }
}

function postDeletion($postId)
{
    $postManager = new \OpenClassrooms\Blog\Model\postManager();

    $affectedLines = $postManager->deletePost($postId);

    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer le billet !');
    }
    else {
        header('Location: admin.php?action=listPosts');
    }
}