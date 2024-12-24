<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/music_website/css/style.css">
    <link rel="stylesheet" href="/music_website/css/bootstrap.min.css">
    <script src="/music_website/js/index.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />

</head>

<body>
    <div class="container-fluid">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="col-lg-2 d-none sidebar position-fixed h-100 d-none d-lg-block">
                <a href="#" class="sidebar-title">illusic</a>
                <p class="nav-title">Menu</p>
                <li class="nav-item active">
                    <i class="fa-solid fa-house"></i>
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <i class="fa-solid fa-compass"></i>
                    <a href="#" class="nav-link">Discover</a>
                </li>
                <li class="nav-item">
                    <i class="fa-solid fa-record-vinyl"></i>
                    <a href="#" class="nav-link">Albums</a>
                </li>
                <li class="nav-item">
                    <i class="fa-solid fa-circle-user"></i>
                    <a href="#" class="nav-link">Artists</a>
                </li>
                <p class="nav-title">Library</p>
                <li class="nav-item">
                    <i class="fa-solid fa-clock"></i>
                    <a href="#" class="nav-link">Recently added</a>
                </li>
                <li class="nav-item">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <a href="#" class="nav-link">Most played</a>
                </li>
                <p class="nav-title">Playlist</p>
                <li class="nav-item">
                    <i class="fa-regular fa-heart"></i>
                    <a href="#" class="nav-link">Yours favorites</a>
                </li>
                <li class="nav-item">
                    <i class="fa-solid fa-list"></i>
                    <a href="#" class="nav-link">Yours playists</a>
                </li>
            </div>

            <!-- Main Content -->
            <div class="main col-12 col-lg-10 offset-md-2 position-relative main-content ">
                <div class="hero-section col">
                    <header class="d-flex justify-content-between">
                        <div class="search-container d-flex align-items-center w-md-auto col-sm-10 col-md-5 col-lg-6 col-xl-4">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" class="search-bar" placeholder="Search for Music, Artists...">
                        </div>
                        <div class="other-links d-flex justify-content-around d-none d-xl-flex w-100 px-3">
                            <a href="#" class="tran-ha-link ">About Us</a>
                            <a href="#" class="tran-ha-link ">Contact</a>
                            <a href="#" class="tran-ha-link ">Premium</a>
                        </div>
                        <div class="header-btn d-flex w-md-auto d-none d-md-flex">
                            <a href="login" class="btn btn-outline-light login-btn">Login</a>
                            <a href="register" class="signup-btn btn ">Sign Up</a>
                        </div>
                    </header>
                </div>
                <div class="song-section weekly-songs">
                    <p class="section-name">Weekly Top <span>Songs</span></p>
                    <div class="cards-box d-flex align-items-center">
                        <?php if (!empty($songs)): ?>
                            <?php foreach ($songs as $song): ?>
                                <div class="song-cards">
                                    <div class="image-container">
                                        <img class="cards-image" src="/music_website/<?php echo htmlspecialchars($song['cover_image']); ?>" alt="">
                                    </div>
                                    <div class="song-info">
                                        <span class="song-name"><?php echo htmlspecialchars($song['title']); ?></span>
                                        <span class="artist"><?php echo htmlspecialchars($song['artist_name']); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No songs available.</p>
                        <?php endif; ?>

                        <div class="expand-btn d-flex align-items-center">
                            <div class="plus-i">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <span>View all</span>
                        </div>
                    </div>
                </div>
                <div class="song-section new-release-songs">
                    <p class="section-name">New release <span>Songs</span></p>
                    <div class="cards-box d-flex align-items-center">
                        <li class="card-1">
                            <div class="song-cards">
                                <div class="image-container">
                                    <img class="cards-image" src="/music_website/uploads/covers/2pac.png" alt="">
                                </div>
                                <div class="song-info">
                                    <span class="song-name">Hit em up</span>
                                    <span class="artist">2 Pac</span>
                                </div>
                            </div>
                        </li>
                        <li class="card-2">
                            <div class="song-cards">
                                <div class="image-container">
                                    <img class="cards-image" src="/music_website/uploads/covers/eminem.png" alt="">
                                </div>
                                <div class="song-info">
                                    <span class="song-name">Godzilla</span>
                                    <span class="artist">Eminem</span>
                                </div>
                            </div>
                        </li>
                        <li class="card-3">
                            <div class="song-cards">
                                <div class="image-container">
                                    <img class="cards-image" src="/music_website/uploads/covers/travisscott.png" alt="">
                                </div>
                                <div class="song-info">
                                    <span class="song-name">Fein</span>
                                    <span class="artist">Travis Scott</span>
                                </div>
                            </div>
                        </li>
                        <li class="card-4">
                            <div class="song-cards">
                                <div class="image-container">

                                    <img class="cards-image" src="/music_website/uploads/covers/centralcee.png" alt="">
                                </div>
                                <div class="song-info">
                                    <span class="song-name">Doja</span>
                                    <span class="artist">Central Cee</span>
                                </div>
                            </div>
                        </li>
                        <li class="card-5">
                            <div class="song-cards">
                                <div class="image-container">

                                    <img class="cards-image" src="/music_website/uploads/covers/wxrdie.png" alt="">
                                </div>
                                <div class="song-info">
                                    <span class="song-name">Bang qua Cau Giay</span>
                                    <span class="artist">Wxrdie</span>
                                </div>
                            </div>
                        </li>
                        <div class="expand-btn d-flex align-items-center">
                            <div class="plus-i">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <span>View all</span>
                        </div>
                    </div>
                </div>
                <div class="song-section top-trending-songs">
                    <p class="section-name">Trending <span>Songs</span></p>
                    <table border="0">
                        <colgroup>
                            <col style="width: 6.5%;">
                            <col style="width: 4%;">
                            <col style="width: 30%;">
                            <col style="width: 12%;">
                            <col style="width: 30%;">
                            <col style="width: 7%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th colspan="3"></th>
                                <th>Release Date</th>
                                <th class="text-center">Albums</th>
                                <th>Time</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="table-row-num">
                                    #1
                                </td>
                                <td>
                                    <img class="scl-img" src="/music_website/uploads/covers/ccmk.png" alt="">
                                </td>
                                <td>
                                    <div class="song-info">
                                        <span class="song-name">Tuong tu nang nhan vien</span>
                                        <span class="artist">CCMK</span>
                                    </div>
                                </td>
                                <td>
                                    <span>Nov,10 2024</span>
                                </td>
                                <td class="text-center">
                                    <span class="albums-name">Grab Viet</span>
                                </td>
                                <td>
                                    <div class="songs-duration">
                                        <span><i class="fa-regular fa-heart"></i>4:20</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>

</html>