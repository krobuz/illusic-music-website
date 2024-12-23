<?php
class Song
{
    private $conn;
    private $table = "songs";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function uploadSong(string $title, int $artist_id, ?int $album_id, int $genre_id, string $file_path, string $cover_image, string $release_date)
    {
        $album_id = !empty($album_id) ? $album_id : null;
        $query = "INSERT INTO " . $this->table . " 
                  (title, artist_id, album_id, genre, file_path, cover_image, release_date)
                  VALUES (:title, :artist_id, :album_id, :genre, :file_path, :cover_image, :release_date)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":artist_id", $artist_id, PDO::PARAM_INT);
        $stmt->bindParam(":album_id", $album_id, PDO::PARAM_INT);
        $stmt->bindParam(":genre", $genre_id, PDO::PARAM_INT);
        $stmt->bindParam(":file_path", $file_path);
        $stmt->bindParam(":cover_image", $cover_image);
        $stmt->bindParam(":release_date", $release_date);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error executing query: " . implode(", ", $stmt->errorInfo()));
            return false;
        }
    }

    public function deleteSong($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function updateSong($id, $title, $artist_id, $album_id, $genre, $file_path, $cover_image, $release_date)
    {
        $query = "UPDATE " . $this->table . " SET title = :title, artist_id = :artist_id, 
                                        album_id = :album_id, genre = :genre, file_path = :file_path, 
                                        cover_image = :cover_image, release_date = :release_date WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":artist_id", $artist_id);
        $stmt->bindParam(":album_id", $album_id);
        $stmt->bindParam(":genre", $genre);
        $stmt->bindParam(":file_path", $file_path);
        $stmt->bindParam(":cover_image", $cover_image);
        $stmt->bindParam(":release_date", $release_date);
        return $stmt->execute();
    }

    public function getSongs($limit = 10, $offset = 0)
    {
        $query = "SELECT * FROM " . $this->table . " LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function getSongById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }
}
