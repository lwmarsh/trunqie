<?php 
session_start();

if (!isset($_SESSION['UserID'])) { // Checks if a user is logged in...
    require_once('./includes/utilities.php');
    Utilities::load(); // ...if they're not logged in, they're redirected to the Log In page
    exit(); 
}

require_once('./includes/database_connector.php');
include('./includes/header.php');
?>

<body style="margin-top: 100px;">
    <div class="container">
        <div class="content-loggedin" style="color: #12214E;">
            <h1>Hey, <span style="font-family: Comfortaa;"><?php echo "{$_SESSION['Username']}"; ?></span>!</h1>
            
            <?php
            if (isset($_SESSION['error'])) {
                echo "<p style='color: red;'>{$_SESSION['error']}</p>";
                unset($_SESSION['error']); // Clear the error message after displaying it
            }
            ?>

            <form action="trunq.php" method="post" class="form" role="form">
                <div class="form-group">
                <textarea name="trunq_content" rows="4" cols="50" maxlength="280" placeholder="What's on your mind?"></textarea><br>
                <button type="submit" name="submit" class="form-button" style="margin-top: 15px;">trunq 🐘</button>
                </div>
            </form>
            
<?php

// Retrieves trunqs from the database along with the username and timestamp
$userID = $_SESSION['UserID'];
$q = "SELECT Trunqs.TrunqContent, Trunqs.timestamp AS trunq_timestamp, Users.Username 
        FROM Trunqs 
        INNER JOIN Users ON Trunqs.UserID = Users.UserID 
        ORDER BY Trunqs.timestamp DESC";
$pq = $dbc->prepare($q);
$pq->execute();
$result = $pq->get_result();


// Displays trunqs and outputs: content, username, timestamp.
while ($row = $result->fetch_assoc()) {
    // Output trunq content, timestamp, etc.
    echo "<div class='trunq'>";
    echo "<p>{$row['TrunqContent']}</p>";
    echo "<p>Posted by: <strong>{$row['Username']}</strong> on <em>{$row['trunq_timestamp']}</em></p>";
    echo "</div>";
}

// Close the database connection
$pq->close();
$dbc->close();
?>

        </div>
    </div>
</body>

