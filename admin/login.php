<?php
//start 'session_start ()' if you need
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//call files
require_once('../config/config.php');
require_once('../lib/bdd.php');
//variable preparation
$errors = [];

$user = [
    'email' => '',
    'password' => ''
];
//we try to launch the program
try {
    if (array_key_exists('email', $_POST)) {
        $user = [
            'email'    => trim($_POST['email']),
            'password' => $_POST['password']
        ];
        //we check that it is indeed an email
        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email !';
        } else {
            //we check that the password field is completed
            if ($user['password'] == '') {
                $errors[] = 'Please fill in the "password" field !';
            }
            /**
             * if everything is completed correctly 
             * we launch the request in the database and we check the validity of the data
             */
            else if (count($errors) == 0) {
                // base ->
                $dbh = dbConnexion();
                $sth = $dbh->prepare('SELECT * FROM user WHERE use_email = :email');
                $sth->bindValue('email', $user['email'], PDO::PARAM_STR);
                $sth->execute();
                $userDb = $sth->fetch(PDO::FETCH_ASSOC);

                if ($userDb != false && password_verify($user['password'], $userDb['use_password'])) {
                    $_SESSION['connected'] = true;
                    // $_SESSION['user'] = [
                    //     'id' => $userDb['use_id'],
                    //     'email'=> $userDb['use_email']
                    //     ];
                    header('Location: index.php');
                    exit();
                }/**if the data entered is incorrect, 
                *it is informed that the data entered is incorrect
                */
                if (!password_verify($user['password'], $userDb['use_password']) || !$user['email']){
            $errors[] = 'Please verify your login details !';
        }
            } 
        }
        
      //we include the connection file
    }include('views/login.phtml');
} catch (PDOException $e) {
    /**
     * we load this file with its error message if an error occurs
     */
    $errors[] = 'A connection error has occurred :' . $e->getMessage();
    include('views/error.phtml');
    exit();
}
