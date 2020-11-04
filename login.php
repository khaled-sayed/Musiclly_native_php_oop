<?php
session_start();
$getTitle = 'Login';
include "ini for login.php";
if(isset($_SESSION['userLoggedIn'])){
    header("location:index.php");
    
}
include "conneSqli.php";
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		if (isset($_POST['login'])) {

		

    $user = $_POST['username'];
    $password = $_POST['password'];
    $hashdpassword = sha1($password);
    
		    // Check if User set in DataBase
      $query = "SELECT * FROM users WHERE userName= '$user' AND password='$hashdpassword'";
		  $result = mysqli_query($conn, $query);
      $resultRow = mysqli_num_rows($result) == 1 ? true : false;


		   // if Data Count > 0 This Main Database Contain Record About This Username

		   
           if($resultRow == true) {
          $_SESSION['userLoggedIn'] = $user;
          header("Location:index.php");
        } else {
          echo "sorry";
        }

   } else {


   	$formErrors = array();

   	$username = $_POST['username'];
   	$firstname = $_POST['firstname'];
   	$lastname = $_POST['lastname']; 	
   	$password = $_POST['password']; 
   	$password2 = $_POST['password-agin']; 
   	$email = $_POST['email']; 
   	// Start Username Valid
   	if (isset($username)) {
   		
   		$filterUser = filter_var($username , FILTER_SANITIZE_STRING);

   		if (strlen($filterUser) < 4) {
   			
   			$formErrors[] = "Username Is Too Short";
   		}

   	} // End Username Valid
   	if (isset($firstname)) {
   		
   		$filterFirstName = filter_var($firstname , FILTER_SANITIZE_STRING);

   		if (strlen($filterFirstName) < 4) {
   			
   			$formErrors[] = "First Name Is Too Short";
   		}

   	} // End first name Valid
   	if (isset($lastname)) {
   		
   		$filterLastName = filter_var($lastname , FILTER_SANITIZE_STRING);

   		if (strlen($filterLastName) < 4) {
   			
   			$formErrors[] = "Last Name Is Too Short";
   		}

   	} // End Username Valid
   		if (isset($password) && isset($password2)) {// Start Password Valid
   		

   		if (empty($password) && empty($password2)) {
   			
   			$formErrors[] = "Can Not Be Leave <strong>Password Empty</strong>";
   		}

   		$pass1 = sha1($password);
   		$pass2 = sha1($password2);

   		if ($pass1 !== $pass2) {
   			
   			$formErrors[] = "Password Is Not The same";
   		}
   		

   	}//End Password Valid
   	if (isset($email)) {//Start Email Valid
   		
   		$filterEmail = filter_var($email , FILTER_SANITIZE_EMAIL);

   		if (filter_var($filterEmail , FILTER_VALIDATE_EMAIL) != true) {
   			
   			$formErrors[] = "Your Email Not Valid";
   		}

   	}// End Email Valid
   
   if (empty($formErrors)){

 			$check=	checkItems("userName", "users", $username);

 			if ($check == 1) {
 				
 				$theMsg = '<div class="alert alert-danger">This User Is Already Exist  </div>';
 					redirectHome($theMsg,'back');
 				}else{

				 		// Insert User Info In Database

				 		$stmt = $con->prepare("INSERT INTO 
				 							    users(userName,firstName, lastName, email, password, signUpDate) 
				 								VALUES(:zuser, :zfirst, :zlast, :zemail,:zpass,now())");

				 	 	$stmt->execute(array(
				 	 		'zuser' => $username,
				 	 		'zfirst' => $firstname,
				 	 		'zlast' => $lastname,
				 	 		'zemail'=> $email,
				 	 		'zpass' => $pass1
				 	 		
				 	 	

				 	 	));

				 	 	// Rest Auto Increment Column userID

				 	 	$stmtRestAI = $con->prepare("SET @autoid :=0");
				 	 	$stmtRestAI = $con->prepare("UPDATE users SET id = @autoid :=(@autoid+1)");
				 	 	$stmtRestAI = $con->prepare("ALTER TABLE users AUTO_INCREMENT = 1");


				 	 	$stmtRestAI->execute();


				 		// Echo Success Message
				 		$theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . " Record Inserted" . '</div>';

				 		redirectHome($theMsg,'back');
				 }
 		}
	
   }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='layout/css/all.min.css'>
    <link rel='stylesheet' href='layout/css/all.min.font.css'>
    <link rel='stylesheet' href='layout/css/bootstrap.min.css'>
    <link rel='stylesheet' href='layout/css/bootstrap-grid.min.css'>
    <link rel="stylesheet" href="layout/css/backend.css">
</head>
<body class="oc-back">
	    	<div class="the_Errors text-center">
		<?php

		if (!empty($formErrors)) {
			foreach ($formErrors as $error) {
			
			echo "<div class='alert alert-primary'>";
				echo $error;

			echo "</div>";
		}
		}



		?>
	</div>
    <div class="container-form">
        <div class="co-form">    
        <h2><span class="active" data-class="login">Login</span> | <span data-class="signup">Signup</span></h2>
        <form class="login form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-content">
                <label class="form-label" for="username">Username</label>
                <input type="text" name="username" >
            </div>
            <div class="form-content">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password">
            </div>
            <input type="submit" value="login" name="login">
        </form>
        <form class="signup form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-content">
                <label class="form-label" for="username">Username</label>
                <input type="text" name="username">
            </div>
            <div class="form-content">
                <label class="form-label" for="firstname">First Name</label>
                <input type="text" name="firstname">
            </div>
            <div class="form-content">
                <label class="form-label" for="lastname">Last Name</label>
                <input type="text" name="lastname">
            </div>
            <div class="form-content">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email">
            </div>
            <div class="form-content">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password">
            </div>
            <div class="form-content">
                <label class="form-label" for="password-agin">Confirm Password</label>
                <input type="password" name="password-agin">
            </div>
            <input class="submit" type="submit" value="signup" name="signup">
        </form>
<!--         <a class="facebook" href="#">Signup With Facebook</a>
        <a class="facebook activefb" href="#">Login With Facebook</a> -->
    
    </div>
    </div>

    <script src="layout/js/jquery-3.4.1.min.js"></script>
    <script src="layout/js/frontend.js"></script>
    
</body>
</html>

<?php



?>