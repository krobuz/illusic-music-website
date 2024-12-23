<?php
// Assuming the artist ID is passed as a URL parameter
$artistId = $_GET['id']; // You can validate this and ensure it's an integer

// Get the artist and their songs using the Artist model
$artistModel = new Artist($db);
$artist = $artistModel->getArtistById($artistId);
$songs = $artistModel->getSongsByArtist($artistId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($artist['name']); ?></title>
</head>
<body>

    <h1><?php echo htmlspecialchars($artist['name']); ?></h1>
    <img src="<?php echo $artist['image']; ?>" alt="<?php echo htmlspecialchars($artist['name']); ?>'s Image">
    <p><?php echo htmlspecialchars($artist['bio']); ?></p>

    <h2>Songs by <?php echo htmlspecialchars($artist['name']); ?></h2>
    <ul>
        <?php foreach ($songs as $song): ?>
            <li>
                <a href="play_song.php?id=<?php echo $song['id']; ?>"><?php echo htmlspecialchars($song['title']); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>
