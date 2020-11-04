<?php


if(isset($_POST['login'])) {
	//Login button was pressed
	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = $account->login($username, $password);

	if($result == true) {
		$_SESSION['userLoggedIn'] = $username;
		header("Location: index.php");
	}

}
?>