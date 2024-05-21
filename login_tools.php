<?php 

require_once('./includes/database_connector.php');

class LoginTools {
    private $dbc;

    public function __construct($dbc) {
        $this->dbc = $dbc;
    }

    public function validate($email='', $pwd='') {
        $errors = array();

        if (empty($email)) {
            $errors[] = "Enter your email address.";
        } else {
            $e = $this->dbc->real_escape_string(trim($email));
        }

        if (empty($pwd)) {
            $errors[] = "Enter your password.";
        } else {
            $p = $this->dbc->real_escape_string(trim($pwd));
        }

        if (empty($errors)) {
            $q = "SELECT UserID, Username
                  FROM Users
                  WHERE Email='$e' AND Password=SHA1('$p')";
            $r = $this->dbc->query($q);

            if ($r->num_rows == 1) {
                $row = $r->fetch_array(MYSQLI_ASSOC);
                return array(true, $row);
            } else {
                $errors[] = "Email address or password is incorrect.";
                return array(false, $errors);
            }

        }
    }
}

$loginTools = new LoginTools($dbc);

?>