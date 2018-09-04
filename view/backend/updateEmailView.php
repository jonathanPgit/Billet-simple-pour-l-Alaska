<?php $title = "Changement d'adresse e-mail"; ?>

<?php ob_start(); ?>

<form action="admin.php?action=saveUpdatedEmail" method="post" id="updateEmail">
    <div>
        <label for="email">nouvelle adresse e-mail :</label><br />
        <input type="text" name="email" required/><p>exemple: JeanDupont@gmail.com</p>
    </div>
    <div>
        <label for="email">retaper la nouvelle adresse e-mail :</label><br />
        <input type="text" name="email_bis" required/>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('adminMenuTemplate.php'); ?>