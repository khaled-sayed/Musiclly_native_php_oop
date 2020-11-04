<?php
include 'conneSqli.php';
$query = mysqli_query($conn, "SELECT firstName FROM users WHERE userName='$userLoggedIn'");
$row = mysqli_fetch_array($query);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
      <button id="button-navbar" class="navbar-toggler">
    <span class="navbar-toggler-icon ml-auto"></span>
  </button>
  <a class="navbar-brand ml-auto" href="#">Musiclly</a>
</nav>

<!-- Navbar Slid -->
    <div id="nav" class="navsidebar">
        <h4>library</h4>
        <div class="first-li">
            <ul class="row">
                <li class="col-md-12">
                    <a role="link" tabindex="0" onclick="openPage('index.php')">
                        <img src="https://img.icons8.com/metro/26/000000/activity-grid-2.png"/>
                        <span>Home</span>
                    </a>
                </li>
                <li class="col-md-12">
                    <a href="yourMusic.php">
                        <img src="https://img.icons8.com/ios/50/000000/video-playlist.png"/>
                        <span>Playlists</span>
                    </a>
                </li>
                <li class="col-md-12">
                    <a role="link" tabindex="0" onclick="openPage('artist.php')">
                        <img src="https://img.icons8.com/ios/50/000000/recent-actors.png"/>
                        <span>Artists</span>
                    </a>
                </li>
                <li class="col-md-12">
                    <a role="link" tabindex="0" onclick="openPage('albums.php')">
                        <img src="https://img.icons8.com/ios/50/000000/music-album.png"/>
                        <span>Albums</span>
                    </a>
                </li>
                <li class="col-md-12">
                    <a role="link" tabindex="0" onclick="openPage('songs.php')">
                        <img src="https://img.icons8.com/ios-glyphs/60/000000/lounge-music-playlist.png"/>
                        <span>Songs</span>
                    </a>
                </li>
            </ul>
        </div> 
        <div class="settinguser text-center">
            <span>Hi,<?php echo $row['firstName']; ?></span>
            <a href="setting.php"><i class="fa fa-cog" aria-hidden="true"></i></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>    

    <!-- Navbar Header -->
<!--     <div class="container">
        <div class="header-up">
            <ul>
                <li><a class="active" href="#">Featured</a></li>
                <li><a href="#">Prodcasts</a></li>
                <li><a href="#">Charts</a></li>
                <li><a href="#">Genres</a></li>
                <li><a href="#">New Relases</a></li>
            </ul>
        </div>
    </div>

 -->
   
<script type="text/javascript">
    var toggleNav = document.getElementById('button-navbar');
var nav = document.getElementById('nav');

toggleNav.addEventListener('click', () => {
nav.classList.toggle('activeNav');
});
</script>