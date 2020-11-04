<?php
include 'assets/script/mp3.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['uploadSongs'])) {

				echo "<h1 class='text-center member-h1'>Add song</h1>";
			 	echo "<div class='container'>";





		 		// Get Varibles From The Form
		 		// $title = $_POST['title'];
		 		$genre = $_POST['genre'];
		 		$artist = $_POST['artist'];
		 		$album = $_POST['album'];





// File count
$fileCount = count($fileName = $_FILES['song']['name']);

	for ($i=0; $i < $fileCount; $i++) { 

				 	$songName = $_FILES['song']['name'][$i];
				 	$songSize = $_FILES['song']['size'][$i];
				 	$songTmp = $_FILES['song']['tmp_name'][$i];
				 	$songType = $_FILES['song']['type'][$i];
				 	$songError = $_FILES['song']['error'][$i];
				 	$pathUp = "uploads/albums"; 

				 	// List Of Allowed File Type To Upload

				 	$songExtension = array("mp3", "ogg", "flac");

				 	// Get Song Extention
				 	$songExtensionAllow = explode('.', $songName[$i]);
			 		$endSongExtention = strtolower(end($songExtensionAllow));

 				 		// Validate The Form

				 		$FormErroes = array();

				 		// if (empty($title)) {
				 		// 	$FormErroes[] = 'Title Can Not Be Empty';
				 		// }
				 		if ($genre == 0) {
				 			$FormErroes[] = 'You Must Choose Genre';
				 		}
				 		if ($album == 0) {
				 			$FormErroes[] = 'You Must Choose Album';
				 		}
				 		if ($artist == 0) {
				 			$FormErroes[] = 'You Must Choose Artist';
				 		}
				 		if (in_array($endSongExtention, $songExtension)) {
				 			$FormErroes[] = 'You Must End Extention .mp3 or .ogg or .flac';
				 		}
				 		if ($songError[$i] == 4) {
				 			$FormErroes[] = 'You Must Choose Songs';
				 		}


				 		foreach ($FormErroes as $Error) {
				 			echo '<div class="alert alert-danger">' . $Error . '</div>';
				 		}



		 			if (!empty($FormErroes)){

				 			foreach ($FormErroes as $Error) {
				 				
				 				echo "<div class='alert alert-danger'>". $Error."</div>";
				 			} 


				 		}else {



		 			move_uploaded_file($songTmp[$i], '\uploads\musics\\' . $songName[$i]);

			 			// Song Duration
			 		$f = 'uploads\musics\\'.$songName[$i];

					$m = new mp3file($f);
					$a = $m->get_metadata();

					if ($a['Encoding']=='Unknown')
					    echo "?";
					else if ($a['Encoding']=='VBR')
					   $len= $a['Length mm:ss'];
					else if ($a['Encoding']=='CBR')
					$len= $a['Length mm:ss'];


		 				// Insert User Info In Database

					 	$stmt = $con->prepare("INSERT INTO songs(title, artist, album, genre, duration,songPath) VALUES(:ztitle, :zartist, :zalbum, :zgenre, :zduration,:zpath)");

								 	$stmt->execute(array(

								 		'ztitle' => $fileName[$i],
								 		'zartist' => $artist,
								 		'zalbum' => $album,
								 		'zgenre' => $genre,
								 		'zduration' => $len[$i],
								 		'zpath' => $fileName[$i],
								 		

								 	));

					 	// Rest Auto Increment Column userID

					 	 	$stmtRestAI = $con->prepare("SET @autoid :=0");
					 	 	$stmtRestAI = $con->prepare("UPDATE songs SET id = @autoid :=(@autoid+1)");
					 	 	$stmtRestAI = $con->prepare("ALTER TABLE songs AUTO_INCREMENT = 1");


					 	 	$stmtRestAI->execute();


					 		// Echo Success Message
					 		$theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . " Record Inserted" . '</div>';

					 		// redirectHome($theMsg,'back');

		 		}

		 		
}

		 	} else {
		 		$theMsg = "<div class ='alert alert-danger'>You Can not Browse This Page</div>";
		 		redirectHome($theMsg);

			}

			echo "</div>";