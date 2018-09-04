<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>page de connexion</title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <form action = "admin.php?action=login" method = "post" id="enterLogin">
            <div>
                <label for="email">addresse e-mail :</label><br />
                <input type="text" name="email" required/>
            </div>
            <div>
                <label for="password">mot de passe :</label><br />
                <input type="password" name="password" required/>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>
    </body>
</html>