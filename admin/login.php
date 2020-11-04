<?php
session_start();
$getTitle = 'Welcome To Login';
include 'ini.php';
include 'assets/script/Account.php';
include 'assets/script/constants.php';



$account = new Account($con);


include 'assets/login-handler.php';

if (isset($_SESSION['userLoggedIn'])) {
	header("location: index.php");
}

?>
<div class="container-form">
    <form id="form" class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <h2>Admin Login</h2>
        <div class="form-control-login">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" placeholder="Enter Username">
            <small></small>
        </div>
        <div class="form-control-login">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Enter password">
            <small></small>
        </div>
        <input id="submit" class="btn-submit" type="Submit" name="login" value="login">
    </form>
</div>  

<style type="text/css">
	body{
    background-color: #f9fafb;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
}
</style>
<?php include $temp.'footer.php'; ?>