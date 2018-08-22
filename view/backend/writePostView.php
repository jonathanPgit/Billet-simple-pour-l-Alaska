<?php $title = "Rédaction de billet"; ?>

<?php ob_start(); ?>

<?php
if(isset($content)){
?>
<form action = "admin.php?action=publishUpdatedPost&amp;postId=<?= $postId ?>" method = "post">
<?php
}
else{
?>
<form action = "admin.php?action=publishPost" method = "post">
<?php
}
?>
    <div>
        <label for="title">titre :</label><br />
        <input type="text" name="title" value="<?php if(isset($postTitle)){echo $postTitle;} ?>"/>
    </div>
    <div>
        <textarea name="content"><?php if(isset($content)){echo $content;} ?></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>





<?php $content = ob_get_clean(); ?>

<?php require('adminMenutemplate.php'); ?>