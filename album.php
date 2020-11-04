<?php
session_start();
$getTitle = 'Album';
include "ini.php";
include "conneSqli.php";
include "assets/classes/playlist.php";
include "assets/classes/Artist.php";
include "assets/classes/Album.php";
include "assets/classes/song.php";
$path = 'assets/images/artwork/'; 

if(isset($_SESSION['userLoggedIn'])) {
	
}else {
	header("location:login.php");
}


if (isset($_GET['id'])) {
	
	$albumId = $_GET['id'];
} else {

	header("location:index.php");


}

	$album = new Album($conn, $albumId);

	$artist = $album->getArtist();

?>
<div class="entityInfo">

	<div class="leftSection">
		<img src="<?php echo $path.$album->getArtwork(); ?>">
	</div>

	<div class="rightSection">
		<h2><?php echo $album->getTitle(); ?></h2>
		<p>By <?php echo $artist->getName(); ?></p>
		<p><?php echo $album->getNumberOfSoungs(); ?> songs</p>

	</div>

</div>


<div class="container">
<div class="tracklistContainer">
	<ul class="tracklist">
	<?php

		$songIdArray = $album->getSongId();
		$i = 1;
		foreach ($songIdArray as $songId) {
			
			$albumSong = new Song($conn, $songId);

		 	$albumArtist = $albumSong->getArtist();

echo "<li class='tracklistRow'>
<div class='row'>
	<div class='trackInfo col-md-10 col-9' onclick='setTrack(". $albumSong->getId() .", tempPlaylist , true)'>
	 	<span class='trackName'>".$albumSong->getTitle()."</span>
	 	<span class='artistName'>".$albumArtist->getName()."</span>
	</div>


		 	<div class='trackDuration col-md-2 col-3'>
		 		<span class='duration'>".$albumSong->getTDuration()."</span>
		 		<input type='hidden' class='songId' value='".$albumSong->getId()."'>
		 		<span class='optionButton' onclick='showOptionMenu(this)'><i class='fa fa-ellipsis-v' aria-hidden='true'></i></span>
		 	</div>







</div>
</li>";

$i = $i +1;

}?>


</ul>
</div>
</div>
  <nav class="optionMenu">
 	<input type="hidden" class="songId">
 	<?php echo Playlist::getPlaylistDropdown($conn, $userLoggedIn); ?>
 </nav>
<?php
include "assets/templets/player.php";
?>
 

 <style type="text/css">
 	body {
 		background-color: var(--dark-blue);
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