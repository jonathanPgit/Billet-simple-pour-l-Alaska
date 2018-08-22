<?php $title = "signalement"; ?>

<?php ob_start(); 



$comment = $comment->fetch();

?>
    <div id="<?= $comment['comment_type']?>">
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></br></br></p>
    </div>
    

<h2>Pour quel motif souhaitez vous signaler ce commentaire ?</h2>

<form action="index.php?action=report&amp;commentId=<?= $_GET['commentId'] ?>" method="post">
    <p>
       <input type="checkbox" name="mistake" /> <label>Message posté par erreur</label><br />
       <input type="checkbox" name="innapropriate" /> <label>Contenu inapproprié</label><br />
       <input type="checkbox" name="conflict" /> <label>Menaces, Insultes, Incitation à la haine ou Diffamation</label><br />
   </p>
   <input type="submit" value="Valider" />
</form>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>