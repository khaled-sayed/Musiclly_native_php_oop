<?php
	class User {

		private $conn;
		private $username;
		private $firstName;

		public function __connstruct($conn, $username) {
			$this->conn = $conn;
			$this->username = $username;
		}
		public function getUsername () {
			return $this->username;
		}

		public function getFirstName () {
			$query = mysqli_query($conn, "SELECT * FROM users WHERE userName='$this->username'");
			$row = mysqli_fetch_array($query);

			$firstName = $row['firstName'];

			return $this->firstName;
		}


	}
?>