<?php $title = "Menu d'administration"; ?>

<?php ob_start(); ?>
<h1>Choississez une option:</h1>

<ul>
    <li><a href="admin.php?action=listPosts">visiter le site</a></li>
    <li><a href="admin.php?action=writePost">écrire un nouveau billet</a></li>
    <li><a href="admin.php?action=moderateComments">modérer les commentaires</a></li>
    <li><a href="admin.php?action=updateEmail">changer l'e-mail de sécurité</a></li>
</ul>


<?php $content = ob_get_clean(); ?>

<?php require('adminMenuTemplate.php'); ?>