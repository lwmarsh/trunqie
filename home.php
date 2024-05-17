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
                <button type="submit" name="submit" class="form-button" style="margin-top: 15px;">trunq</button>
                </div>
            </form>
        </div>
    </div>
</body>

