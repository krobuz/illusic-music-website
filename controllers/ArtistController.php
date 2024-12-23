<?php
require_once 'config/Database.php';
require_once 'models/Artist.php';

class ArtistController
{
    private $artistModel;

    public function __construct($db)
    {
        $this->artistModel = new Artist($db);
    }

    public function showArtist($id)
    {
        $artist = $this->artistModel->getArtistById($id);
        $songs = $this->artistModel->getSongsByArtist($id);
        
        // Render the artist view with the artist data and their songs
        include 'views/artist.php';
    }
}

?>