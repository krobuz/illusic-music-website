<?php
class Genre
{
    private $conn;
    private $table = "genre";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllGenres()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // error_log(print_r($result, true));
        return $result;
    }
}

?>