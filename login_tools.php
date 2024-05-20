<?php 

require_once('./includes/DatabaseConnector.php');

function load($page = 'login.php') { // Creates a new funciton which takes one parameter, $page, and it's been given a default value ∴ if load() is called without any arguments, it will load login.php (the 'log in' page)
$url = 'http://' . $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); // Builds a string of protocol, current domain and directory
$url = rtrim($url, '\//'); // Removes all trailing slashes and concats the $page argument on the end
$url .= '/' . $page; // Redirects to the specified page and exits the script
header("Location: $url");
    exit();
}

function validate($dbc, $email='', $pwd='') { // Takes the database connection, email, and password as arguments and checks the credentials in the database -- default values for $email and $pwd are empty

$errors = array(); // Creates an array to store any error messages

if (empty($email)) { // Checks that the email field isn't empty
    $errors[] = 'Enter your email address.';
} else {
    $e = $dbc->real_escape_string(trim($email));
}

if (empty($pwd)) {
    $errors[] = 'Enter your password.';
} else {
    $p = $dbc->real_escape_string(trim($pwd));
}

if (empty($errors)) {
    $q = "SELECT UserID, Username
          FROM Users
          WHERE Email='$e' AND Password=SHA1('$p')";
    $r = $dbc->query($q); // Runs the SQL query and stores the result in $r

    if ($r->num_rows == 1) {
        $row = $r->fetch_array(MYSQLI_ASSOC); // fetch_array(MYSQLI_ASSOC) formats the results set as an associative array, one that uses column names as keys instead of numbers.
        // e.g. $row['user_id'] and $row['first_name'] instead of $row[0] and $row[1]        
        return array(true, $row); // If exactly 1 row is returned, return true to indicate a success, along with the row as an assoc array...
    } else {
        $errors[] = "Email address or password is incorrect."; // ...otherwise add a message to the errors array
        return array(false, $errors); // Returns false to indicate a failure, along with the error(s)

        // The return values from validate() are always a bool and an array regardless of whether or not the login attempt was successful
    }
}
}
?>