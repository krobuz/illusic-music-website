document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', () => {
        const link = item.querySelector('a');
        if (link) {
            window.location.href = link.href;
        }
    });
});


// document.addEventListener("DOMContentLoaded", function () {
//     const songCards = document.querySelectorAll(".song-cards");

//     const audioPlayer = document.createElement("audio");
//     audioPlayer.setAttribute("controls", "true");
//     document.body.appendChild(audioPlayer);

//     // When a song card is clicked, play the song
//     songCards.forEach(card => {
//         card.addEventListener("click", function () {
//             // Get the song file and title from the card's data attributes
//             const songFile = card.getAttribute("data-song-file");
//             const songTitle = card.getAttribute("data-song-title");
//             const coverImage = card.getAttribute("data-cover-image");

//             // Log the song info (optional for debugging)
//             console.log(`Playing: ${songTitle}`);

//             // Set the audio player's source to the clicked song's file
//             audioPlayer.src = "/music_website/uploads/songs/" + songFile;

//             // Optionally, update the cover image or other elements dynamically
//             document.querySelector(".song-name").textContent = songTitle;

//             // Play the song
//             audioPlayer.play();
//         });
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
    const songCards = document.querySelectorAll(".song-cards");
    const audioPlayer = new Audio();
    const playPauseButton = document.querySelector(".play-pause i");
    const shuffleButton = document.querySelector(".shuffle");
    const repeatButton = document.querySelector(".repeat");
    const prevButton = document.querySelector(".prev");
    const nextButton = document.querySelector(".next");
    const seekSlider = document.querySelector(".seek-slider");
    const volumeSlider = document.querySelector(".volume-slider");

    const footerCover = document.querySelector(".footer-song-img");
    const footerTitle = document.querySelector(".footer-song-name");
    const footerArtist = document.querySelector(".footer-artist");

    let currentSongIndex = 0;
    let isPlaying = false;
    let songList = Array.from(songCards);

    // Function to update footer player
    function updateFooter(songCard) {
        const songFile = songCard.getAttribute("data-song-file");
        const songTitle = songCard.getAttribute("data-song-title");
        const artistName = songCard.getAttribute("data-artist-name");
        const coverImage = songCard.getAttribute("data-cover-image");

        footerCover.src = coverImage;
        footerTitle.textContent = songTitle;
        footerArtist.textContent = artistName;

        audioPlayer.src = songFile;
        audioPlayer.play();
        isPlaying = true;
        playPauseButton.classList.replace("fa-play", "fa-pause");
    }

    // Function to toggle play/pause
    function togglePlayPause() {
        if (isPlaying) {
            audioPlayer.pause();
            isPlaying = false;
            playPauseButton.classList.replace("fa-pause", "fa-play");
        } else {
            audioPlayer.play();
            isPlaying = true;
            playPauseButton.classList.replace("fa-play", "fa-pause");
        }
    }

    // Attach click event to song cards
    songCards.forEach((card, index) => {
        card.addEventListener("click", () => {
            currentSongIndex = index;
            updateFooter(card);
        });
    });

    // Play/Pause Button
    playPauseButton.addEventListener("click", togglePlayPause);

    // Next Button
    nextButton.addEventListener("click", () => {
        currentSongIndex = (currentSongIndex + 1) % songList.length;
        updateFooter(songList[currentSongIndex]);
    });

    // Previous Button
    prevButton.addEventListener("click", () => {
        currentSongIndex =
            (currentSongIndex - 1 + songList.length) % songList.length;
        updateFooter(songList[currentSongIndex]);
    });

    // Shuffle Button
    shuffleButton.addEventListener("click", () => {
        currentSongIndex = Math.floor(Math.random() * songList.length);
        updateFooter(songList[currentSongIndex]);
    });

    // Repeat Button
    repeatButton.addEventListener("click", () => {
        audioPlayer.loop = !audioPlayer.loop;
        repeatButton.classList.toggle("active", audioPlayer.loop);
    });

    // Seek Slider
    audioPlayer.addEventListener("timeupdate", () => {
        seekSlider.value = (audioPlayer.currentTime / audioPlayer.duration) * 100 || 0;
    });

    seekSlider.addEventListener("input", () => {
        audioPlayer.currentTime =
            (seekSlider.value / 100) * audioPlayer.duration;
    });

    // Volume Slider
    volumeSlider.addEventListener("input", () => {
        audioPlayer.volume = volumeSlider.value / 100;
    });
});

