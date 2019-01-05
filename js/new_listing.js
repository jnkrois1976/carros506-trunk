var makesObj = new Array();

(function(){
	
	$("#nestedMake").children().each(function(){
		var	makesElem = $(this).text();
		var addMakeElem = makesObj.push(makesElem);
	});
	
	if (window.File && window.FileReader && window.FileList && window.Blob) {
	  $("#selectImage").show();
	  $("#selectImageFallback").remove();
	  $("form#newListingFull").attr("action", "/new_listing/create_full_multiple_post");
	  $("form#newListingDetailed").attr("action", "/new_listing/create_detailed_multiple_post");
	  $("form#newListingSingle").attr("action", "/new_listing/create_basic_multiple_post");
	} else {
	  $("#selectImageFallback").show();
	  $("#selectImage").remove();
	}
	
})();

$(document).ready(function(){
		
	if (window.File && window.FileReader && window.FileList && window.Blob) {
		var imageFiles = document.getElementById('imageFiles');
		if(imageFiles){
			if(fallback == false || fallback == null || fallback == undefined){
				imageFiles.addEventListener('change', handleFileSelect, false);
			}
		}
	}
	
	$("#sellerCat").change(function(){
		var sellerType = $(this).val();
		console.log(sellerType);
		if(sellerType == "AG"){
			$("#dealerNameRow").show();
			$("#dealerName").attr("required", "true");
			$("#dealerName").removeAttr("disabled");
		}else if(sellerType == "PR"){
			$("#dealerNameRow").hide();
			$("#dealerName").removeAttr("required");
			$("#dealerName").attr("disabled", "disabled");
		}
	});
	
	$("#sellerEmailEdit").click(function(){
		$("#sellerEmail").removeAttr("readonly");
		$(this).hide();
	});
	
	$("#sellerPhoneEdit").click(function(){
		$("#sellerPhone").removeAttr("readonly");
		$(this).hide();
	});
	
	$("#carMake").focus(function(){
		var getMakes = $("#makeSuggest");
		var haveMakes = getMakes.children().length;
		if(haveMakes > 0){
			getMakes.fadeIn("fast");
		}
	});
	
	$("#carMake").blur(function(){
		$("#makeSuggest").fadeOut("fast");
		var hasValue = $("#carMake").val();
		var countChar = hasValue.length;
		if(countChar > 0){
			$("#carModel").removeAttr("disabled");
		}
	});
	
	$("#carMake").bind("keyup focus", function(){
		var liveMake = $(this).val();
		var strlen = liveMake.length;
		var showHide = document.getElementById("makeSuggest");
		if(strlen > 0){
			for(var i = 0; i < makesObj.length; i++){
				var pattern = new RegExp("^"+liveMake, "i");
				var compare = pattern.test($.trim(makesObj[i]));
				var targetElem = showHide.children[i];
				if(compare){
					targetElem.style.display = "block";
				}else if(!compare){
					targetElem.style.display = "none";
				}
			}
		}else if(strlen === 0){
			$("li.makeDisplay").show();
		}
	});
	
	$("li.makeDisplay").click(function(){
		var makeDisplay = $(this).text();
		$("#carMake").attr("value", makeDisplay);
		$("#makeSuggest").hide();
		fetchModels();
		$("#carModel").val("");
		$("#carModel").removeAttr("disabled");
		$(".modelDisplay").remove();
	});
	
	$("#carModel").focus(function(){
		var getModels = $("#modelSuggest");
		var haveModels = getModels.children().length;
		if(haveModels > 0){
			getModels.fadeIn("fast");
		}
	});
	
	$("#carModel").blur(function(){
		$("#modelSuggest").fadeOut("fast");
	});
	
	$("#carModel").bind("keyup focus", function(){
		var liveModel = $(this).val();
		var strLenModel = liveModel.length;
		var showHideModel = document.getElementById("modelSuggest");
		if(strLenModel > 0){
			for(var i = 0; i < showHideModel.children.length; i++){
				var pattern = new RegExp("^"+liveModel, "i");
				var compare = pattern.test($.trim(showHideModel.children[i].textContent));
				var targetElem = showHideModel.children[i];
				if(compare){
					targetElem.style.display = "block";
				}else if(!compare){
					targetElem.style.display = "none";
				}
			}
		}else if(strLenModel === 0){
			$("li.modelDisplay").show();
		}
	});
	
	$("li.modelDisplay").live("click", function(){
		var modelDisplay = $(this).text();
		$("#carModel").attr("value", modelDisplay);
		$("#modelSuggest").hide();
	});
	
	/*$("a#adNewFile").click(function(event){
		event.preventDefault();
		var picLimit = $("#picListingCap").val();
		if(picLimit === "C"){
			var picMax = 5;
		}else if(picLimit === "B"){
			var picMax = 10;
		}else if(picLimit === "A"){
			var picMax = 20;
		}
		var movedPics = $("td#movedPics");
		var multiPic = movedPics.children("span").length;
		var singlePic = 1;
		var countChildren = singlePic + multiPic;
		if(countChildren < picMax){
			$('<span id="userfile'+ (countChildren + 1 )+'"><span><input type="file" name="userfile'+ (countChildren + 1 )+'" class="chooseImg" /></span><a href="#" class="delFileInput"><img src="/images/delete.png" /></a></span>').appendTo("#movedPics");
			$("input#totalImagesHidden").val(countChildren + 1);
			$("#reachedMax").hide();
			$("#livePicCount").text(countChildren + 1);
			var newInputName = "input[name='userfile"+(countChildren + 1)+"']";
			if(countChildren >= 1){
				$( "#toggleSelectedPics" ).effect('pulsate', { times: 4}, 500);
			}
			$(newInputName).trigger("click");
		}else{
			$(this).hide();
			$("#reachedMax").show("fast");
		}
	});*/
	
	$("input[name^='userfile']").change(function(){
		var allFileInputs =  $("input[name^='userfile']");
		var totalImages = allFileInputs[0].files.length;
		$('#totalImagesHidden').val(totalImages);
		/*$(allFileInputs).each(function(i){
			var currentInput = $(this).val();
			if(currentInput === null || currentInput === undefined || currentInput === ""){
				return false;
			}else{
				
			}
		});*/
	});
	
	/*$("a#toggleSelectedPics").toggle(function(){
		$(this).html("Ocultar &#9650;")
		$("tr#expandPhotoCount").show();
	}, function(){
		$(this).html("Ver seleccionadas &#9660;")
		$("tr#expandPhotoCount").hide();
	});*/
	
	/*$("a.delFileInput").live("click", function(event){
		event.preventDefault();
		var getWrapper = $("div#chooseFileWrap");
		var countChildren = getWrapper.children("span").length;
		if(countChildren <= 20){
			$("input#totalImagesHidden").val(countChildren - 1);
			$("a#adNewFile").show();
			$("#reachedMax").hide();
		}
		$(this).prev("span").remove();
		$(this).remove();
	});*/
	
	$("input#create").click(function(){
		var allElems = $("[required]");
		var validationPassed = false;
		var validationPassed = validate(allElems);
		if(validationPassed === true){
			$('#postNewAd').dialog('open');
			return true;
		}else{
			return false;
		}
	});
	
	$("[required]").change(function(){
		var currentElem = $(this),
			currentElemParent = currentElem.parents("tr"),
			completedRows = $("tr[data-rowcomplete='true']").length,
			rowElems = currentElemParent.find("[required]"),
			rowElemsCount = rowElems.length,
			rowIsComplete = false;
		$(rowElems).each(function(i){
			var eachElem = $(this),
				eachElemValue = eachElem.val();
			if(eachElemValue.length == 0 || eachElemValue == ""){
				rowIsComplete = "inprogress";
				if(completedRows < 1){
					$("input.create").attr("disabled", "disabled");
				}
				return false;
			}else if(eachElemValue > 0 || eachElemValue != ""){
				rowIsComplete = true;
				if(i === (rowElemsCount - 1)){
					$("input.create").removeAttr("disabled");
				}
			}
		});
		currentElemParent.attr("data-rowcomplete", ""+rowIsComplete+"");
	});
	
	$("input.create").click(function(event){
		event.preventDefault();
		
		var completedRows = $("tr[data-rowcomplete='true']").length;
		if(completedRows == 0){
			var allElems = $("[required]");
		}else if(completedRows >= 1){
			var allElems = $("tr[data-rowcomplete='true'], tr[data-rowcomplete='inprogress']").find("[required]");
		}
		var validationPassed = false;
		var validationPassed = validate(allElems);
		if(validationPassed === true){
			$('#overlay').fadeIn('fast');
			if(completedRows >= 1){
				$("tr[data-rowcomplete='false']").remove();
			}
			listingsObject(completedRows);
			var flattenObject = JSON.stringify(PageModel.MultipleListingValues);
			var values = {listings : flattenObject};
			$.ajax({
				url: "/new_listing/create_dealer_multiple_listing",
				type: 'POST',
				data: values,
				success: function(passed){
					if(passed == "success"){
						console.log(passed);
						$('#overlay').delay(2000).fadeOut();
						window.location = "/profile/content_posted_multiple_listing";
					}else{
						console.log(passed);
						$('#overlay').delay(2000).fadeOut();
						return false;
					}
				}
			});
			return true;
		}else{
			return false;
		}
	});
	
	$("a#imagesModal").click(function(event){
		event.preventDefault();
		$("div#selectImages").show();
		$("div#validateBubble").hide();
	});
	
	$("a#acceptImages").click(function(event){
		event.preventDefault();
		$("div#selectImages").hide();
	});
	
	$("select#sellerProvince").change(function(){
		$("option.newCanton").remove();
		var selectedValue = $(this).val();
		if(selectedValue.length > 0){
			var values = {provincia: selectedValue};
			$.ajax({
				url: "/ajax/cantones",
				type: "POST",
				data: values,
				success: function(passed){
					if(passed == "failed"){
						console.log("failed");
						return false;
					}else{
						$("select#sellerCanton").append(passed).removeAttr("disabled");
						$("#adProvince option").each(function(){
							var defaultValue = $(this).text();
							if(selectedValue == defaultValue){
								$(this).attr("selected", "selected");
							}
						});
					}
				}
			});
		}
	});
	
	$("select#sellerCanton").change(function(){
		$("option.newDistrito").remove();
		var selectedValue = $(this).val();
		if(selectedValue.length > 0){
			var values = {canton: selectedValue};
			$.ajax({
				url: "/ajax/distritos",
				type: "POST",
				data: values,
				success: function(passed){
					if(passed == "failed"){
						console.log("failed");
						return false;
					}else{
						$("select#sellerDistrito").append(passed).removeAttr("disabled");
					}
				}
			});
		}
	});
	
	$("input[name='ad_marca']").focus(function(){
		var findParent = $(this).parents("tr").attr("data-listingindex");
		fieldPosition = $(this).offset();
		$("ul.makeSuggest").css({"left": + fieldPosition.left , "top": + (fieldPosition.top + 34), "display": "block"}).attr("data-listingindex", ''+findParent+'');
	});
	
	$("input[name='ad_modelo']").focus(function(){
		var findParent = $(this).parents("tr").attr("data-listingindex"),
			findMakeToMatch = $("tr[data-listingindex='"+findParent+"']").find("input[name='ad_marca']").val();
			modelsObject(findMakeToMatch);
			modelsObjectFilter();
		$("ul.modelSuggest").insertAfter(this).show().attr("data-listingindex", ''+findParent+'');
	});
	
	$("ul.makeSuggest li").live('mousedown', function(){
		var selectedMake = $(this).text(),
			inputParent = $(this).parent().attr("data-listingindex"),
			inputMakeTarget = $("tr[data-listingindex='"+inputParent+"']").find("input[name='ad_marca']"),
			inputModelTarget = $("tr[data-listingindex='"+inputParent+"']").find("input[name='ad_modelo']"),
			isMakeSelected = inputMakeTarget.val();
		if(isMakeSelected == "" && selectedMake.length > 0){
			inputMakeTarget.val(selectedMake);
			inputMakeTarget.change();
			inputModelTarget.removeAttr("disabled");
			modelsObject(selectedMake);
			modelsObjectFilter();
		}else if(isMakeSelected === selectedMake){
			inputMakeTarget.trigger("blur");
			return false;
		}else if(isMakeSelected != "" || isMakeSelected != selectedMake){
			inputMakeTarget.val(selectedMake);
			inputMakeTarget.change();
			modelsObject(selectedMake);
			modelsObjectFilter();
			inputModelTarget.val("");
		}
		$("ul.makeSuggest").hide();
	});
	
	$("ul.modelSuggest li").live('mousedown', function(){
		var selectedModel = $(this).text(),
			inputParent = $(this).parent().attr("data-listingindex"),
			inputModelTarget = $("tr[data-listingindex='"+inputParent+"']").find("input[name='ad_modelo']"),
			isModelSelected = inputModelTarget.val();
		if(isModelSelected == "" || selectedModel.length > 0){
			inputModelTarget.val(selectedModel);
			inputModelTarget.change();
		}else if(isMakeSelected === selectedMake){
			inputModelTarget.trigger("blur");
			return false;
		}else if(isModelSelected != "" || isModelSelected != selectedModel){
			inputModelTarget.val(selectedMake);
			inputModelTarget.change();
		}
		$("ul.modelSuggest").hide();
	});
	
	$("input[name='ad_marca']").keyup(function(){
		var liveMake = $(this).val(),
			strlen = liveMake.length,
			pattern = new RegExp("^"+liveMake, "i");
		if(strlen > 0){
			$("ul.makeSuggest").children("li").remove();
			sortMakesObject(pattern);
		}else if(strlen == 0){
			$("ul.makeSuggest").children("li").remove();
			$("ul.modelSuggest").children("li").remove();
			var findParent = $(this).parents("tr").attr("data-listingindex");
			$("tr[data-listingindex='"+findParent+"']").find("input[name='ad_modelo']").val("");
			makesObjectFilter();
		}
	});
	
	$("input[name='ad_modelo']").keyup(function(){
		var liveModel = $(this).val(),
			strlen = liveModel.length,
			pattern = new RegExp("^"+liveModel, "i");
		if(strlen > 0){
			$("ul.modelSuggest").children("li").remove();
			sortModelsObject(pattern);
		}else if(strlen == 0){
			$("ul.modelSuggest").children("li").remove();
			modelsObjectFilter();
		}
	});
		
	$("input[name='ad_marca']").blur(function(){
		$("ul.makeSuggest").hide();
	});
	
	$("input[name='ad_modelo']").blur(function(){
		$("ul.modelSuggest").hide();
	});
	
	$("input, select").focus(function(){
		$("div#validateBubble").hide();
		$("input, select").removeClass("incomplete");
	});
	
}); //ready ends

