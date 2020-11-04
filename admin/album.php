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
    <label for="Title">Title For Album</label>
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
    <label for="exampleFormControlFile1">Album Cover</label>
    <input type="file" name="cover" class="form-control-file" id="exampleFormControlFile1">
  </div>
  <input type="submit" class="btn btn-primary" name="New Album" value="Add new album">
</form>	
</div>





<?php

	
} elseif ($do == 'Insert') {
		
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				echo "<h1 class='text-center member-h1'>Add Album</h1>";
			 	echo "<div class='container'>";

				 	$coverName = $_FILES['cover']['name'];
				 	$coverSize = $_FILES['cover']['size'];
				 	$coverTmp = $_FILES['cover']['tmp_name'];
				 	$coverType = $_FILES['cover']['type'];

				 	// List Of Allowed File Type To Upload

				 	$coverExtension = array('jpeg', 'jpg');

				 	// Get Avatar Extention
				 	$coverExtensionAllow = explode('.', $coverName);
			 		$endCoverExtention = strtolower(end($coverExtensionAllow));

		 		// Get Varibles From The Form
		 		$title = $_POST['title'];
		 		$genre = $_POST['genre'];
		 		$artist = $_POST['artist'];
		 		


		 		// Validate The Form

		 		$FormErroes = array();

		 		if (empty($title)) {
		 			$FormErroes[] = 'Title Can Not Be Empty';
		 		}
		 		if ($genre == 0) {
		 			$FormErroes[] = 'You Must Choose Genre';
		 		}
		 		if ($artist == 0) {
		 			$FormErroes[] = 'You Must Choose Artist';
		 		}

		 		foreach ($FormErroes as $Error) {
		 			echo '<div class="alert alert-danger">' . $Error . '</div>';
		 		}
		 		if (! in_array($endCoverExtention , $coverExtension)){
				 		$FormErroes[] = 'This Extention Is Not Allowed';
				 	}
				 	if (empty($coverName)) {
			 			$FormErroes[] = 'Cover Album Is Required';
			 		}

		 		if (empty($FormErroes)){

			 			$cover = rand(0,100000) . '_' . $coverName;

			 			move_uploaded_file($coverTmp, 'uploads\imagesAlbums\\' . $cover);

					 		// Insert User Info In Database

					 	$stmt = $con->prepare("INSERT INTO albums(title, artist, genre, artworkPath) VALUES(:ztitle, :zartist, :zgenre, :zartwork)");

								 	$stmt->execute(array(

								 		'ztitle' => $title,
								 		'zartist' => $artist,
								 		'zgenre' => $genre,
								 		'zartwork' => $cover,
								 		

								 	));

					 	// Rest Auto Increment Column userID

					 	 	$stmtRestAI = $con->prepare("SET @autoid :=0");
					 	 	$stmtRestAI = $con->prepare("UPDATE albums SET id = @autoid :=(@autoid+1)");
					 	 	$stmtRestAI = $con->prepare("ALTER TABLE albums AUTO_INCREMENT = 1");


					 	 	$stmtRestAI->execute();


					 		// Echo Success Message
					 		$theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . " Record Inserted" . '</div>';

					 		// redirectHome($theMsg,'back');
							
		 		}


		 	} else {
		 		$theMsg = "<div class ='alert alert-danger'>You Can not Browse This Page</div>";
		 		redirectHome($theMsg);

			}

			echo "</div>";
			



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