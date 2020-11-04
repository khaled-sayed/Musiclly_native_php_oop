<?php


class Album{
	private $con;
	
	function __construct($con)
	{
		$this->con = $con;

		$query = mysqli_query($this->con, "SELECT * FROM albums");
			$album = mysqli_fetch_array($query);

			$this->title = $album['title'];
			$this->artistId = $album['artist'];
			$this->genre = $album['genre'];
			$this->artworkPath = $album['artworkPath'];

	}

	

	private function addAlbum($title, $artist, $genre) {

		$coverPic = 'assets/images/artwork/amr-diab.jpg';

		$query = mysqli_query($this->con, "INSERT INTO albums VALUES ('', '$title', '$artist', '$genre', '$coverPic')");

		return $query;


	}

	public function getTitle() {
			return $this->title;
		}

		public function getArtist() {
			return new Artist($this->con, $this->artistId);
		}

		public function getGenre() {
			return $this->genre;
		}

		public function getArtworkPath() {
			return $this->artworkPath;
		}
}