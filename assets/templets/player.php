<?php
$path = 'assets/images/artwork/'; 

if (isset($_GET['id'])) {
	$song = $_GET['id'];
	$songQuery = mysqli_query($conn, "SELECT * FROM songs WHERE album = '$song'");
	$resultArray = array();
}

while ($row = mysqli_fetch_array($songQuery)) {

	array_push($resultArray, $row['id']);
	
	$jsonArray = json_encode($resultArray);
}?>
<script>
	var repeat = false;
$(document).ready(function (){
var newPlaylist = <?php echo $jsonArray; ?>;	
audioElement = new Audio();

setTrack(newPlaylist[0], newPlaylist, false);
updateVolumeProgressBar(audioElement.audio);

$(".progrees-bar").mousedown(function(){
	mouseDown = true;
});

$(".progrees-bar").mousemove(function(e){

	if(mouseDown == true){
		timeFormatOffset(e, this);
	}

});

$(".progrees-bar").mouseup(function(e){

	timeFormatOffset(e, this);

});

$(".progressVol").mousedown(function(){
	
	mouseDown =true;

});
$(".progressVol").mousemove(function(e){
	if(mouseDown == true){
		var percentag = e.offsetX / $(this).width();

		if (percentag >= 0 && percentag <= 1){

			audioElement.audio.volume = percentag;
		}
	}

});

$(".progressVol").mouseup(function(e){

	var percentag = e.offsetX / $(this).width();

		if (percentag >= 0 && percentag <= 1){

			audioElement.audio.volume = percentag;
		}

});

$(document).mouseup(function(){
	mouseDown = false;
});






});


// Set progrees on bar
function timeFormatOffset(mouse , progreesBar) {

    const percentag = mouse.offsetX / $(progreesBar).width() * 100;
    const seconds = audioElement.audio.duration * (percentag /100);

    audioElement.setTime(seconds);
}


function setTrack(trackId, newPlaylist, play) {

			if (newPlaylist != currentPlaylist) {
				currentPlaylist = newPlaylist;
				shufflePlayList = currentPlaylist.slice();

				shuffleArray(shufflePlayList);
			}
			if (shuffle == true) {
				currentIndex = shufflePlayList.indexOf(trackId);
			}else {
				currentIndex = currentPlaylist.indexOf(trackId);
			}


		pauseSong();
	
	$.post("assets/handlers/ajax/getSongJson.php", {songId: trackId}, function(data){
		var track = JSON.parse(data);


		$(".nameSong").text(track.title);
		$.post("assets/handlers/ajax/getArtistJson.php", {artistId: track.artist}, function(data){

			var artist = JSON.parse(data);
			
			$(".nameArt").text(artist.name);
		});

		$.post("assets/handlers/ajax/getAlbumJson.php", {albumId: track.album}, function(data){ 
			var album = JSON.parse(data);

			$(".cover").attr("src","assets/images/artwork/"+album.artworkPath);

		});

		audioElement.setTrack(track);
	});

	if (play == true) {
	audioElement.play();
	}
}

function playSo () {

	if (audioElement.audio.currentTime == 0) {
		console.log('Time Updated');
	}else {
		console.log('No Update');
	}

	audioElement.play();
}

function pause () {
	audioElement.pause();
}

function nextSong () {

	if (repeat == true) {
		audioElement.setTime(0);
		playSong();
		return;
	}

	if (currentIndex == currentPlaylist.length - 1) {
		currentIndex = 0;
	} else {
		currentIndex++;
	}

	var trackToPlay = shuffle ? shufflePlayList[currentIndex] : currentPlaylist[currentIndex];

	setTrack(trackToPlay, currentPlaylist , true);
}


function prevSong () {
	if (audioElement.audio.currentTime >= 3 || currentIndex == 0){
		audioElement.setTime(0);
	} else {
		currentIndex = currentIndex - 1;
		setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
	}
}

function setRepeat() {
	repeat == !repeat;
}

function setMute() {
	audioElement.audio.muted == !audioElement.audio.muted;

	var imgMute = audioElement.audio.muted ? "fa fa-volume-off fa-lg": "fa fa-volume-up fa-lg";
	$('button.volClick i.fa').attr('class', imgMute);
}

function setShuffle() {
	
	if (shuffle == true) {
		// Randmoized Playlist
		shuffleArray(shufflePlayList);
		currentIndex = shufflePlayList.indexOf(audioElement.currentlyPlaying.id);
	} else {
		currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
	}
}


