<?php
session_start();
$getTitle = 'Your Playlist';
include "files.php";
$path = 'assets/images/artwork/'; 

if(isset($_SESSION['userLoggedIn'])) {
	
}else {
	header("location:login.php");
}


if (isset($_GET['id'])) {
	
	$playlistId = $_GET['id'];
} else {

	header("location:index.php");


}

	$playlist = new Playlist($conn, $playlistId);
	$owner = new User($conn, $playlist->getOwner());

?>
<div class="entityInfo">

	<div class="leftSection">
		<img src="assets/images/icons/playlist2.jpg">
	</div>

	<div class="rightSection">
		<h2><?php echo $playlist->getName(); ?></h2>
		<p>By <?php echo $playlist->getOwner(); ?></p>
		<p><?php echo $playlist->getNumberOfSoungs(); ?> songs</p>
		<button class="btn button" onclick="deletePlaylist('<?php echo $playlistId; ?>')">DELETE PLAYLIST</button>

	</div>

</div>


<div class="container">
<div class="tracklistContainer">
	<ul class="tracklist">
	<?php

		$songIdArray = $playlist->getSongId();
		$i = 1;
		foreach ($songIdArray as $songId) {
			
			$playlistSong = new Song($conn, $songId);

		 	$songArtist = $playlistSong->getArtist();

echo "<li class='tracklistRow'>
<div class='row'>
	<div class='trackInfo col-md-10' onclick='setTrack(". $playlistSong->getId() .", tempPlaylist , true)'>
	 	<span class='trackName'>".$playlistSong->getTitle()."</span>
	 	<span class='artistName'>".$songArtist->getName()."</span>
	</div>


		 	<div class='trackDuration col-md-2'>
		 		<span class='duration'>".$playlistSong->getTDuration()."</span>
		 		<input type='hidden' class='songId' value='".$playlistSong->getId()."'>
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
 	<?php echo Playlist::getPlaylistDropdown($conn, $playlist->getOwner()); ?>
 	<div class="item" onclick="removeFromPlaylist(this,'<?php echo $playlistId;?>')">Remove From Playlist</div>
 </nav>

<?php
include "assets/templets/player.php";
?>
 

 <?php include "assets/templets/footer.php";?>

 <style>
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
    background-color: #fff;
}
.optionMenu select {
	    border: none;
    -webkit-appearance: none;
    -moz-appearance: none;
}
 </style>