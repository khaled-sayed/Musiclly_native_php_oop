<?php

	/*
	===============================================
	= Manage Members Page
	= You Can Add | Edit | Delet Member From Here									
	===============================================
	*/

	session_start();
if(isset($_SESSION['userLoggedIn'])){
	$getTitle = 'Albums'; 
    include 'ini.php';
    include 'assets/function/fun.php';

    include 'assets/script/Album.php';

    // $album = new Album($con);

$do = isset($_GET['do']) ?  $_GET['do']  :'Manage';


if($do == 'Manage'){ //Manage Category Page?>

<div class="container">

	<a class="btn btn-primary" href="?do=Add">Add</a>
		    </div>
	
<?php
} elseif ($do == 'Add') {?>

			<div class="container">
	<form action="?do=Insert" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="Title">Title For Song</label>
    <input type="text" name="title" class="form-control" placeholder="Enter Title">
  </div>
  <div class="form-group">
  	<label for="Title">Artist</label>
  <select class="js-example-basic-single" name="artist">
  	<option value="0">...</option>
  	<?php
  	$stmt = $con->prepare("SELECT * From artists");

  	 $stmt->execute();

  	$query= $stmt->fetchAll();

  	foreach ($query as $row) {
  		echo "<option value='". $row['id'] ."'>";

		echo $row['name'];

		echo "</option>";
 
	}?>


  </select>
  </div>
    <div class="form-group">
  	<label for="Title">Album</label>
  <select class="js-example-basic-single" name="album">
  	<option value="0">...</option>
  	<?php
  	$stmt = $con->prepare("SELECT * From albums");

  	 $stmt->execute();

  	$query= $stmt->fetchAll();

  	foreach ($query as $row) {
  		echo "<option value='". $row['id'] ."'>";

		echo $row['title'];

		echo "</option>";
 
	}?>


  </select>
  </div>
  <div class="form-group">
  	<label for="Title">Genre</label>
  <select class="js-example-basic-single form-control" name="genre">
  	  	<option value="0">...</option>
  	<?php
  	$stmt = $con->prepare("SELECT * From geners");

  	 $stmt->execute();

  	$query= $stmt->fetchAll();

  	foreach ($query as $row) {
  		echo "<option value='". $row['id'] ."'>";

		echo $row['name'];

		echo "</option>";
 
	}?>
  </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1">Song</label>
    <input type="file" name="song[]" class="form-control-file" id="exampleFormControlFile1" multiple>
  </div>
  <input type="submit" class="btn btn-primary" name="uploadSongs" value="Add new song">
</form>	
</div>





<?php

	
} elseif ($do == 'Insert') {
		
	
			

	include 'assets/upload_songs_handler.php';

	} elseif ($do == 'Edit') {
		# code...

		echo "Welcome In Edit";




	} elseif ($do == 'Update') {
		# code...

		echo "Welome In Update";




	} elseif ($do ='Delet') {
		# code...



		echo "Welome In Delet";



	} elseif ($do == 'Active') {
		# code...


		
	}
	 else {
	    header("loaction:index.php");
	    
	}
}

include $temp.'footer.php';
?>