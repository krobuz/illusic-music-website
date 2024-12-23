<?php
class Artist
{
    private $conn;
    private $table = "artist";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getArtistById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getArtists($limit = 10, $offset = 0)
    {
        $query = "SELECT * FROM " . $this->table . " LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSongsByArtist($artist_id)
    {
        $query = "SELECT * FROM songs WHERE artist_id = :artist_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":artist_id", $artist_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>