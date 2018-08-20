<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>

<h2>Commentaires</h2>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur :</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire :</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php
if(isset($_GET['commentsPage'])){
    for ($i = 0; $i < (($_GET['commentsPage'] - 1) * 4); $i++){
        $comment = $comments->fetch();
    }

    $i = 0;

    while($comment = $comments->fetch())
    {
        if($i > 3){break;}
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php
    $i++;
    }
    $comments->closeCursor();
}
else{
    for($i = 1; $i < 5; $i++)
    {
        $comment = $comments->fetch()
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php
    }
    $comments->closeCursor();
}
?>

<ul>
<?php
$commentsPageNumber = $commentsNumber[0] / 4;
if(is_float($commentsPageNumber)) {
    $commentsPageNumber++;
}
for ($i = 1; $i <= $commentsPageNumber; $i++)
{
?>
    <li><a href="index.php?action=post&amp;id=<?= $post['id'] ?>&amp;commentsPage=<?= $i ?>"><?php echo $i; ?></a></li>
<?php
}
?>
</ul>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>