<?php
$getTitle = "Playlist";
ob_start();
session_start();
// include "ini.php";
include "conneSqli.php";
include "files.php";
$username = $_SESSION['userLoggedIn'];
?>

<div class="container text-center">
	<h1 class="">Playlists</h1>
	<button class="btn button" onclick="creatPlaylist()">new playlist</button>
	
			<?php
			$playlistsQuery = mysqli_query($conn, "SELECT * FROM playlists WHERE owner='$username'");
			if(mysqli_num_rows($playlistsQuery) == 0) {
				echo "<span class='noResults'>You don't have any playlists yet.</span>";
			}

			echo "<div class='row'>";

			while($row = mysqli_fetch_array($playlistsQuery)) {

				$playlist = new Playlist($conn, $row);
				echo "<div class='gridViewItem col-md-3 mt-5' role='link' tabindex='0' onclick='openPage(\"playlist.php?id=".$playlist->getId()."\")'>

						<div class='playlistImage'>
							<img width='70%' src='assets/images/icons/playlist2.jpg'>
						</div>
						
						<p class='gridViewInfo'>"
							. $playlist->getName() .
						"</p>

					</div>";



			}
		?>
	</div>
</div>



<style type="text/css">
	body {
		background-color: var(--dark-blue);
	}
	.navsidebar {
    height: 100vh;
    border-radius: 0;
	}
	 h1{
		padding-top: 50px;
		color: var(--dark-white);
	    font-family: var(--font-open);
	    text-transform: uppercase;
	}
		.button {
    border: 0;
    padding: 15px;
    letter-spacing: 4px;
    border-radius: 20px;
    min-width: 200px;
    margin-top: 20px;
    background-color: var(--dark-white);
    font-weight: 500;
}
.gridViewInfo {
	color: var(--dark-white);
	font-weight: 600;
	text-transform: capitalize;

}
.noResults {
	text-align: center;
    display: block;
    padding: 2em;
    margin: 5em 0;
    font-size: 2em;
    color: #fff;
}
</style>

 <?php include "assets/templets/footer.php";?>