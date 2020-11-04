<?php
session_start();
$getTitle = 'Welcome To Home';
include 'ini.php';
include 'conneSqli.php';


?>
<div id="mainApp" class="container">
	


<h1 class="pageHeadingBig text-center">You Maby Like This</h1>
<div class="gridViewContainer">
<div class='row'>	
	<?php
		$albumQuery = mysqli_query($conn, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");

		while($row = mysqli_fetch_array($albumQuery)) {
			



			echo "<div class='gridViewItem col-xl-3 col-sm-6 col-6 text-center'>
					<a href='album.php?id=" . $row['id'] . "'>
						<img src='assets/images/artwork/" . $row['artworkPath'] . "'>

						<h6 class='gridViewInfo'>"
							. $row['title'] .
						"</h6>
					</a>


				</div>";



		}
	?>
				</div>
</div>

</div>



<?php
include 'assets/templets/footer.php';
 ?>

<style type="text/css">
	h1 {
		padding: 15px;
		margin-bottom: 60px;
		font-family: var(--font-open);
    color: var(--secondary);
    text-transform: uppercase; 
	}
	#mainApp img {
		width: 50%;
		height: 180px;
		/*box-shadow: 5px 7px 9px rgba(0,0,0,.5);*/
    border-radius: 15px;
	}
	@media(max-width: 720px){
    #mainApp img {
        width: 70%;
    	}
	}
	.gridViewItem a{
		background-color: rgba(0,0,0,.5);
		text-decoration: none;
	}
	body {
		background-color: var(--dark-white);
	}
	.gridViewItem {
		margin-bottom: 60px; 
		font-size: 20px
	}
	.navsidebar {
		height: 100vh;
		border-radius: 0;
	}

</style>