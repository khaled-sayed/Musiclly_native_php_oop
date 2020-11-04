<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	include("ini.php");
	include("conneSqli.php");
	include "assets/classes/Personal.php";
	include("assets/classes/User.php");
	include("assets/classes/playlist.php");
	include("assets/classes/Artist.php");
	include("assets/classes/Album.php");
	include("assets/classes/song.php");

	if(isset($_GET['userLoggedIn'])) {
		$userLoggedIn = new User($conn, $_GET['userLoggedIn']);
	}
	else {
		echo "Username variable was not passed into page. Check the openPage JS function";
		exit();
	}
}
else {
	include("assets/templets/header.php");
	include("assets/templets/footer.php");
	$url = $_SERVER['REQUEST_URI'];
	echo "<script>openPage('$url')</script>";
	exit();
}

?>

