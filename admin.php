<?php
require('controller/backend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            } 
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['comment'])) {
                    addComment($_GET['id'], "Jean Forteroche", $_POST['comment'], "admin");
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'commentDeletion') {
            if(isset($_GET['commentId']) && $_GET['commentId'] > 0){
                if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                    commentDeletion($_GET['commentId'], $_GET['postId'], $_GET['commentsPage']);
                }
                else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['action'] == 'moderateComments') {
            moderateComments();
        }
        elseif ($_GET['action'] == 'writePost') {
            writePost();
        }
        elseif ($_GET['action'] == 'publishPost') {
            if (!empty($_POST['title']) && !empty($_POST['content'])){
                publishPost($_POST['title'], $_POST['content']);
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }
        elseif ($_GET['action'] == 'postDeletion') {
            if(isset($_GET['postId']) && $_GET['postId'] > 0){
                postDeletion($_GET['postId']);
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'updatePost') {
            if(isset($_GET['postId']) && $_GET['postId'] > 0){
                if(isset($_GET['content'])){
                    updatePost($_GET['postId'], $_GET['title'], $_GET['content']);
                }
                else {
                    throw new Exception('Echec de récupération du texte à modifier');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'publishUpdatedPost') {
            if(isset($_GET['postId']) && $_GET['postId'] > 0){
                if(!empty($_POST['title']) && !empty($_POST['content'])){
                    publishUpdatedPost($_GET['postId'], $_POST['title'], $_POST['content']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    else {
        chooseAdminOption();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