function currentDate(){
	var fullDate = new Date(),
		today = fullDate.getDate(),
		addZeroDay = (today < 10)? "0" + today: today,
		currentMonth = fullDate.getMonth() + 1,
		addZeroMonth = (currentMonth < 10)? "0" + currentMonth: currentMonth,
		currentYear = fullDate.getFullYear(),
		notFormattedDate = currentYear+"-"+addZeroMonth+"-"+addZeroDay;
	return notFormattedDate;
};

function nextMonth(){
	var fullDate = new Date(),
		today = fullDate.getDate(),
		addZeroDay = (today < 10)? "0" + today: today,
		currentMonth = fullDate.getMonth() + 1,
		currentYear = fullDate.getFullYear(),
		expireMonth,
		expireYear,
		notFormattedDate;
	if(currentMonth === 12){
		expireMonth = "01";
		expireYear = currentYear + 1;
	}else{
		expireMonth = (currentMonth < 12)? "0" + (currentMonth + 1): currentMonth,
		expireYear = currentYear;
	}
	notFormattedDate = expireYear+"-"+expireMonth+"-"+addZeroDay;
	return notFormattedDate;
};

function fetchModels(){
	var selectedMake = $("#carMake").val();
	var values = {
		make: selectedMake
	};
	$.ajax({
		url: "/ajax/modelsnewlisting",
		type: 'POST',
		data: values,
		success: function(passed){
			if(passed == "failed"){
				return false;
			}else{
				$("ul#modelSuggest").append(passed);
			}
		}
	});
};

