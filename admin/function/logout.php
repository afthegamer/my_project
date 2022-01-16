<?php
session_start();
//session_destroy();
// We pass the connected index to False
$_SESSION['connected'] = false;

// We remove the connected and user indexes from the session
unset($_SESSION['connected']);
//back to the login interface
header('Location: ../login.php');
exit();