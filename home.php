<?php 
session_start();
include('./login_tools.php');

if (!isset($_SESSION['UserID'])) { // Checks if a user is logged in...
    load(); // ...if they're not logged in, they're redirected to the Log In page
    exit(); 
}

include('./includes/connect_db.php');

include('./includes/header.php');
?>