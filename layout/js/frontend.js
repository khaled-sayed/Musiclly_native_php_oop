var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;

function openPage(url){
    var encodedUrl = encodeURI()
}


function formatTime(seconds) {
    var time = Math.round(seconds);
    var minutes = Math.floor(time / 60); //Rounds down
    var seconds = time - (minutes * 60);

    var extraZero = (seconds < 10) ? "0" : "";

    return minutes + ":" + extraZero + seconds;
}

function updateTimeProgressBar(audio) {
    $(".progressTime.current").text(formatTime(audio.currentTime));
    $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

    var progress = audio.currentTime / audio.duration * 100;
    $(".playbackBar .progress").css("width", progress + "%");
}

function updateVolumeProgressBar(audio) {
    var volume = audio.volume * 100;
    $(".volumeBar .progress").css("width", volume + "%");
}

function Audio() {

    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this.audio.addEventListener("ended", function() {
        nextSong();
    });

    this.audio.addEventListener("canplay", function() {
        //'this' refers to the object that the event was called on
        var duration = formatTime(this.duration);
        $(".progressTime.remaining").text(duration);
    });

    this.audio.addEventListener("timeupdate", function(){
        if(this.duration) {
            updateTimeProgressBar(this);
        }
    });

    this.audio.addEventListener("volumechange", function() {
        updateVolumeProgressBar(this);
    });

    this.setTrack = function(track) {
        this.currentlyPlaying = track;
        this.audio.src = track.path;
    }

    this.play = function() {
        this.audio.play();
    }

    this.pause = function() {
        this.audio.pause();
    }

    this.setTime = function(seconds) {
        this.audio.currentTime = seconds;
    }

}
$(function (){
    'use strict';


    $('.container-form .co-form h2 span').click(function (){
        // console.log($(this).data('class'));
        if ($(this).data('class') == 'login') {
            $(this).addClass('active').siblings().removeClass('active');

        $('.container-form .co-form form').hide();

        $('.' + $(this).data('class')).fadeIn(100);
        $('.container-form').height(670);
        $('.facebook').addClass('activefb').prev().removeClass('activefb');

        } else {

        $(this).addClass('active').siblings().removeClass('active');
          
        $('.container-form .co-form form').hide();

        $('.' + $(this).data('class')).fadeIn(100);
        console.log($('.container-form').height());
        $('.container-form').height(900);
        $('.facebook').addClass('activefb').next().removeClass('activefb');

        }

    });


    $('input').focus(function(){
        $(this).parents('.form-content').addClass('focused');
      });
      
      $('input').blur(function(){
        var inputValue = $(this).val();
        if ( inputValue == "" ) {
          $(this).removeClass('filled');
          $(this).parents('.form-content').removeClass('focused');  
        } else {
          $(this).addClass('filled');
        }
      })  






});

