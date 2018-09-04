<?php $title = "Accueil Billet simple pour L'Alaska"; ?>

<?php ob_start(); ?>

<?php
function truncate($string, $max_length = 201, $replacement = '', $trunc_at_space = false)
{
	$max_length -= strlen($replacement);
	$string_length = strlen($string);
 
	if($string_length <= $max_length)
		return $string;
 
	if( $trunc_at_space && ($space_position = strrpos($string, ' ', $max_length-$string_length)) )
		$max_length = $space_position;
 
	return substr_replace($string, $replacement, $max_length);
}

while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        
        <?= nl2br(truncate($data['content'], 200, '...', true)) ?>
        <br />
        <div class="readLink">
            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire</a>
        </div>
        
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>