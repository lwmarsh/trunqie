<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once ('login_tools.php');

    list($check, $data) = validate($dbc, $_POST['email'], $_POST['pass']); 
    
    // Passes the database connection, email and password values from the form 

    // List accepts the returned bool ($check) and array ($data) from validate() 

    if ($check) {
        session_start();
        $_SESSION['UserID'] = $data['UserID'];
        $_SESSION['Username'] = $data['Username'];
        load('home.php');

        // If validate->check returns true, a session is started and stores details about who has logged in, then loads home.php

        // $data is an associative array; column headings from the database are used as the index

    } else {
        $errors = $data;
        // If validate->check returns false, $errors is populated with errors from the valdiation attempt
    }

    $dbc->close(); // Closes database
    include('login.php'); // Includes login form

}
?>