<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Song</title>
</head>

<body>
    <h2>Upload a Song</h2>
    <form method="POST" action="/music_website/upload_song" enctype="multipart/form-data">
        <label>Song Title:</label><br>
        <input type="text" name="title" required><br>

        <label>Artist:</label><br>
        <select name="artist_id" required>
            <option value="" disabled selected>Select an artist</option>
            <?php
            if (!empty($artists)) {
                foreach ($artists as $artist) {
                    echo "<option value='{$artist['id']}'>{$artist['name']}</option>";
                }
            } else {
                echo "<option disabled>No artist available</option>";
            }
            ?>
        </select><br>

        <label>Album:</label><br>
        <select name="album_id">
            <option value="" selected>No album</option>
            <?php
            // Assuming $albums contains all available albums in the database
            foreach ($albums as $album) {
                echo "<option value='{$album['id']}'>{$album['name']}</option>";
            }
            ?>
        </select><br>

        <label>Genre:</label><br>
        <select name="genre_id" required>
            <option value="" disabled selected>Select a Genre</option>
            <?php
            if (!empty($genres)) {
                foreach ($genres as $genre) {
                    echo "<option value='{$genre['id']}'>{$genre['genre_name']}</option>";
                }
            } else {
                echo "<option disabled>No genres available</option>";
            }
            ?>
        </select><br>

        <label>Music File:</label><br>
        <input type="file" name="file" accept="audio/*" required><br>

        <label>Cover Image:</label><br>
        <input type="file" name="cover_image" accept="image/*" required><br>

        <label>Release Date:</label><br>
        <input type="date" name="release_date"><br>

        <button type="submit" name="upload_song">Upload Song</button>
    </form>
    
</body>

</html>