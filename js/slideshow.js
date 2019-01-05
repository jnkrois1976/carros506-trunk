$(document).ready(function() {
	
	/*$('#slider').nivoSlider({
		effect: 'fade',
		pauseTime: 5000,
		controlNav:false,
		directionNav:true, 
		directionNavHide:true,
		pauseOnHover:true
	});*/ /* remove comments to enable front page slideshow */
	
	$('#sliderCar').nivoSlider({
		effect:'fade', 
		slices:11, 
		animSpeed:200, 
		pauseTime:3000, 
		startSlide:0, 
		directionNav:true, 
		directionNavHide:true, 
		controlNav:true, 
		controlNavThumbs:true, 
		controlNavThumbsFromRel:true, 
		controlNavThumbsSearch: '.jpg', 
		controlNavThumbsReplace: '_thumb.jpg', 
		pauseOnHover:true, 
		manualAdvance:true, 
		captionOpacity:0.8
	});
	
	$("div.nivo-controlNav").wrap("<div id='thumbControlWrapper'></div>");
	
	var totalThumbs = $("div.nivo-controlNav a").length;
	if(totalThumbs > 5){
		$("div#thumbControlWrapper").append("<div class='thumbControl'><span id='uparrow'></span><span id='downarrow'></span>");
	}
	
	$("span#uparrow").click(function(){
		var scrollerWrapper = $("div.nivo-controlNav");
		var renderedHeight = scrollerWrapper.height();
		var negativeRenderedHeight = -renderedHeight;
		var currentPosition = scrollerWrapper.position();
		var amountToScroll = currentPosition.top - 85;
		if(currentPosition.top === 0 || currentPosition.top < 0 && amountToScroll > negativeRenderedHeight){
			scrollerWrapper.animate({top: amountToScroll + "px"});
			$("span#downarrow").css("opacity", "1");
			if((negativeRenderedHeight + 85) === amountToScroll){
				$("span#uparrow").css("opacity", "0.5");
			}
		}
	});
	
	$("span#downarrow").click(function(){
		var scrollerWrapper = $("div.nivo-controlNav");
		var renderedHeight = scrollerWrapper.height();
		var negativeRenderedHeight = -renderedHeight;
		var currentPosition = scrollerWrapper.position();
		var amountToScroll = currentPosition.top + 85;
		if(currentPosition.top === (negativeRenderedHeight + 85) || currentPosition.top < 0 && amountToScroll > negativeRenderedHeight){
			scrollerWrapper.animate({top: amountToScroll + "px"});
			$("span#uparrow").css("opacity", "1");
			if(amountToScroll === 0){
				$("span#downarrow").css("opacity", "0.5");
			}
		}
	});
	
});