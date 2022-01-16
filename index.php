<?php
/**loading libraries */
require('config/config.php');
require('article/article.php');
/**
 * we try to call the parameters,
 * otherwise we load the error page
 */
try
{
	$dbh = new PDO(DB_DSN,DB_USER,DB_PASS);
	include('view/index.phtml');
}
catch(Exception $e)
{	// In the event of an error, a message is displayed and everything is stopped
	$errors[] = 'Une erreur de connexion a eu lieu :'.$e->getMessage();
    include('views/error.phtml');
    exit();
}
