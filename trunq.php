<?php 
session_start();

if (!isset($_SESSION['UserID'])) {
    require_once('./includes/utilities.php');
    Utilities::load();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('./includes/database_connector.php');
    require_once('./includes/user.php');

    $databaseConnector = new DatabaseConnector('localhost:3006', 'root', 'admin', 'trunqer');
    $databaseConnector->connect();

    $user = new User($databaseConnector);

    $userID = $_SESSION['UserID'];
    $trunqContent = $_POST['trunq_content'];

    $error = $user->trunq($userID, $trunqContent);

    if ($error) {
        $_SESSION['error'] = $error;
    }

    require_once('./includes/utilities.php');
    Utilities::load('home.php');
    exit();
}

?>