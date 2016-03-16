jQuery(document).ready(function($) {
    $('.my-slider').unslider({
        autoplay:true
    });
});
                       
var bb_video= document.getElementById("bb_video"); 
var vidOn = false; 

$(document).ready(function(){
    $("#btnVideo").click(function(){
        $("#myVideo").modal();
            if(vidOn){
                bb_video.play();
                }
            });
        });

$("#myVideo").on('hide.bs.modal', function () {
    if(!(bb_video.paused)){
        bb_video.pause();
        vidOn=true;
        }
});
  