var currentPlaylist = [];
var shufflePlayList = [];
var tempPlaylist = [];
var audioElement = 0;
var mouseDown = false;
var currentIndex = 0;
var shuffle = false;
var userLoggedIn;
var timer;
var btn = false;
var path = "admin/uploads/musics/";
var progrees = document.getElementById('progrees');

var body = document.getElementsByTagName("body");


$(window).scroll(function(){
	var wsc = $(window).scrollTop();
	if (wsc >= 112) {
		$(".footer-player").css("position", "relative");
		$(".footer-player-min").css("position", "relative");
	} else {
		$(".footer-player").css("position", "fixed");
		$(".footer-player-min").css("position", "fixed");
	}
});

$(window).resize(function(){

	var wid = $(window).resize().width();

	if (wid <= 1720) {
		$(".footer-player").css("display", "none");
		$(".footer-player-min").css("display", "block");
		$(".navbar").show();

	} else {
		$(".footer-player").css("display", "block");
		$(".footer-player-min").css("display", "none");
		$(".player-mid").css("display", "none");
		$(".navbar").hide();
	}

});

$(window).ready(function(){
		var wid = $(window).width();

	if (wid <= 1720) {
		$(".footer-player").css("display", "none");
		$(".footer-player-min").show();

	} else {
		$(".footer-player").css("display", "block");
		$(".footer-player-min").css("display", "none");
		$(".player-mid").css("display", "none");
	}
});


$(document).ready(function(){
	var player = $(".footer-player-min");

	player.on("click", function(){
		$(this).hide(100, function(){
			$(".navbar").hide();
			$(".player-mid").show();
			$(window).scrollTop(0);
			$("body").css("overflow-x", "hidden");
			$("body").css("overflow-y", "hidden");
		});
	});

	var down = $(".slideDown");

	down.on("click", function(){
		var wid = $(window).width();
		var navSid = $(".navsidebar");
		$(".player-mid").hide(100, function(){
			if (navSid.css("transform") == "matrix(1, 0, 0, 1, -250, 0)") {
				$(".navbar").show();

			} else {
				$(".navbar").hide();
			}
			$(".footer-player-min").show();
			$(window).scrollTop(0);
			$("body").css("overflow-x", "hidden");
			$("body").css("overflow-y", "scroll");
		});
	});
});


function openSlid(){
	var btn  = document.getElementById('toggle');
	var nav  = document.getElementById('nav');

	if(btn !== false){
		nav.style.transform = "translateX(0)";
	} else {
		nav.style.transform = "translateX(-100%)";
	}
}

function closeSlid(){
	var btn  = document.getElementById('toggle');
	var nav  = document.getElementById('nav');

	if(btn == false){
		nav.style.transform = "translateX(-100%)";
	}
}

$(document).click(function(e){
	var target = $(e.target);

	if (!target.hasClass("item") && !target.hasClass('fa')) {
		hideOptionMenu();
	}
});
$(window).scroll(function(){

	hideOptionMenu();
});

$(document).on("change", "select.playlist", function(){
	var select = $(this);
	var playlistId = select.val();
	var songId = select.prev(".songId").val();

	$.post("assets/handlers/ajax/addToPlaylist.php", {playlistId: playlistId, songId: songId})
	.done(function(error){

		if (error != "") {
				alert(error);
				return;
			}

		hideOptionMenu();
		select.val("");
	});
});


function openPage(url) {

	if(timer != null) {
		clearTimeout(timer);
	}

	if(url.indexOf("?") == -1) {
		url = url + "?";
	}

	var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
	console.log(encodedUrl);
	$("#mainContent").load(encodedUrl);
	$("body").scrollTop(0);
	history.pushState(null, null, url);
}


function updateInfo(username){
var firstName = document.getElementById("firstname").value;
var lastName = document.getElementById("lastname").value;
var email = document.getElementById("email").value;

$.post("assets/handlers/ajax/updateInfo.php", {firstName: firstName, lastName: lastName, email: email, username: username})
	.done(function(error){

		if (error != "") {
			alert(error);
			return;
		}


		openPage("setting.php");
	});


}

