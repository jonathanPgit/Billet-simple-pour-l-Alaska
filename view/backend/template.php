<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <div id="connectedStatusBanner"><p>connecté en temps qu'administrateur</p><a href="admin.php?action=chooseAdminOption">MENU-></a></div>
        <?= $content ?>
    </body>
</html>