<?php
	
	function getTitle (){

		global $getTitle;
		if (isset($getTitle)){
			echo $getTitle;
		} else {

			echo "Defult";
		}
	}

	/*

		Home Redirect Function [This Function Accept Parametrs]
		$errorMessage = Echo The Error Message
		$seconds = Seconds Before Redirecting

	*/

		function redirectHome($theMessage,$url = null, $seconds = 3){
			if ($url === null) {
				
				$url = 'index.php';
			} else {
				if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !=='') {
					
					$url =$_SERVER['HTTP_REFERER'];
				}else {
					$url = 'index.php';
				}
			  
			} 

			

			echo $theMessage;
			echo '<div class="alert alert-info">You Will Be Redirected To Home  After'. $seconds . 'seconds</div>';
			header('refresh:'.$seconds.';url='.$url);
			exit();
		}

	/*
		Check Item Function
		Function To Check Item In Database
		$Select = The Item To Select [Example : user,Item, category]
		$from   = The Table To Select From [Example : users , Items , Categories ]
		$value = The Value Of Select [Example : khaled , Box , Electronics]
	*/



		function checkItems($select, $from, $value) {
			
			global $con;

			$statmemt = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

			$statmemt->execute(array($value));

			$count = $statmemt->rowCount();

			return $count;
		}

		/* 
			Count Number Of Items 

		*/

			function countNumber($select,$from) {
				global $con;

				$stmt2 = $con->prepare("SELECT COUNT($select) FROM $from");

			    $stmt2->execute();

			    return $stmt2->fetchColumn();
			}

			/* 
				Count Number Of Panding 

			*/

			function countNumberOfPand($select,$from) {
				global $con;
			   	$stmt3 = $con->prepare("SELECT COUNT($select) FROM $from WHERE $select = 0");

			    $stmt3->execute();


			    return $stmt3->fetchColumn();

			  
			}

			/* 
				Get Latets Recordes Function

			*/

			function getLatest($select,$table, $order, $limit = 5) {
				global $con;
			   	$getStatment = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");

			    $getStatment->execute();

			    $rows = $getStatment->fetchAll();


			    return $rows;

			  
			}			
