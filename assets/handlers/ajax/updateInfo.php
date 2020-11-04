<?php
include "../../../conneSqli.php";

if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['username'])) {

	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$date = date("Y-m-d");

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo "Email is invalid";
		exit();
	}

	$emailCheck = mysqli_query($conn, "SELECT email FROM users WHERE email='$email' AND userName!='$username'");

	if(mysqli_num_rows($emailCheck) > 0) {
		echo "Email is Alrady Exist";
		exit();
	}

	$updateQuery = mysqli_query($conn, "UPDATE users SET email='$email', lastUpdate='$date', firstName='$firstName', lastName='$lastName' WHERE userName='$username'");
	echo "Update Succses";


} else {

	echo "Sorry Wrong";
}

?>



