<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Song</title>
</head>

<body>
    <h2>Upload a Song</h2>
    <form method="POST" action="../controllers/SongController.php" enctype="multipart/form-data">
        <label>Song Title:</label><br>
        <input type="text" name="title" required><br>

        <label>Artist ID:</label><br>
        <input type="number" name="artist_id" required><br>

        <label>Album ID:</label><br>
        <input type="number" name="album_id" required><br>

        <label>Genre:</label><br>
        <input type="text" name="genre" required><br>

        <label>Music File:</label><br>
        <input type="file" name="file" accept="audio/*" required><br>

        <label>Cover Image:</label><br>
        <input type="file" name="cover_image" accept="image/*" required><br>

        <label>Release Date:</label><br>
        <input type="date" name="release_date" required><br>

        <button type="submit" name="upload_song">Upload Song</button>
    </form>
</body>

</html>