function modelsObject(selectedMake){
	var values = {
		make: selectedMake
	};
	$.ajax({
		url: "/ajax/pageModelModelsObject",
		type: 'POST',
		data: values,
		success: function(passed){
			if(passed != "failed"){
				PageModel.AllModelsModel = passed.split(',');
			}else{
				PageModel.AllModelsModel = {};
				return false;
			}
		}
	});
};

function makesObjectFilter(){
	for(var i = 0; i < PageModel.AllMakesModel.length; i++){
		$("ul.makeSuggest").append("<li>"+PageModel.AllMakesModel[i]+"</li>");
	}
};

function sortMakesObject(pattern){
	for(var i = 0; i <= PageModel.AllMakesModel.length; i++){
		var compare = pattern.test($.trim(PageModel.AllMakesModel[i]));
		if(compare){
			$("ul.makeSuggest").append("<li>"+PageModel.AllMakesModel[i]+"</li>");
		}
	}
};

function modelsObjectFilter(){
	$("ul.modelSuggest").children("li").remove();
	for(var i = 0; i < PageModel.AllModelsModel.length; i++){
		$("ul.modelSuggest").append("<li>"+PageModel.AllModelsModel[i]+"</li>");
	}
};

function sortModelsObject(pattern){
	for(var i = 0; i < PageModel.AllModelsModel.length; i++){
		var compare = pattern.test($.trim(PageModel.AllModelsModel[i]));
		if(compare){
			$("ul.modelSuggest").append("<li>"+PageModel.AllModelsModel[i]+"</li>");
		}
	}
};

