<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script>
            tinymce.init({selector:'textarea'});
        </script>  
    </head>
        
    <body>
        <div class="container">
        <a href="admin.php?action=logout"><button id="logout" >Cliquez pour déconnecter de l'admin<span class="glyphicon glyphicon-remove"></span></button></a>
            <?= $content ?>
        </div>
    </body>
</html>