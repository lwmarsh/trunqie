<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trunqie | Register</title>
    <link rel="stylesheet" href="./includes/styles.css">
</head>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('./includes/connect_db.php'); // Connects to the SQL database
    $errors = array(); // Declares error catching array
}

if (empty($_POST['username'])) {
    $errors[] = 'You did not enter a username.'; // Displays error if field is empty
} else {
    $un = $dbc->real_escape_string(trim($_POST['username'])); // Adds input from 'username' field into $un variable ready to be added to database
}

if (empty($_POST['email'])) {
    $errors[] = 'You did not enter an email address.';
} else {
    $e = $dbc->real_escape_string(trim($_POST['email']));
}

if (!empty($_POST['pass1'])) {
    if ($_POST['pass1'] != $_POST['pass2']) // checks that both password fields match if the first password field isn't empty 
    {
        $errors[] = "The above passwords do not match."; // displays error if password fields don't match
    } else {
        $p = $dbc->real_escape_string(trim($_POST['pass1']));
    }
} else {
    $errors[] = 'You did not enter a password.';
}

if (empty($errors)) { // If there are no errors added to the array...
    $q = "SELECT UserID FROM Users WHERE Email='$e'"; // ...stores the following SQL query in $q
    $r = $dbc->query($q); // Query is run on the database to check an email address hasn't already been used & result is stored in $r
    $rowcount = $r->num_rows; // Checks number of rows on the result of the query
    if ($rowcount != 0) { // Checks if email address has already been used
        $errors[] = 'The above email address is already registered. Please <a href="./login.php">log in</a>.'; // Prints error that email has already been used & promps user to log in
    }
}

if (empty($errors)) { // Repeat of the above code that checks for a previously used username
    $q = "SELECT UserID FROM Users WHERE Username='$un'";
    $r = $dbc->query($q);
    $rowcount = $r->num_rows;
    if ($rowcount != 0) {
        $errors[] = 'The above username is already registered. Please <a href="./login.php">log in</a>.';
    }
}

if (empty($errors)) {
    $q = "INSERT INTO Users (Username, Email, Password, RegisteredAt)
			  VALUES ('$un', '$e', SHA1('$p'), NOW())"; // Inserts variables into database table under the following attributes with the corresponding values. SHA1() hashes the password, NOW() returns the date and time in the format YYYY-MM-DD HH:MM:SS
    $r = $dbc->query($q); // Runs the above query
    if ($r) {
        echo '<div class="container">
                <div class="content" style="color: #12214E;">
                    <h1>You have successfully registered.</h1>
                    <p>Please <a href="./login.php">log in</a>.</p>
                </div>
              </div>'; // Prompts the user to log in if everything is successful 
    }
    $dbc->close();
    exit();
}
?>

<body style="margin-top: 100px;">
    <div class="container">
        <div class="content">
            <form action="./register.php" method="post" class="form" role="form">
                <h1>Create an Account</h1>
                <div class="form-group">
                    <input type="text" name="username" size="20" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" class="form-input" placeholder="Username">
                </div>

                <div class="form-group">
                    <input type="text" name="email" size="20" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" class="form-input" placeholder="Email Address">
                </div>

                <div class="form-group">
                    <input type="password" name="pass1" size="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" class="form-input" placeholder="Password">
                </div>

                <div class="form-group">
                    <input type="password" name="pass2" size="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" class="form-input" placeholder="Confirm password">
                </div>

                <button type="submit" class="form-button" style="margin-top: 15px; margin-bottom: 15px;">REGISTER</button>
            </form>
            <p>If you already have an account, please <a href="./login.php">log in</a>.</p>
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($errors)) {
                echo '<p><strong>The following error(s) occurred:</strong><br>';
                foreach ($errors as $msg) { // Runs through each error message stored in the array (if there are any)
                    echo "-$msg<br>"; // Prints each error as a message
                }
            }
            ?>
        </div>
    </div>
</body>

</html>