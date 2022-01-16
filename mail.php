<?php
require'lib/email.php';
//we prepare the variables
$errors = [];
$contact = [
    'name' => '',
    'email' => '',
    'message' => ''
];
/**we try to run the program which will process the contact form before 
 * calling the sendMailContact () function which will process 
 * the email shapingbefore sending it to an email address
 */
try {
    if (array_key_exists('email', $_POST)) {
        $contact = [
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'message' => trim($_POST['message'])
        ];
        //if all the input fields are filled in, we continue to run the program otherwise we display an error message
        if ($contact['name'] == '' || $contact['email'] == '' || $contact['message'] == '') {

            $errors[] = 'Please complete all fields !';
        } else {
        	//we check that an email address has been entered if this is the case we call the sendMailContact () function
            if (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) 
                $errors[] = 'Please enter a valid email !';
             else {
                $envoiMail = sendMailContact($contact['name'],$contact['email'],$contact['message']);
            }
        }
    }
    include('index.php');
} catch (PDOException $e) {
	// In the event of an error, a message is displayed and everything is stopped
    $errors[] = 'A connection error has occurred :' . $e->getMessage();
    include('views/error.phtml');
    exit();
}
