(function(){
	var manufacturers = document.getElementById("manufacturers");
	var allMakes = (manufacturers)? manufacturers.options.length: 15;
	if(allMakes <= 15){
		var totalColumns = 1;
	}else if(allMakes > 15 && allMakes <=30){
		var totalColumns = 2;
	}else if(allMakes > 30 && allMakes <=45){
		var totalColumns = 3;
	}else if(allMakes > 45 && allMakes <=60){
		var totalColumns = 4;
	}else if(allMakes > 60 && allMakes <=75){
		var totalColumns = 5;
	}
	var columsToString  = totalColumns.toString();
	var setListWidth = totalColumns * 130;
	if($.browser.mozilla){
		$("#makersList").css({"-moz-column-count": columsToString, "width": setListWidth.toString()});
	}
	if($.browser.webkit){
		$("#makersList").css({"-webkit-column-count": columsToString, "width": setListWidth.toString()});
	}
	for(var i = 0; i < allMakes; i++){
		if(manufacturers){
			var grabText = manufacturers.options[i].text;
			var grabValue = manufacturers.options[i].value;
			$("#makesDisplayList").append("<li data-make='"+ grabValue +"'>" + grabText + "</li>");
		}
	}
})();


$(document).ready(function(){
	if(requested == "index"){
		var minCarValueDefault = minCarValue;
		var maxCarValueDefault = maxCarValue;
		var minYearDefault = minyear;
		var maxYearDefault = maxyear;
		var minCarValueLive = minCarValue;
		var maxCarValueLive = maxCarValue;
		var minYearLive = minyear;
		var maxYearLive = maxyear;
	}else if(requested == "results"){
		var minCarValueDefault = minCarValue;
		var maxCarValueDefault = maxCarValue;
		var minYearDefault = minyear;
		var maxYearDefault = maxyear;
		var minCarValueLive = minCarValueReq;
		var maxCarValueLive = maxCarValueReq;
		var minYearLive = minyearReq;
		var maxYearLive = maxyearReq;
		fillModels();
	}else if(requested == "bycat"){
		var minCarValueDefault = minCarValue;
		var maxCarValueDefault = maxCarValue;
		var minYearDefault = minyear;
		var maxYearDefault = maxyear;
		var minCarValueLive = minCarValue;
		var maxCarValueLive = maxCarValue;
		var minYearLive = minyear;
		var maxYearLive = maxyear;
	}else if(requested == "basic"){
		var minCarValueDefault = minCarValue;
		var maxCarValueDefault = maxCarValue;
		var minYearDefault = minyear;
		var maxYearDefault = maxyear;
		var minCarValueLive = minCarValue;
		var maxCarValueLive = maxCarValue;
		var minYearLive = minyear;
		var maxYearLive = maxyear;
	}
	$( "#priceRange" ).slider({
		animate: true,
		start: function(event, ui){
			$("#priceRange .bubble").fadeIn(500);
		},
		stop: function(event, ui){
			$("#priceRange .bubble").fadeOut(500);
			if(requested == "results" || requested == "bycat" || requested == "basic"){
				liveResults(requested);
			}
		},
		range: true,
		min: minCarValueDefault,
		max: maxCarValueDefault,
		values: [ minCarValueLive, maxCarValueLive],
		step: 500000,
		slide: function( event, ui ) {
			$( "#minamount" ).val( ui.values[ 0 ] );
			$( "#minAmountDisplay" ).text(formatCurrency(ui.values[ 0 ]));
			$( "#maxamount" ).val( ui.values[ 1 ] );
			$( "#maxAmountDisplay" ).text( formatCurrency(ui.values[ 1 ]) );
			$("#priceRange a .bubble").first().html( "&#8353;" + formatCurrency(ui.values[ 0 ]) ).append("<span class='arrow'></span></div>");
			$("#priceRange a .bubble").last().html( "&#8353;" + formatCurrency(ui.values[ 1 ]) ).append("<span class='arrow'></span></div>");
		}
	});
	$( "#minamount" ).val( $( "#priceRange" ).slider( "values", 0 ) );
	$( "#minAmountDisplay" ).text(formatCurrency( $( "#priceRange" ).slider( "values", 0 ) ) );
	$( "#maxamount" ).val( $( "#priceRange" ).slider( "values", 1 ) );
	$( "#maxAmountDisplay" ).text( formatCurrency( $( "#priceRange" ).slider( "values", 1 ) ) );
	$("#priceRange a").first().append("<div class='bubble' id='tipLeft'>&#8353;" + formatCurrency($( "#priceRange" ).slider( "values", 0 )) + "<span class='arrow'></span></div>");
	$("#priceRange a").last().append("<div class='bubble' id='tipRight'>&#8353;" + formatCurrency($( "#priceRange" ).slider( "values", 1 )) + "<span class='arrow'></span></div>");
	
	$( "#yearRange" ).slider({
		animate: true,
		start: function(event, ui){
			$("#yearRange .bubble").fadeIn(500);
			},
		stop: function(event, ui){
			$("#yearRange .bubble").fadeOut(500);
			if(requested == "results" || requested == "bycat" || requested == "basic"){
				liveResults(requested);
			}
		},
		range: true,
		min: minYearDefault,
		max: maxYearDefault,
		values: [ minYearLive, maxYearLive ],
		step: 1,
		slide: function( event, ui ) {
			$( "#yearstart" ).val( ui.values[ 0 ] );
			$( "#yearend" ).val( ui.values[ 1 ] );
			$("#yearRange a .bubble").first().text( ui.values[ 0 ] ).append("<span class='arrow'></span></div>");
			$("#yearRange a .bubble").last().text(  ui.values[ 1 ] ).append("<span class='arrow'></span></div>");
		}
	});
	$( "#yearstart" ).val( $( "#yearRange" ).slider( "values", 0 ) );
	$( "#yearend" ).val( $( "#yearRange" ).slider( "values", 1 ) );
	$("#yearRange a").first().append("<div class='bubble' id='tipLeft'>&cent;" + $( "#yearRange" ).slider( "values", 0 ) + "<span class='arrow'></span></div>");
	$("#yearRange a").last().append("<div class='bubble' id='tipRight'>&cent;" + $( "#yearRange" ).slider( "values", 1 ) + "<span class='arrow'></span></div>");
	
	$("input#make").focus(function(){
		$("div#makersList").fadeIn("fast");
		$("div#validateBubble").hide();
	});
	$("input#make").blur(function(){
		$("div#makersList").fadeOut("fast");	
	});
	$("input#model").focus(function(){
		$("div#modelsList").fadeIn("fast");
		$("div#validateBubble").hide();
	});
	$("input#model").blur(function(){
		$("div#modelsList").fadeOut("fast");	
	});
	$("input#make").bind("keyup focus", function(){
		var userMake = $(this).val();
		var stringLen = userMake.length;
		var allMakesList = document.getElementById("makesDisplayList");
		var allMakesCount = allMakesList.children.length;
		for(var i = 0 ; i < allMakesCount; i++){
			var pattern = new RegExp("^" + userMake,"gi");
			var selectedMake = allMakesList.children[i].innerHTML;
			var result = pattern.test(selectedMake);
			var changeLook = allMakesList.children[i];
			if(result && stringLen > 0){
				changeLook.style.opacity = 1;
				changeLook.style.fontWeight = "bold";
			}else if(!result){
				changeLook.style.opacity = 0.3;
				changeLook.style.fontWeight = "normal";
			}else if(stringLen === 0){
				changeLook.style.opacity = 1;
				changeLook.style.fontWeight = "normal";
			}
		}
	});
	$("input#model").bind("keyup focus", function(){
		var userModel = $(this).val();
		var stringLen = userModel.length;
		var allModelsList = document.getElementById("modelsDisplayList");
		var allModelsCount = allModelsList.children.length;
		for(var i = 0 ; i < allModelsCount; i++){
			var pattern = new RegExp("^" + userModel,"gi");
			var selectedModel = allModelsList.children[i].innerHTML;
			var result = pattern.test(selectedModel);
			var changeLook = allModelsList.children[i];
			if(result && stringLen > 0){
				changeLook.style.opacity = 1;
				changeLook.style.fontWeight = "bold";
			}else if(!result){
				changeLook.style.opacity = 0.3;
				changeLook.style.fontWeight = "normal";
			}else if(stringLen === 0){
				changeLook.style.opacity = 1;
				changeLook.style.fontWeight = "normal";
			}
		}
	});
	$("ul#makesDisplayList li").click(function(){
		$("#loadingPng").fadeIn("fast");
		var carMake = $(this).text();
		$("input#make").val(carMake);
		$("input#model").val("");
		var values = {make: carMake}
		$.ajax({
			url: "/ajax/ajaxmodels",
			type: 'POST',
			data: values,
			success: function(passed){
				if(passed){
					$("select#carModels").html(passed);
					var loadmodels = fillModels();
					if(loadmodels){
						$("#loadingPng").delay(1000).fadeOut("fast");
					}
				}else{
					$("div#modelsList ul").html("No se han encontrado modelos!");
				}
			}
		});
		$("input#model").removeAttr("disabled");
	});
	
	$("ul#modelsDisplayList li").live("click", function(){
		var carModel = $(this).text();
		$("input#model").val(carModel);
		if(requested){
			liveResults(requested);
		}
	});
	
	//$("input#submit").click(function(){
	//	var defaultString = "/resultados/anuncios/";
	//	var buildUrlMake = $("input#make").val();
	//	var buildUrlModel = $("input#model").val();
	//	var buildUrl = defaultString+buildUrlMake+"_"+buildUrlModel;
	//	$("form#quickSearch").attr("action", buildUrl);
	//	return true;
	//});
		
});// ready ends

