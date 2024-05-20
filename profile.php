<?php 
session_start();
include('./login_tools.php');

if (!isset($_SESSION['UserID'])) { // Checks if a user is logged in...
    $loginTools->load(); // ...if they're not logged in, they're redirected to the Log In page
    exit(); 
}

require_once('./includes/DatabaseConnector.php');

include('./includes/header.php');

?>

<body style="margin-top: 100px;">
    <div class="container">
        <div class="content-loggedin" style="color: #12214E;">

<?php

$userID = $_SESSION['UserID'];
$q = "SELECT Trunqs.TrunqContent, Trunqs.timestamp AS trunq_timestamp, Users.Username 
        FROM Trunqs 
        INNER JOIN Users ON Trunqs.UserID = Users.UserID 
        WHERE Trunqs.UserID = ?
        ORDER BY Trunqs.timestamp DESC";
$pq = $dbc->prepare($q);
$pq->bind_param("i", $userID); 
$pq->execute();
$result = $pq->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<div class='trunq'>";
    echo "<p>{$row['TrunqContent']}</p>";
    echo "<p>Posted by: {$row['Username']} on {$row['trunq_timestamp']}</p>";
    echo "</div>";
}

$pq->close();
$dbc->close();
?>

        </div>
    </div>
</body>

