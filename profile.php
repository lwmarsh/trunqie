<?php 
session_start();

if (!isset($_SESSION['UserID'])) { // Checks if a user is logged in...
    require_once('./includes/utilities.php');
    Utilities::load(); // ...if they're not logged in, they're redirected to the Log In page
    exit(); 
}

require_once('./includes/database_connector.php');
require_once('./includes/trunq_manager.php');
include('./includes/header.php');

$trunqManager = new TrunqManager($databaseConnector);
$userID = $_SESSION['UserID'];
$trunqs = $trunqManager->getTrunqs($userID);
?>

<body style="margin-top: 100px;">
    <div class="container">
        <div class="content-loggedin" style="color: #12214E;">

<?php
    foreach ($trunqs as $trunq) {
        echo "<div class='trunq'>";
        echo "<p>{$trunq['TrunqContent']}</p>";
        echo "<p>Posted by: <strong>{$trunq['Username']}</strong> on <em>{$trunq['trunq_timestamp']}</em></p>";
        echo "</div>";
        }

?>

        </div>
    </div>
</body>