function shuffleArray(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}
</script>
<!-- Music Player -->
    <div class="footer-player" id="music-container">
    	<div class="row">
            <div class="img-cover col-12 col-xl-4 col-md-3 pt-5">
                <img class="cover col-4" src="folder.jpg" alt="">
                <span class="nameArt "></span>
                <span class="nameSong col-12"></span>
            </div>

                <div class="player-music col-12 col-xl-4 col-md-5 pt-3">
                	<div class="btn-player pb-3">
                    <button onclick="prevSong()"><i class="fa fa-step-backward fa-lg" aria-hidden="true"></i></button>
                    <button id="play"><i class="fa fa-play fa-2x" aria-hidden="true"></i></button>
                    <button onclick="nextSong()"><i class="fa fa-step-forward fa-lg" id="next" aria-hidden="true"></i></button>
                </div>


                <div class="progrees-bar">
                    <div class="progrees" id="progrees"></div>  
            <div class="timeStamp"></div>
            <span class="timeCurrent">00.00</span>
            <span class="timeFull">00.00</span>
            
            </div>
                </div>

                <div class="other-control col-12 col-xl-2 col-md-4 text-right pt-5">
                    <!-- <button onclick="setShuffle()"><i class="fa fa-random fa-lg" aria-hidden="true"></i></button> -->
                    <button onclick="setMute()" class="volClick"><i class="fa fa-volume-up fa-lg" aria-hidden="true"></i></button>
                    <div class="progressVol">
                    	<div class="progressV"></div>
                    </div>
<!--                     <button><i class="fa fa-volume-down fa-lg" aria-hidden="true"></i></button>
                    <button><i class="fa fa-volume-off fa-lg" aria-hidden="true"></i></button> -->
                </div>

</div>
    </div>


    <!-- Music Player For Mob -->
    <div class="footer-player-min">
    	<div class="row">
    		   <div class="img-cover col-8">
                <img class="cover" src="folder.jpg" alt="">
                <span class="nameArt "></span>
                <span class="nameSong"></span>
            </div>
            <div class="up col-4 text-right">
            	<i class="fa fa-arrow-up" aria-hidden="true"></i>
            </div>
    	</div>	
    </div>

<!-- Music Playe Mobile -->
<div class="player-mid text-center" id="music-container-mid">
<div class="container">
		<div class="slideDown">
			<i class="fa fa-arrow-down" aria-hidden="true"></i>
		</div>
	            <div class="content-info">
	                <img class="cover" src="folder.jpg" alt="">
	                <span class="nameArt" style="display: block;"></span>
	                <span class="nameSong" style="display: block;"></span>
            </div>

                <div class="player-music">
                	<div class="btn-player pb-3">
                    <button onclick="prevSong()"><i class="fa fa-step-backward fa-lg" aria-hidden="true"></i></button>
                    <button id="playmid" onclick="play()" ><i class="fa fa-play fa-2x" aria-hidden="true"></i></button>
                    <button onclick="nextSong()"><i class="fa fa-step-forward fa-lg" id="next" aria-hidden="true"></i></button>
                </div>


                <div class="progrees-bar">
                <div class="progrees" id="progreesMid"></div>  
	            <div class="timeStamp"></div>
	            <span class="timeCurrent">00.00</span>
	            <span class="timeFull">00.00</span>
            
            </div>
                </div>

                <div class="other-control">
                    <!-- <button onclick="setShuffle()"><i class="fa fa-random fa-lg" aria-hidden="true"></i></button> -->
                    <button onclick="setMute()" class="volClick"><i class="fa fa-volume-up fa-lg" aria-hidden="true"></i></button>
                    <div class="progressVol">
                    	<div class="progressV"></div>
                    </div>
<!--                     <button><i class="fa fa-volume-down fa-lg" aria-hidden="true"></i></button>
                    <button><i class="fa fa-volume-off fa-lg" aria-hidden="true"></i></button> -->
                </div>
</div>
</div>

    <script>
	var playBtn = document.getElementById('play');
	var playBtnMid = document.getElementById('playmid');
	var musicContainer = document.getElementById('music-container');
	var musicContainerMid = document.getElementById('music-container-mid');
	var progreesBar = document.getElementById('progrees-bar');

function playSong() {
	if (audioElement.audio.currentTime == 0) {
		$.post('assets/handlers/ajax/updatePlays.php', { songId: audioElement.currentlyPlaying.id});
	}
	musicContainer.classList.add('play');
	musicContainerMid.classList.add('play');
	playBtn.querySelector('i.fa').classList.remove('fa-play');
	playBtnMid.querySelector('i.fa').classList.remove('fa-play');
    playBtn.querySelector('i.fa').classList.add('fa-pause');
    playBtnMid.querySelector('i.fa').classList.add('fa-pause');
 	playBtn.querySelector('i.fa').classList.add('active');
 	playBtnMid.querySelector('i.fa').classList.add('active');
    audioElement.play();
}

function pauseSong() {
	musicContainer.classList.remove('play');
	musicContainerMid.classList.remove('play');
    playBtn.querySelector('i.fa').classList.add('fa-play');
    playBtnMid.querySelector('i.fa').classList.add('fa-play');
    playBtn.querySelector('i.fa').classList.remove('fa-pause');
    playBtnMid.querySelector('i.fa').classList.remove('fa-pause');
    audioElement.pause();
}

function play() {
	const isplaying = musicContainer.classList.contains('play');
	const isplayingMid = musicContainerMid.classList.contains('play');

	if (isplaying || isplayingMid) {
		pauseSong();
	}else {
		playSong();
	}
}

playBtn.addEventListener('click', play);

// Set progrees on bar
function setProgrees(e) {
    const width = this.clientWidth;

    const clickX = e.offsetX;
    const duration = audio.duration;

    audio.currentTime = (clickX / width) * duration;
}

</script>