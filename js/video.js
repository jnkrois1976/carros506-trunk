$(document).ready(function(){
	$("a.play").click(function(event){
		event.preventDefault();
		$(this).hide();
		$("div#video").show();
		//document.getElementById("acuraTL2012").play();
		document.getElementsByTagName('video')[0].play();
	});
	
	$("ul.tabs li a").click(function(){
		//var stopVideo = document.getElementById("acuraTL2012");
		var stopVideo = document.getElementsByTagName("video")[0];
		if(stopVideo.currentTime > 0){
			stopVideo.pause();
			//stopVideo.src = "";
		}
	});
	
});