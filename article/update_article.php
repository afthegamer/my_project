<?php
require('../config/config.php');
/**
 * if the user is logged in when posting the article 
 * update the program continues otherwise it is redirected to the login page
 */
if($_POST){
 $_SESSION['connected'] = true;
        if (isset($_POST['intro']))
        {
            $dbh = new PDO(DB_DSN,DB_USER,DB_PASS);
            $req = $dbh->prepare('UPDATE edit SET article_edit = :update WHERE id = :id');
            $data = [
            'update' => htmlspecialchars( $_POST['intro'] ),
            'id' => 1,
            ];
        	header("Location: ../admin/index.php");
            $req->execute($data);
        }
        if (isset($_POST['work']))
        {
            $dbh = new PDO(DB_DSN,DB_USER,DB_PASS);
            $req = $dbh->prepare('UPDATE edit SET article_edit = :update WHERE id = :id');
            $data = [
            'update' => htmlspecialchars($_POST['work']),
            'id' => 2,
            ];
            $req->execute($data);
        }
        if (isset($_POST['about']))
        {
            $dbh = new PDO(DB_DSN,DB_USER,DB_PASS);
            $req = $dbh->prepare('UPDATE edit SET article_edit = :update WHERE id = :id');
            $data = [
            'update' => htmlspecialchars($_POST['about']),
            'id' => 3,
            ];
            $req->execute($data);
        }
}else{
    header('Location: ../admin/login.php');
}