function validate(allElems){
	var isValid = true;
	var rowIsComplete = true;
	var genericMessages = new Array();
		genericMessages[0] = "Por favor digite letras unicamente!";
		genericMessages[1] = "Por favor digite numeros unicamente!";
	var fieldPosition;
	$(allElems).each(function(){
		var targetField = $(this);
		var fieldValue = $(this).val();
		var fieldError = $(this).attr("data-error");
		var fieldParentIndex = $(this).parents("tr").attr("data-listingindex");
		var fieldName = $(this).attr("name");
		var isImage = $(this).attr("type");
		if(isImage == "file"){
			var inputMultiple = $(this).attr("id");
			if(inputMultiple == "imageFiles"){
				fieldPosition = $("a#imagesModal").offset();
			}else{
				fieldPosition = $(this).offset();
			}
		}else{
			fieldPosition = targetField.offset();
		}
		if(fieldValue === null || fieldValue === undefined || fieldValue === "" || allElems.length == 0){
			$("span#errorMessage").text(fieldError);
			moveBubble(targetField);
			isValid = false;
			rowIsComplete = false;
			return false;
		}else if(fieldValue.length > 0){
			var validationType = $(this).attr("data-validationtype");
			var textRegex = /[a-zA-Z]/gi;
			var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var numberRegex = /[0-9]/gi;
			if(validationType === "email"){
				if(!emailRegex.test(fieldValue)){
					$("span#errorMessage").text(fieldError);
					moveBubble(targetField);
					isValid = false;
					rowIsComplete = false;
					return false;
				}
			}else if(validationType === "number"){
				if(!numberRegex.test(fieldValue)){
					$("span#errorMessage").text(genericMessages[1]);
					moveBubble(targetField);
					isValid = false;
					rowIsComplete = false;
					return false;
				}
			}else if(validationType === "text"){
				if(!textRegex.test(fieldValue)){
					$("span#errorMessage").text(genericMessages[0]);
					moveBubble(targetField);
					isValid = false;
					rowIsComplete = false;
					return false;
				}
			}
		}
		function moveBubble(targetField){
			var scrollTable = document.getElementById('dealerMultipleListing');
			if(scrollTable != undefined || scrollTable != null){
				var scrollTargetField = targetField[0].scrollIntoView(false);
				$("div#validateBubble").css({"left": + fieldPosition.left , "top": + (fieldPosition.top - +58)}).fadeIn("fast");
				targetField.addClass("incomplete");
			}else{
				$("div#validateBubble").css({"left": + fieldPosition.left , "top": + (fieldPosition.top - +68)}).fadeIn("fast");
			}
		}
	});
	return isValid;
};

