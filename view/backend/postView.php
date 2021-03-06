<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<p><a href="admin.php?action=listPosts"><- Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
    
    <?= nl2br($post['content']) ?>
</div>

<div id="crudPost">
    <a href="admin.php?action=postDeletion&amp;postId=<?= $post['id'] ?>">
        <button type="button" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-trash">
            </span>
        </button>
    </a>
    <a href="admin.php?action=updatePost&amp;postId=<?= $post['id'] ?>&amp;title=<?= $post['title'] ?>&amp;content=<?= htmlspecialchars($post['content']) ?>">
        <button type="button" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-pencil">
            </span>
        </button>
    </a>
</div>

<h2>Commentaires</h2>

<form class="postComment" action="admin.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="comment">Écrire un message :</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <em>par Jean Forteroche</em>
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
    $commentsPage = $_GET['commentsPage']; 
}
else{
    $commentsPage = 1;
}

$i = 0;

while($comment = $comments->fetch())
{
?>
    <div class="<?= $comment['comment_type']?>">
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></br></br></p>
        <?php if($comment['reported']){
?>  
        <p>
            <mark id="reportIndications">ce message a été signalé <span class="badge"><?= $comment['reported'] ?></span> fois pour les motifs suivants: 
<?php
        echo "<ul>";
        if($comment['mistake']) {echo "<li>erreur</li>";}
        if($comment['innapropriate']) {echo "<li>contenu innaproprié</li>";}
        if($comment['conflict']) {echo "<li>invectives</li>";}
        echo "</ul>";
        }
?>
            </mark>
        </p>
        
        <p class="col-lg-offset-11">(<a href="admin.php?action=commentDeletion&amp;commentId=<?= $comment['id'] ?>&amp;postId=<?= $post['id']?>&amp;commentsPage=<?= $commentsPage ?>">effacer</a>)</p>
    </div>
<?php
    if($i > 2){
        $comments->closeCursor();
    }
    $i++;
}

?>



<ul class="pagination">
<?php
$commentsPageNumber = $commentsNumber[0] / 4;
if(is_float($commentsPageNumber)) {
    $commentsPageNumber++;
}

if($commentsPageNumber >= 2){
    for ($i = 1; $i <= $commentsPageNumber; $i++)
    {
    ?>
        <li class="pages"><a href="admin.php?action=post&amp;id=<?= $post['id'] ?>&amp;commentsPage=<?= $i ?>"><?php echo $i; ?></a></li>
    <?php
    }
}
?>

</ul>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>