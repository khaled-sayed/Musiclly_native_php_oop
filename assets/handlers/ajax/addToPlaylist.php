<?php
include "../../../conneSqli.php";

if (isset($_POST['playlistId']) && isset($_POST['songId'])) {
	$playlistId = $_POST['playlistId'];
	$songId = $_POST['songId'];

	$orderIdQuery = mysqli_query($conn, "SELECT MAX(playlistOrder) + 1 AS playlistOrder FROM playlistsongs WHERE playlistId='$playlistId'");

	$row = mysqli_fetch_array($orderIdQuery);
	$order = $row['playlistOrder'];

	$query = mysqli_query($conn, "INSERT INTO playlistsongs VALUES('', '$songId', '$playlistId', '$order')");

}
else {

	echo "PlaylistId Or SongID Isn't Passed";

}


?>