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
$trunqs = $trunqManager->getTrunqs();
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

