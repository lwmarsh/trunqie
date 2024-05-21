<?php 
session_start();

if (!isset($_SESSION['UserID'])) { // Checks if a user is logged in...
    require_once('./includes/utilities.php');
    Utilities::load(); // ...if they're not logged in, they're redirected to the Log In page
    exit(); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('./includes/database_connector.php');
}

$trunqContent = $_POST['trunq_content']; // Takes input from the form on the homepage and stores it in the variable

if (empty($trunqContent)) {
    $_SESSION['error'] = 'Trunq content cannot be empty!';
    $loginTools->load('home.php');
    exit();
}

$trunqContent = htmlspecialchars($trunqContent); // Escapes special characters

$q = "INSERT INTO Trunqs (UserID, TrunqContent) VALUES (?, ?)"; // "?" acts as a placeholder for actual values

$pq = $dbc->prepare($q); // "(P)repared (Q)uery" -> Compiles the statement but does not execute it

$pq->bind_param("is", $_SESSION['UserID'], $trunqContent); // Binds the following parameters to the statement (where the placeholder values are). "is" indicates that the first parameter is an integer (i) and the second parameter is a string (s). The two arguments are the actual values that will be inserted.

$pq->execute(); 
$pq->close(); 

require_once('./includes/utilities.php');
Utilities::load('home.php');

?>