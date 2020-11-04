<?php

class Album {

		private $conn;
		private $id;
		private $title;
		private $artistId;
		private $genre;
		private $artwork;

		public function __construct($conn, $id) {
			$this->conn = $conn;
			$this->id = $id;


			$Query = mysqli_query($this->conn, "SELECT * FROM albums WHERE id='$this->id'");
			$album = mysqli_fetch_array($Query);

			$this->title = $album['title'];
			$this->artistId = $album['artist'];
			$this->genre = $album['genre'];
			$this->artwork = $album['artworkPath'];
		}

		public function getTitle() {

			return $this->title;
		}
		public function getArtwork() {

			return $this->artwork;
		}
		public function getArtist() {

			return new Artist($this->conn , $this->artistId);
		}
		public function getGenre() {

			return $this->gener;
		}
		public function getNumberOfSoungs() {

			$query = mysqli_query($this->conn, "SELECT * FROM songs WHERE album='$this->id'");

			return mysqli_num_rows($query);
		}
		public function getSongId() {

			$query = mysqli_query($this->conn, "SELECT * FROM songs WHERE album='$this->id' ORDER BY albumOrder ASC");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['id']);
			}

			return $array;
		}
	}




?>