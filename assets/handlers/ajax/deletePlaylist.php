<?php
include "../../../conneSqli.php";

if (isset($_POST['playlistId'])) {
	$playlistId = $_POST['playlistId'];

	$playlistQuery = mysqli_query($conn, "DELETE FROM playlists WHERE id='$playlistId'");
	$songsQuery = mysqli_query($conn, "DELETE FROM playlistsongs WHERE playlistId='$playlistId'");

}
else {

	echo "PlaylistId Isn't Passed";

}