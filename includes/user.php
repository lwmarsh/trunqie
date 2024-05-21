<?php 

require_once('./includes/database_connector.php');

class User {
    private $dbc;

    public function __construct(DatabaseConnector $databaseConnector) {
        $this->dbc = $databaseConnector->getConnection();
    }

    public function trunq($userID, $trunqContent) {
        if (empty($trunqContent)) {
            return 'Trunq content cannot be empty!';
        }

        $trunqContent = htmlspecialchars($trunqContent);

        $query = "INSERT INTO Trunqs (UserID, TrunqContent) VALUES (?, ?)";
        $statement = $this->dbc->prepare($query);

        if (!$statement) {
            die("Error in preparing query: " . $this->dbc->error);
        }

        $statement->bind_param("is", $userID, $trunqContent);
        $statement->execute();
        $statement->close();

        return null;
    }
}

?>