<?php
$getTitle = "Artist Page";
session_start();
include "ini.php";
include "conneSqli.php";
include "assets/classes/Artist.php";
include "assets/classes/Album.php";
include "assets/classes/song.php";

if(isset($_GET['id'])) {
	$artistId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$artist = new Artist($conn, $artistId);

?>


<div class="container">

	<div class="centerSection text-center">

		<div class="artistInfo">

			<h1 class="artistName"><?php echo $artist->getName(); ?></h1>

			<div class="headerButtons">
				<button onclick="playFirstSong()" class="btn button">PLAY</button>
			</div>

		</div>

	</div>

</div>
<div class="container">
<div class="tracklistContainer border-top border-bottom">
	<h1 class="headOfAlbum text-center">Songs</h1>
	<ul class="tracklist">
	<?php

		$songIdArray = $artist->getSongIds();
		$i = 1;
		foreach ($songIdArray as $songId) {
		if ($i > 5) {
			break;
		}
			
			$albumSong = new Song($conn, $songId);

		 	$albumArtist = $albumSong->getArtist();

echo "<li class='tracklistRow'>
<div class='row'>
	<div class='trackInfo col-md-10' onclick='setTrack(". $albumSong->getId() .", tempPlaylist , true)'>
	 	<span class='trackName'>".$albumSong->getTitle()."</span>
	 	<span class='artistName'>".$albumArtist->getName()."</span>
	</div>


		 	<div class='trackDuration col-md-2'>
		 		<span class='duration'>".$albumSong->getTDuration()."</span>
		 		<input type='hidden' class='songId' value='".$albumSong->getId()."'>
		 		<span class='optionButton' onclick='showOptionMenu(this)'><i class='fa fa-ellipsis-v' aria-hidden='true'></i></span>
		 	</div>







</div>
</li>";

$i = $i +1;

}?>
<script type="text/javascript">
	var tempPlaylist = [];
	var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
	tempPlaylist = JSON.parse(tempSongIds);
</script>
</ul>
</div>
</div>
<div class="container gridViewContainer text-center">
	<h1>Albums</h1>

	<?php
		$albumQuery = mysqli_query($conn, "SELECT * FROM albums WHERE artist='$artistId'");

		while($row = mysqli_fetch_array($albumQuery)) {
			



			echo "<div class='gridViewItem col-md-3'>
					<a href='album.php?id=".$row['id']."'>
						<img src='assets/images/artwork/" . $row['artworkPath'] . "'>

						<div class='gridViewInfo'>"
							. $row['title'] .
						"</div>
					</a>

				</div>";



		}
	?>

</div>

  <nav class="optionMenu">
 	<input type="hidden" class="songId">
 	<?php echo Playlist::getPlaylistDropdown($conn, $userLoggedIn); ?>
 </nav>

<?php include "assets/templets/player.php"; ?>
<style type="text/css">
	.centerSection {
		padding-top: 50px;
		color: var(--dark-white);
	    font-family: var(--font-open);
	}
	.button {
    border: 0;
    padding: 15px;
    letter-spacing: 4px;
    border-radius: 20px;
    min-width: 200px;
    margin-top: 20px;
    background-color: var(--dark-white);
}
	.tracklistContainer {
		margin-top: 20px;
		margin-bottom: 20px; 
	}
	.gridViewItem img{
		width: 40%;
		height: 130px;
    border-radius: 15px;
	}
	.gridViewContainer h1, .headOfAlbum{
		padding-top: 50px;
		color: var(--dark-white);
	    font-family: var(--font-open);
	}
 	.optionMenu{
 	position: fixed;
    background-color: #dee2e6;
    width: 200px;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 3px;
    z-index: 1000;
    display: none;
    max-height: 50px;
    right: 24%;
}

.optionMenu .item {
	width: 100%;
    padding: 12px 20px;
    box-sizing: border-box;
    font-weight: 400;
    color: rgba(0, 0, 0, 0.8);
    cursor: pointer;
}
.optionMenu select {
	    border: none;
    -webkit-appearance: none;
    -moz-appearance: none;
}

	</style>

	 <?php include "assets/templets/footer.php";?>