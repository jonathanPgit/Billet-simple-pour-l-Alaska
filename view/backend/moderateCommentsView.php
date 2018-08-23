<?php $title = "Modération commentaires"; ?>

<?php ob_start(); ?>
<h1>Commentaires signalés:</h1>

<?php
while($comment = $reportedComments->fetch())
{
    $post = $postManager->getPost($comment['post_id']);
?>
    <div class="reportedComments">
    <a href="admin.php?action=post&amp;id=<?= $post['id'] ?>"><?= $post['title']?></a>
        <div class="<?= $comment['comment_type']?>">
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></br></br></p>
        <?php if($comment['reported']){
?>
    <span class="label label-warning">ce message a été signalé <span class="badge"><?= $comment['reported'] ?></span> fois pour les motifs suivants: </span>
<?php
        echo "<ul>";
        if($comment['mistake']) {echo "<li>erreur</li>";}
        if($comment['innapropriate']) {echo "<li>contenu innaproprié</li>";}
        if($comment['conflict']) {echo "<li>invectives</li>";}
        echo "</ul>";
        }

        
?>
        <p class="col-lg-offset-11">(<a href="admin.php?action=commentDeletion&amp;commentId=<?= $comment['id'] ?>&amp;postId=<?= $comment['post_id']?>">supprimer</a>)</p>
        </div>
        
    </div>


<?php } $content = ob_get_clean(); ?>

<?php require('adminMenuTemplate.php'); ?>