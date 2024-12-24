<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Song.php';
require_once __DIR__ . '/../models/Genre.php';
require_once __DIR__ . '/../models/Artist.php';

class SongController
{
    private $db;
    private $songModel;
    private $genreModel;
    private $artistModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->songModel = new Song($this->db);
        $this->genreModel = new Genre($this->db);
        $this->artistModel = new Artist($this->db);
    }

    public function getAllSongs()
    {
        return $this->songModel->getSongs();
    }

    public function uploadSongForm()
    {
        $genres = $this->genreModel->getAllGenres();
        $artists = $this->artistModel->getArtists();
        include 'views/upload_song.php';
    }

    // public function uploadSong()
    // {
    //     error_log('uploadSong function is called');

    //     $title = $_POST['title'];
    //     $artist_id = $_POST['artist_id'];
    //     $album_id = !empty($_POST['album_id']) ? $_POST['album_id'] : 0;
    //     $genre = $_POST['genre'];
    //     $release_date = $_POST['release_date'];

    //     // Handle file uploads
    //     $file = $_FILES['file'];
    //     $cleaned_file_name = preg_replace('/[^a-zA-Z0-9\-\_\.]/', '_', basename($file['name']));
    //     $file_path = __DIR__ . "/../uploads/songs/" . $cleaned_file_name;

    //     // Ensure directory exists and create if not
    //     if (!file_exists('uploads/songs')) {
    //         mkdir('uploads/songs', 0777, true);
    //     }

    //     if ($file['error'] === UPLOAD_ERR_OK) {
    //         move_uploaded_file($file['tmp_name'], $file_path);
    //     } else {
    //         error_log("File upload error: " . $file['error']);
    //         echo "Error uploading music file";
    //         return;
    //     }

    //     // Handle cover image uploads
    //     $cover_image = $_FILES['cover_image'];
    //     $cleaned_cover_image_name = preg_replace('/[^a-zA-Z0-9\-\_\.]/', '_', basename($cover_image['name']));
    //     $cover_image_path = __DIR__ . "/../uploads/covers/" . $cleaned_cover_image_name;

    //     // Ensure directory exists and create if not
    //     if (!file_exists('uploads/covers')) {
    //         mkdir('uploads/covers', 0777, true);
    //     }

    //     if ($cover_image['error'] === UPLOAD_ERR_OK) {
    //         move_uploaded_file($cover_image['tmp_name'], $cover_image_path);
    //     } else {
    //         error_log("Cover image upload error: " . $cover_image['error']);
    //         echo "Error uploading cover image";
    //         return;
    //     }

    //     $result = $this->songModel->uploadSong($title, $artist_id, $album_id, $genre, $file_path, $cover_image, $release_date);
    //     error_log('Result from uploadSongModel: ' . var_export($result, true));
    //     if ($result) {
    //         echo "Song uploaded successfully";
    //     } else {
    //         echo "Failed to upload song";
    //     }
    // }

    public function uploadSong()
    {
        try {

            error_log('POST data: ' . print_r($_POST, true));
            error_log('Artist ID received: ' . $_POST['artist_id']);
            error_log('album_id received: ' . $_POST['album_id']);
            error_log('genre_id received: ' . $_POST['genre_id']);

            $release_date = !empty($_POST['release_date'])
                ? $_POST['release_date']
                : date('Y-m-d H:i:s');

            error_log("Release date value: " . $release_date);

            // Collect basic song information
            $songData = [
                'title' => $_POST['title'],
                'artist_id' => $_POST['artist_id'],
                'album_id' => !empty($_POST['album_id']) ? $_POST['album_id'] : null,
                'genre_id' => $_POST['genre_id'],
                'release_date' => !empty($_POST['release_date'])
                    ? $_POST['release_date']
                    : date('Y-m-d H:i:s')
            ];

            // Handle file uploads
            $uploads = [
                'song' => [
                    'file' => $_FILES['file'],
                    'relative_directory' => 'uploads/songs/',
                    'absolute_directory' => __DIR__ . '/../uploads/songs/'
                ],
                'cover' => [
                    'file' => $_FILES['cover_image'],
                    'relative_directory' => 'uploads/covers/',
                    'absolute_directory' => __DIR__ . '/../uploads/covers/'
                ]
            ];
            
            $filePaths = [];
            foreach ($uploads as $type => $upload) {
                // Create directory if it doesn't exist
                if (!is_dir($upload['absolute_directory'])) {
                    mkdir($upload['absolute_directory'], 0777, true);
                }
            
                // Clean filename and move file
                $cleanName = preg_replace('/[^a-zA-Z0-9\-\_\.]/', '_', $upload['file']['name']);
                $absolutePath = $upload['absolute_directory'] . $cleanName;
            
                if (
                    $upload['file']['error'] !== UPLOAD_ERR_OK ||
                    !move_uploaded_file($upload['file']['tmp_name'], $absolutePath)
                ) {
                    throw new Exception("Error uploading {$type}");
                }
            
                // Save relative path to filePaths array
                $filePaths[$type] = $upload['relative_directory'] . $cleanName;
            }

            // Save to database
            $success = $this->songModel->uploadSong(
                $songData['title'],
                $songData['artist_id'],
                $songData['album_id'],
                $songData['genre_id'],
                $filePaths['song'],
                $filePaths['cover'],
                $songData['release_date']
            );

            // echo $success ? "Song uploaded successfully" : "Failed to upload song";
            header("Location: /music_website/upload_song");
            exit();
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo $e->getMessage();
        }
    }
}
