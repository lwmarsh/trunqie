<?php 

require_once('./includes/database_connector.php');

class TrunqManager {
    private $dbc;

    public function __construct(DatabaseConnector $databaseConnector) {
        $this->dbc = $databaseConnector->getConnection();
 
    }

    public function getTrunqs($userID = null) {
        if ($userID) {
            $query = "SELECT Trunqs.TrunqContent, Trunqs.timestamp AS trunq_timestamp, Users.Username 
                      FROM Trunqs 
                      INNER JOIN Users ON Trunqs.UserID = Users.UserID 
                      WHERE Trunqs.UserID = ?
                      ORDER BY Trunqs.timestamp DESC";
            $statement = $this->dbc->prepare($query);

            if (!$statement) {
                die("Error in preparing query: " . $this->dbc->error);
            }

            $statement->bind_param("i", $userID);
            $statement->execute();

        } else {
            $query = "SELECT Trunqs.TrunqContent, Trunqs.timestamp AS trunq_timestamp, Users.Username
                  FROM Trunqs
                  INNER JOIN Users ON Trunqs.UserID = Users.UserID
                  ORDER BY Trunqs.timestamp DESC";
            $statement = $this->dbc->prepare($query);

        if (!$statement) {
            die("Error in preparing query: " . $this->dbc->error);
        }       

        $statement->execute();
    }

    $result = $statement->get_result();
    $trunqs = $result->fetch_all(MYSQLI_ASSOC);
    $statement->close();
    
    return $trunqs;
    }

}

?>