<?php
DEFINE('DB_USER', 'root'); // Database username
DEFINE('DB_PASSWORD', 'admin'); // Database password
DEFINE('DB_HOST', 'localhost:3006'); // Database server location
DEFINE('DB_NAME', 'trunqer'); // Name of database within the above server

// Creates connection to database
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Checks connection to database
if ($dbc->connect_error) {
    die("Connection failed: " . $dbc->connect_error);
}

$dbc->set_charset("utf8");
?>