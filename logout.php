<?php
session_start();

if (!isset($_SESSION['UserID'])) {
    require('./includes/utilities.php');
    Utilities::load(); // Redirects user to log in page if they are not already logged in
}

$_SESSION = array(); // Clears the existing session variables...
session_destroy(); // ...and deletes them from the server
?>

<link rel="stylesheet" href="./includes/styles.css">

<?php
echo '<div class="container" style="height: 100%;">
      <div class="content" style="color: #12214E;">
      <h1>Thanks for visiting Trunqie</h1>
      <h3>You are now logged out.</h3>
      <p>Please click <a href="./index.php">here</a> to head to the home page.</p>
      </div>
      </div>';
?>