<?php
	class per {

		private $conn;
		private $rows;
		private $id;
		private $firstName;
		private $lastName;

		public function __connstruct($conn, $id) {
			$this->conn = $conn;
			$this->id = $id;

			$query = mysqli_query($this->conn, "SELECT * FROM users WHERE id='$this->id'");

			$this->rows= mysqli_fetch_array($query);

			$this->firstName = $this->rows['firstName'];
			$this->lastName = $this->rows['lastName'];
		}
		public function getFirstName () {
			return $this->firstName;
		}	
		public function getLastName () {
			return $this->lastName;
		}



	}
?>