function handleFileSelect(evt) {
	$("#list").children().remove();
	var files = evt.target.files;
	var sizeCount = [];
	for(var i = 0, f; f = files[i]; i++) {
		var eachImageSize = f.size;
		sizeCount.push(f.size);
	}
	
	var countImages = sizeCount.length;
	var totalBytes = 0;
	for(var i = 0; i < countImages; i++){
		var counting = sizeCount[i] + totalBytes;
		totalBytes = counting;
	}
	var calculated = parseInt(totalBytes/1024);
	var primeNumber = calculated / 100;
	var formated = formatCurrency(calculated);
	var count = 0;
    var limit = calculated;
    var countDisplay = document.getElementById('currentTotal');
    var imageCount = sizeCount.length;
    if(imageCount <= image_limit){
    	$("#imageCount").removeClass("attention").text(imageCount + " en total.").show();
    	$("span#imagesTotalWarning").hide();
    	$("input#totalImagesHidden").val(imageCount);
    	$("a#acceptImages").show();
    	$("input#create").removeAttr("disabled");
    }else if(imageCount > image_limit){
    	$("#imageCount").addClass("attention").text(imageCount + " en total.").show();
    	$("span#imagesTotalWarning").show();
    	$("a#acceptImages").hide();
    	$("input#create").attr("disabled", "disabled");
    	return false;
    }
    function liveCount(running) {
        var increment = count + parseInt(primeNumber);
        count = increment;
        if (count <= limit) {
            countDisplay.textContent = formatCurrency(count) + "KB";
        }else if(count > limit){
        	clearInterval(counter);
        	if(limit <= kb_limit){
        		$("img#counterOk").show();
            	$("img#counterNotOk").hide();
            	$("span#currentTotal").removeClass("attention");
            	$("a#acceptImages").show();
            	$("span#imagesWarning").hide();
            	showThumbs(evt);
        	}else if(limit > kb_limit){
        		$("img#counterOk").hide();
            	$("img#counterNotOk").show();
            	$("span#currentTotal").addClass("attention");
            	$("a#acceptImages").hide();
            	$("span#imagesWarning").show();
        	}
        }
    }
    var counter = setInterval(liveCount, 5);
};

