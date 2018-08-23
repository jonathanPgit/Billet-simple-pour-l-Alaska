<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <div class="jumbotron">
            <div class="container">
                <h1>Billet simple pour l'Alaska</h1>
                <p>un roman de Jean Forteroche</p>
            </div>
        </div>
        <div class="container">
            <?= $content ?>
        </div>
        <footer> 
            <a href="admin.php">Page d'administration</a>
        </footer>
    </body>
</html>