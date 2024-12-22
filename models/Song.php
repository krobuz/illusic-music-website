<?php
class Song {
    private $conn;
    private $table = "songs";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function uploadSong($title, $artist_id, $album_id, $genre, $file_path, $cover_image, $release_date) {
        $query = "INSERT INTO " . $this->table . " 
                  (title, artist_id, album_id, genre, file_path, cover_image, release_date)
                  VALUES (:title, :artist_id, :album_id, :genre, :file_path, :cover_image, :release_date)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":artist_id", $artist_id);
        $stmt->bindParam(":album_id", $album_id);
        $stmt->bindParam(":genre", $genre);
        $stmt->bindParam(":file_path", $file_path);
        $stmt->bindParam(":cover_image", $cover_image);
        $stmt->bindParam(":release_date", $release_date);
        return $stmt->execute();
    }
}
?>