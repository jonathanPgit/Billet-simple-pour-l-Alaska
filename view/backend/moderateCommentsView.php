<?php $title = "Modération commentaires"; ?>

<?php ob_start(); ?>
<h1>Commentaires signalés:</h1>

<p><a href="admin.php">Retour au menu de modération</a></p>

<?php
while($comment = $reportedComments->fetch())
{
?>
        <div id="<?= $comment['comment_type']?>">
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></br></br>(<a href="admin.php?action=commentDeletion&amp;commentId=<?= $comment['id'] ?>&amp;postId=<?= $comment['post_id']?>">supprimer</a>)</p>
        <?php if($comment['reported']){
?>
    <p><mark id="reportIndications">ce message a été signalé <?= $comment['reported'] ?> fois pour les motifs suivants: 
<?php
        echo "<ul>";
        if($comment['mistake']) {echo "<li>erreur</li>";}
        if($comment['innapropriate']) {echo "<li>contenu innaproprié</li>";}
        if($comment['conflict']) {echo "<li>invectives</li>";}
        echo "</ul>";
        }

        $post = $postManager->getPost($comment['post_id'])
?>
        </mark>
        </p>
        </div>
        <a href="admin.php?action=post&amp;id=<?= $post['id'] ?>"><?= $post['title']?></a>


<?php } $content = ob_get_clean(); ?>

<?php require('adminMenuTemplate.php'); ?>