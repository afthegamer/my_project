<?php
//function that sets the session to 'true' by default
function use_connecte(): bool
{
    //start 'session_start ()' if you need
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connected']);
}
/**
 * function which checks if the user is correctly connected 
 * otherwise it is returned to the connection interface
 */
function verif_log(): void
{
    if (!use_connecte()) {
        include('login.php');
        exit();
    }
}
