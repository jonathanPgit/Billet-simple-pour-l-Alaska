<?php $title = "Menu d'administration"; ?>

<?php ob_start(); ?>
<h1>Choississez une option:</h1>

<ul id="adminMenu">
    <li><a href="admin.php?action=listPosts"><button class="adminMenu" >visiter le site</br><span class="glyphicon glyphicon-home"></span></button></a></li>
    <li><a href="admin.php?action=writePost"><button class="adminMenu" >écrire un nouveau billet</br><span class="glyphicon glyphicon-pencil"></span></button></a></li>
    <li><a href="admin.php?action=moderateComments"><button class="adminMenu" >modérer les commentaires</br><span class="glyphicon glyphicon-alert"></span></button></a></li>
    <li><a href="admin.php?action=updateEmail"><button class="adminMenu" >changer l'e-mail</br><span class="glyphicon glyphicon-envelope"></span></button></a></li>
</ul>

<a href="admin.php?action=logout"><button id="logout" >Cliquez pour déconnecter de l'admin<span class="glyphicon glyphicon-remove"></span></button></a>


<?php $content = ob_get_clean(); ?>

<?php require('adminMenuTemplate.php'); ?>