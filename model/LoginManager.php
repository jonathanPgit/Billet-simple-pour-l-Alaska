<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");

class LoginManager extends Manager
{
    public function getLogin()
    {
        $db = $this->dbConnect();
        $login = $db->query('SELECT pass, email FROM admin_login WHERE id = 1');
        

        
        return $login->fetch();
    }

    public function updateEmail($email)
    {
        $db = $this->dbConnect();
        $update = $db->prepare('UPDATE admin_login SET email = ? WHERE id = 1');
        $affectedLines = $update->execute(array($email));

        return $affectedLines;
    }

}