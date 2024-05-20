<?php 

require_once('./login_tools.php');

function handleFormSubmission($loginTools, $email, $password) {
    list($check, $data) = $loginTools->validate($email, $password);

    if ($check) {
        session_start();
        $_SESSION['UserID'] = $data['UserID'];
        $_SESSION['Username'] = $data['Username'];
        
        $loginTools->load('home.php');     
    } else { 
        $errors = $data;
        include('login.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['pass'] ?? '';

    handleFormSubmission($loginTools, $email, $password);

    $dbc->close();
} else {
    include('login.php');
}

?>