function showThumbs(evt){
	var files = evt.target.files;
	for(var i = 0, f; f = files[i]; i++) {
		if(!f.type.match('image.*')) {
			continue;
		}
		var reader = new FileReader();
		reader.onload = (function(theFile) {
			var c = i - 1;
			c++
			return function(e) {
				var span = document.createElement('span');
				span.innerHTML = ['<img class="thumb" data-key="'+c+'" src="', e.target.result, '" title="', theFile.name, '"/>'].join('');
				document.getElementById('list').insertBefore(span, null);
			};
		})(f);
		reader.readAsDataURL(f);
	}
};

function listingsObject(completedRowsCount){
	for(var i = 0; i < completedRowsCount; i++){
		var rowFieldValues = {};
		var propertyName = 'Listing'+i;
		var formId = 'listingIndex'+i;
		var formElem = document.getElementById(formId);
		for(var c = 0; c < formElem.length; c++){
			var keyName = formElem[c].name;
			var keyValue = formElem[c].value;
			Object.defineProperty(rowFieldValues, keyName, {enumerable: true, configurable: true, writable: true, value: keyValue});
		}
		Object.defineProperty(PageModel.MultipleListingValues, propertyName, {enumerable: true, configurable: true, writable: true,  value: rowFieldValues});
	}
};
