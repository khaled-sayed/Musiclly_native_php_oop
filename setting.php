<?php
session_start();
$getTitle = 'Setting';
include "conneSqli.php";
include "files.php";


$path = 'assets/images/artwork/'; 

if(isset($_SESSION['userLoggedIn'])) {
	
}else {
	header("location:login.php");
}

$userLoggedIn = $_SESSION['userLoggedIn'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE userName='$userLoggedIn'");
$row = mysqli_fetch_array($query);


?>

<div class="container">	
		<div class="text-right">
			<span class="lastUpdate">Last Updated: <?php echo $row['lastUpdate'];?></span>
		</div>
	<div class="personal-info text-center">
		<h3>Welcome <?php echo $row['firstName']." ".$row['lastName'];?></h3>
		<h3>Personal Info</h3>
		<div class="row">
		<div class="form-group col-sm-6">
			<label for="first name">First Name</label>
			<input id="firstname" class="form-control" type="text" name="firstname" value="<?php echo $row['firstName']; ?>" required>
		</div>
		<div class="form-group col-sm-6">
			<label for="last name">Last Name</label>
			<input id="lastname" class="form-control" type="text" name="lastname" value="<?php echo $row['lastName']; ?>" required>
		</div>
		<div class="form-group col-sm-12">
			<label for="Email">Email</label>
			<input id="email" class="form-control" type="email" name="email" value="<?php echo $row['email']; ?>" required>
		</div>
		</div>
		<div class="form-group">
			<button class="updateInfo btn" onclick="updateInfo('<?php echo $userLoggedIn; ?>')">Save</button>
		</div>
	</div>
</div>

<!--Password Update-->
<div class="container">	
	<div class="password-update text-center">
		<h3>Password</h3>
		<div class="row">
		<div class="form-group offset-sm-3 col-sm-6">
			<label for="current password">Current Password</label>
			<input id="curpassword" class="form-control" type="password" name="password" required>
		</div>
		<div class="form-group offset-sm-3 col-sm-6">
			<label for="new password">New Password</label>
			<input id="newpassword" class="form-control" type="password" name="newpassword" required>
		</div>
		<div class="form-group offset-sm-3 col-sm-6">
			<label for="Confirm password">Confirm Password</label>
			<input id="newpassword2" class="form-control" type="password" name="newpassword2" required>
		</div>
		</div>
		<div class="form-group">
			<button class="updateInfo btn" onclick="updatePassword('<?php echo $userLoggedIn; ?>')">Save</button>
		</div>
	</div>
</div>




<style type="text/css">
	body {
		background-color: var(--dark-blue);
	}
	nav {
		height: 100vh;
		border-radius: 0;
	}
	.lastUpdate{
		color: var(--dark-white);
		font-weight: 500;
	}
	h3 {
		padding: 20px 0;
		color: var(--dark-white);
		text-transform: uppercase;
	}
	label {
		/*display: inline-block;*/
		color: var(--dark-white);
		font-weight: 600;
		padding: 10px 15px;
	}
	.form-control{
		/*display: block;*/
		width: 50%;
		margin: auto;
	}
	.updateInfo {
		border: 0;
    padding: 15px;
    letter-spacing: 4px;
    border-radius: 20px;
    min-width: 200px;
    margin-top: 20px;
    background-color: var(--dark-white);
    font-weight: 500;
    margin: 20px 0;
	}
	.container{
		position: relative;
	}
	.personal-info:after {
		content: '';
		position: absolute;
		left: 0;
		width: 100%;
		height: 2px;
		background-color: #fff;
		border-radius: 2px;
	}

</style>



 <?php include "assets/templets/footer.php";?>