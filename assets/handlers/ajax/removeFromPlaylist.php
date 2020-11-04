<?php
include "../../../conneSqli.php";

if (isset($_POST['playlistId']) && isset($_POST['songId'])) {
	$playlistId = $_POST['playlistId'];
	$songId = $_POST['songId'];
	$songsQuery = mysqli_query($conn, "DELETE FROM playlistsongs WHERE playlistId='$playlistId' AND songId='$songId'");

}
else {

	echo "PlaylistId and songID Isn't Passed";

}