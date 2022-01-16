<?php
//we call the required parameters
require('../config/config.php');
require('../lib/bdd.php');
require('function/auth.php');
//we call the connection status check function
verif_log ();

/**
 * we try to call the parameters,
 * otherwise we load the error page
 */
try
{
    require_once('../article/article.php');
	$dbh = new PDO(DB_DSN,DB_USER,DB_PASS);
	include('views/index.phtml');
}
catch(Exception $e)
{
	$errors[] = 'Une erreur de connexion a eu lieu :'.$e->getMessage();
    include('views/error.phtml');
    exit();
}