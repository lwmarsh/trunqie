<?php 
// This file is specified in the 'action' attribute on the login form on login.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Checks to see if the login form has been submitted
    require ('includes/connect_db.php'); // If the above is true, connects to the database
    require ('login_tools.php'); // Loads the functions to login and validate the form

    list($check, $data) = validate($dbc, $_POST['email'], $_POST['pass']); 
    
    // Passes the database connection, email and password values from the form 

    // List accepts the returned bool ($check) and array ($data) from validate() 

    if ($check) {
        session_start();
        $_SESSION['UserID'] = $data['UserID'];
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