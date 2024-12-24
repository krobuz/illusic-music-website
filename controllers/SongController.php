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
        return $this->songModel->getSongs(10, 0);

    }

    public function getSong($id)
    {
        return $this->songModel->getSongById($id);
    }

    public function index()
    {
        $songs = $this->songModel->getSongs(10, 0);
        // error_log('Songs: ' . print_r($songs, true));
        if (!$songs) {
            $songs = [];  // Ensure it defaults to an empty array
        }
        include 'views/home.php';
    }

    public function uploadSongForm()
    {
        $genres = $this->genreModel->getAllGenres();
        $artists = $this->artistModel->getArtists();
        include 'views/upload_song.php';
    }

    public function deleteSong($id)
    {
        $success = $this->songModel->deleteSong($id);
        echo $success ? "Song deleted successfully" : "Failed to delete song";
    }


    public function uploadSong()
    {
        try {

            // error_log('POST data: ' . print_r($_POST, true));
            // error_log('Artist ID received: ' . $_POST['artist_id']);
            // error_log('album_id received: ' . $_POST['album_id']);
            // error_log('genre_id received: ' . $_POST['genre_id']);

            // $release_date = !empty($_POST['release_date'])
            //     ? $_POST['release_date']
            //     : date('Y-m-d H:i:s');

            // error_log("Release date value: " . $release_date);

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
                $originalName = $upload['file']['name'];
                $cleanName = preg_replace('/[^a-zA-Z0-9\-\_\.]/', '_', $originalName);
                $safeName = ($originalName === $cleanName) ? $originalName : $cleanName;
                $absolutePath = $upload['absolute_directory'] . $safeName;

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
