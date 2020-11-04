<?php
include "../../../conneSqli.php";

if (isset($_POST['currPassword']) && isset($_POST['newPassword']) && isset($_POST['newPassword2']) && isset($_POST['username'])) {

	$currPassword = $_POST['currPassword'];
	$newPassword = $_POST['newPassword'];
	$newPassword2 = $_POST['newPassword2'];
	$username = $_POST['username'];

	$hashPass = sha1($currPassword);
	$hashNewPass = sha1($newPassword);

	if ($newPassword !=$newPassword2) {
		echo "New Password And Confirm Password Not Match";
		exit();
	}


	$currentPassword = mysqli_query($conn, "SELECT password FROM users WHERE password ='$hashPass' AND userName='$username'");


	if(mysqli_num_rows($currentPassword) == 0) {
		echo "Current Password Not Passed";
		exit();
	}

	$updateQuery = mysqli_query($conn, "UPDATE users SET password='$hashNewPass' WHERE userName='$username'");
	echo "Update Succses";


} else {

	echo "Sorry Wrong";
}

?>