function updatePassword(username){
	var currPassword = document.getElementById('curpassword').value;
	var newPassword = document.getElementById('newpassword').value;
	var newPassword2 = document.getElementById('newpassword2').value;

$.post("assets/handlers/ajax/updatePassword.php", {currPassword: currPassword, newPassword: newPassword, newPassword2: newPassword2, username: username})
	.done(function(error){

		if (error != "") {
			alert(error);
			return;
		}


		openPage("setting.php");
	});


}

function removeFromPlaylist(button, playlistId) {
	var songId = $(button).prevAll(".songId").val();

	$.post("assets/handlers/ajax/removeFromPlaylist.php", {playlistId: playlistId, songId: songId})
	.done(function(error){

		if (error != "") {
			alert(error);
			return;
		}


		openPage("playlist.php?id=" + playlistId);
	});
}

function creatPlaylist () {
	console.log(userLoggedIn);
	var popup = prompt("Inset The Name Of Your Playlist");
	if (popup != null){
		$.post("assets/handlers/ajax/creatPlaylist.php", {name: popup, username: userLoggedIn})
		.done(function(error){

			if (error != "") {
				alert(error);
				return;
			}


			openPage("yourMusic.php");
		});
	}
}

function deletePlaylist(playlistId){
	var prompt = confirm("Are You Sure To delete This Playlist ?");

	if (prompt == true) {
		$.post("assets/handlers/ajax/deletePlaylist.php", {playlistId: playlistId})
		.done(function(error){

			if (error != "") {
				alert(error);
				return;
			}


			openPage("yourMusic.php");
		});
	}
}

function hideOptionMenu(){
	var menu = $('.optionMenu');
	if (menu.css('display') != 'none') {
		menu.css('display', 'none');
	}

}

function showOptionMenu(button) {
	var songId = $(button).prevAll(".songId").val();
	var menu = $('.optionMenu');
	var menuWidth = menu.width();
	menu.find(".songId").val(songId);

	var scrollTop = $(window).scrollTop();

	var elementOffset = $(button).offset().top;

	var top = elementOffset - scrollTop;

	var left = $(button).position().left;
	var num = 24;
	menu.css({'top': top + 'px', 'right': num + '%', 'display': 'inline'});
}

function formatTime(sec) {
	var time = Math.round(sec);
	var min = Math.floor(time / 60);
	var sec = time - (min * 60);

	var extraZero = (sec < 10) ? "0": "";

	return `${min}:${extraZero}${sec}`;
}

function updateTimeProgressBar(audio) {
	$(".timeCurrent").text(formatTime(audio.currentTime));
}

function updateVolumeProgressBar(audio) {
	var volume = audio.volume * 100;
	$(".progreesV").css('width', volume + "%");
}
function playFirstSong () {
	setTrack(tempPlaylist[0], tempPlaylist, false);
}


function Audio() {

	this.currentlyPlaying;
	this.audio = document.createElement('audio');
	this.audio.addEventListener('canplay', function(){
		$("span.timeFull").text(formatTime(this.duration));
	});

	this.audio.addEventListener("ended", function(){
		nextSong();
	});

	this.audio.addEventListener('timeupdate', function(){
		updateTimeProgressBar(this);

	});
	// Progress Update
	this.audio.addEventListener('timeupdate', function(e){
		var {duration, currentTime} = e.srcElement;
    	var progreesPercent = (currentTime / duration) * 100;
    	 document.getElementById('progrees').style.width = `${progreesPercent}%`;
    	 document.getElementById('progreesMid').style.width = `${progreesPercent}%`;
	});

	this.audio.addEventListener("volumechange", function(){
		updateVolumeProgressBar(this);

	});

	this.setTrack = function(track) {
		this.currentlyPlaying = track;
		this.audio.src = "admin/uploads/musics/"+track.songPath;
	}

	this.play = function () {
		this.audio.play();
	}

	this.pause = function () {
		this.audio.pause();
	}

	this.setTime = function (seconds) {
		this.audio.currentTime= seconds;
	}
}