function fillModels(){
	var models = document.getElementById("carModels");
	var allModels = models.options.length;
	if(allModels < 15){
		var totalColumns = 1;
	}else if(allModels > 15 && allModels <=30){
		var totalColumns = 2;
	}else if(allModels > 30 && allModels <=45){
		var totalColumns = 3;
	}else if(allModels > 45 && allModels <=60){
		var totalColumns = 4;
	}else if(allModels > 60 && allModels <=75){
		var totalColumns = 5;
	}
	var columsToString  = totalColumns.toString();
	var setListWidth = totalColumns * 150;
	if($.browser.mozilla){
		$("#modelsList").css({"-moz-column-count": columsToString, "width": setListWidth.toString()});
	}
	if($.browser.webkit){
		$("#modelsList").css({"-webkit-column-count": columsToString, "width": setListWidth.toString()});
	}
	$("#modelsDisplayList").children("li").remove();
	for(var i = 0; i < allModels; i++){
		var grabText = models.options[i].text;
		var grabValue = models.options[i].value;
		$("#modelsDisplayList").append("<li data-make='"+ grabValue +"'>" + grabText + "</li>");
		$("ul#modelsDisplayList li").bind("click", function(){
			console.log("event added");
		});
	}
	return true;
}

function liveResults(requested){
	if(requested === "basic"){
		var ajaxCall = "/ajax/anuncio_basico";
	}else{
		var ajaxCall = "/ajax/anuncios";
	}
	var makeLiveValue = $("input#make").val();
	var modelLiveValue = $("input#model").val();
	var minLiveAmount = $("input#minamount").val();
	var maxLiveAmount = $("input#maxamount").val();
	var yearStartLive = $("input#yearstart").val();
	var yearEndLive = $("input#yearend").val();
	var values = {
		make: makeLiveValue,
		model: modelLiveValue,
		minamount: minLiveAmount,
		maxamount: maxLiveAmount,
		yearstart: yearStartLive,
		yearend: yearEndLive
	}
	if(makeLiveValue.length == 0){
		var makeError = $("input#make").attr("data-error");
		var makePosition = $("input#make").offset();
		$("span#errorMessage").text(makeError);
		$("div#validateBubble").css({"left": + makePosition.left , "top": + (makePosition.top - +55)}).fadeIn("fast");
		return false;
	}else if(modelLiveValue.length == 0){
		var modelError = $("input#model").attr("data-error");
		var modelPosition = $("input#model").offset();
		$("span#errorMessage").text(modelError);
		$("div#validateBubble").css({"left": + modelPosition.left , "top": + (modelPosition.top - +55)}).fadeIn("fast");
		return false;
	}else{
		$("div.carThumbWrapper div.carThumb").remove();
		$("div.serverError").remove();
		//$("img#loaderBar").fadeIn("fast");
		if(requested != "index"){
			$('#overlay').fadeIn('fast');
		}
		$.ajax({
			url: ajaxCall,
			type: 'POST',
			data: values,
			success: function(passed){
				if(passed){
					$("div.carThumbWrapper").show().append(passed);
					var countResults = $("div.ajaxFadeIn").length;
					$("#resultCounter").html("Encontr&eacute; " + countResults + " " + makeLiveValue + " " + modelLiveValue);
					$("#pagination").hide();
					$("div.ajaxFadeIn").each(function(index) {
						$(this).delay(250*index).fadeIn(200);
					});
					$('#overlay').delay(2000).fadeOut();
				}else{
					$("div.carThumbWrapper").append("no hay resultados");
					return false;
				}
			}
		});
	}
	//$("img#loaderBar").delay(500).fadeOut("fast");
}