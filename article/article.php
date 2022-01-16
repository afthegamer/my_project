<?php
//we call the database
$dbh = new PDO(DB_DSN,DB_USER,DB_PASS);


// We recover all the content
    $reponse1 = $dbh->query("SELECT * FROM edit WHERE article_select = 'INTRO' ");
    $donnees1 = $reponse1->fetch();

    $reponse2 = $dbh->query("SELECT * FROM edit  WHERE article_select = 'WORK' ");
    $donnees2 = $reponse2->fetch();

    $reponse3 = $dbh->query("SELECT * FROM edit WHERE article_select = 'ABOUT' ");
    $donnees3 = $reponse3->fetch();


?>