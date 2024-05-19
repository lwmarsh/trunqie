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

<body style="margin-top: 100px;">
    <div class="container">
        <div class="content-loggedin" style="color: #12214E;">
            <h1>Hey, <span style="font-family: Comfortaa;"><?php echo "{$_SESSION['Username']}"; ?></span>!</h1>
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
    echo "<p>Posted by: {$row['Username']} on {$row['trunq_timestamp']}</p>";
    echo "</div>";
}

// Close the database connection
$pq->close();
$dbc->close();
?>

        </div>
    </div>
</body>

