<?php
require_once '../config/Database.php';
require_once '../models/Song.php';

$db = (new Database())->getConnection();
$song = new Song($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_song'])) {
    $file_path = "/uploads/" . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], __DIR__ . $file_path);

    $cover_image = "/uploads/" . basename($_FILES["cover_image"]["name"]);
    move_uploaded_file($_FILES["cover_image"]["tmp_name"], __DIR__ . $cover_image);

    $song->uploadSong($_POST['title'], $_POST['artist_id'], $_POST['album_id'], $_POST['genre'], $file_path, $cover_image, $_POST['release_date']);
    echo "Song uploaded successfully!";
}
?>
