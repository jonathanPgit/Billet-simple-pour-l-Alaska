<?php $title = "Rédaction de billet"; ?>

<?php ob_start(); ?>

<form action="admin.php?action=saveUpdatedEmail" method="post">
    <div>
        <label for="email">nouvelle addresse e-mail :</label><br />
        <input type="text" name="email" required/><p>exemple: JeanDupont@gmail.com</p>
    </div>
    <div>
        <label for="email">retaper la nouvelle addresse e-mail :</label><br />
        <input type="text" name="email_bis" />
    </div>
    <div>
        <input type="submit" />
    </div>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('adminMenutemplate.php'); ?>