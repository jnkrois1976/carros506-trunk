(function(){
	var manufacturers = document.getElementById("nestedMake");
	var allMakes = (manufacturers == null)? 0: manufacturers.childElementCount;
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
		$("#nestedMake").css({"-moz-column-count": columsToString, "width": setListWidth.toString()});
	}
	if($.browser.webkit){
		$("#nestedMake").css({"-webkit-column-count": columsToString, "width": setListWidth.toString()});
	}
})();

$(document).ready(function(){
	
	$("a#expandLogin").click(function(event){
		event.preventDefault();
		$(".loginBox").animate({
			top: 0
		}, { duration: 200 });
		$("#emailLogin").focus();
	});
	
	$("a#closeLogin").click(function(event){
		event.preventDefault();
		$(".loginBox").animate({
			top: -101
		});
		$("div#validateBubbleHeader").fadeOut();
	});
	
	$("a#expandRegister").click(function(event){
		event.preventDefault();
		$(".registerBox").animate({
			top: 0
		}, { duration: 200 });
		$("#nameRegister").focus();
	});
	
	$("a#closeRegister").click(function(event){
		event.preventDefault();
		$(".registerBox").animate({
			top: -101
		});
	});
		
	$("li#searchBy").hover(function(){
		$("ul#subItemMenu").fadeIn("fast");
	},function(){
		$("ul#subItemMenu").hide();
	});
	$("li.subItemLink").hover(function(){
		$(this).children("ul").fadeIn("fast");
	}, function(){
		$(this).children("ul").fadeOut("fast");
	});
	
	$("li#myAccount").hover(function(){
		$("ul#myAccountMenu").fadeIn("fast");
	},function(){
		$("ul#myAccountMenu").hide();
	});
	
	$("input#login").click(function(){
		var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var emailField = $("input#emailLogin");
		var passwordField = $("input#passwordLogin");
		var emailInputValue = $("input#emailLogin").val();
		var passwordInputValue = $("input#passwordLogin").val();
		var emailError = $("input#emailLogin").attr("data-error");
		var passwordError = $("input#passwordLogin").attr("data-error");
		var emailPosition = $("input#emailLogin").offset();
		var passwordPosition = $("input#passwordLogin").offset();
		var getBubble = $("div#validateBubbleHeader");
		if(!emailRegex.test(emailInputValue)){
			$("span#errorMessageHeader").text(emailError);
			getBubble.css({"left": + emailPosition.left , "top": + (emailPosition.top - -50)});
			getBubble.fadeIn("fast");
			return false;
		}else if(passwordInputValue.length == 0){
			$("span#errorMessageHeader").text(passwordError);
			getBubble.css({"left": + passwordPosition.left , "top": + (passwordPosition.top - -50)});
			getBubble.fadeIn("fast");
			return false;
		}else{
			var values = {
				email: emailInputValue,
				password: passwordInputValue
			};
			$.ajax({
				url: "/login/validate",
				type: 'POST',
				data: values,
				success: function(passed){
					if(passed == "login_failed" || passed == false){
						$("span#login_failed").css("display", "inline-block").text("Usuario o clave incorrectos!");
						getBubble.hide();
					}else{
						var whereAmI= window.location.pathname;
						var urlparts = whereAmI.split('/', 3);
						var urltwoparts = '/'+urlparts[1]+'/'+urlparts[2];
						if(whereAmI == "/misc/profile_locked"){
							window.location = "/site/index";
						}else if(urltwoparts == "/misc/authenticate_account"){
							window.location.reload();
						}else{
							$(".loginBox").css("top", "-101px");
							$("ul#memberLinks").html(passed);
							getBubble.hide();
						}
					}
				}
			});
			return false;
		}
	});
	
	$("#loginWidget").click(function(){
		var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var emailField = $("input#emailLoginWidget");
		var passwordField = $("input#passwordLoginWidget");
		var emailInputValue = $("input#emailLoginWidget").val();
		var passwordInputValue = $("input#passwordLoginWidget").val();
		var emailError = $("input#emailLoginWidget").attr("data-error");
		var passwordError = $("input#passwordLoginWidget").attr("data-error");
		var emailPosition = $("input#emailLoginWidget").offset();
		var passwordPosition = $("input#passwordLoginWidget").offset();
		var getBubble = $("div#validateBubble");
		if(!emailRegex.test(emailInputValue)){
			$("span#errorMessage").text(emailError);
			getBubble.css({"left": + emailPosition.left , "top": + (emailPosition.top - +60)});
			getBubble.fadeIn("fast");
			return false;
		}else if(passwordInputValue.length == 0){
			$("span#errorMessage").text(passwordError);
			getBubble.css({"left": + passwordPosition.left , "top": + (passwordPosition.top - +60)});
			getBubble.fadeIn("fast");
			return false;
		}else{
			var values = {
				email: emailInputValue,
				password: passwordInputValue
			};
			$.ajax({
				url: "/login/validate",
				type: 'POST',
				data: values,
				success: function(passed){
					if(passed == "login_failed" || passed == false){
						$("span#login_failedWidget").css("display", "inline-block").text("Usuario o clave incorrectos!");
						getBubble.hide();
					}else{
						var whereAmI= window.location.pathname;
						var urlparts = whereAmI.split('/', 3);
						var urltwoparts = '/'+urlparts[1]+'/'+urlparts[2];
						if(whereAmI == "/misc/profile_locked"){
							window.location = "/site/index";
						}else if(urltwoparts == "/misc/authenticate_account"){
							window.location.reload();
						}else if(whereAmI == "/misc/new_password"){
							window.location = "/profile/dashboard";
						}else{
							$(".loginBox").css("top", "-101px");
							$("ul#memberLinks").html(passed);
							getBubble.hide();
						}
					}
				}
			});
			return false;
		}
	});
	
	$("input#register, input#resetSubmit").click(function(){
		function validateRegister(selectForm){
			var nameRegex = /[a-zA-Z]/gi;
			var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var validationPassed = false;
			$("#"+selectForm + " input").each(function(){
				var inputValue = $(this).val();
				if($(this).attr("type") == "text"){
					var validateName = nameRegex.test(inputValue);
					var inputCoord = $(this).offset();
					if(inputValue == "" || inputValue == null || inputValue.length == 0){
						var errorEmpty = $(this).attr("data-errorEmpty");
						$("span#errorMessageHeader").text(errorEmpty);
						$("div#validateBubbleHeader").css({"left": + inputCoord.left , "top": + (inputCoord.top - -50)}).fadeIn("fast");
						validationPassed = false;
						return false;
					}else{
						validationPassed = true;
					}
					if(inputValue.length > 0){
						if(validateName == false){
							var errorChar = $(this).attr("data-errorChar");
							$("span#errorMessageHeader").text(errorChar);
							$("div#validateBubbleHeader").css({"left": + inputCoord.left , "top": + (inputCoord.top - -50)}).fadeIn("fast");
							validationPassed = false;
							return false;
						}else{
							validationPassed = true;
						}
					}
					validationPassed = true;
				}
				if($(this).attr("type") == "email"){
					var validateEmail = emailRegex.test(inputValue);
					var inputCoord = $(this).offset();
					if(inputValue == "" || inputValue == null || inputValue.length == 0){
						var errorEmpty = $(this).attr("data-errorEmpty");
						if(selectForm == "registerForm"){
							$("span#errorMessageHeader").text(errorEmpty);
							$("div#validateBubbleHeader").css({"left": + inputCoord.left , "top": + (inputCoord.top - -50)}).fadeIn("fast");
						}else if(selectForm == "resetPassword"){
							$("span#errorMessage").text(errorEmpty);
							$("div#validateBubble").css({"max-width": + 220 + "px" ,"left": + inputCoord.left , "top": + (inputCoord.top - +60)}).fadeIn("fast");	
						}
						validationPassed =  false;
						return false;
					}else{
						validationPassed = true;
					}
					if(inputValue.length > 0){
						if(validateEmail == false){
							var errorChar = $(this).attr("data-errorChar");
							if(selectForm == "registerForm"){
								$("span#errorMessageHeader").text(errorChar);
								$("div#validateBubbleHeader").css({"left": + inputCoord.left , "top": + (inputCoord.top - -50)}).fadeIn("fast");
							}else if(selectForm == "resetPassword"){
								$("span#errorMessage").text(errorChar);
								$("div#validateBubble").css({"max-width": + 220 + "px" ,"left": + inputCoord.left , "top": + (inputCoord.top - +60)}).fadeIn("fast");	
							}
							validationPassed =  false;
							return false;
						}else{
							validationPassed = true;
						}
					}
				}
				if($(this).attr("type") == "password"){
					var inputCoord = $(this).offset();
					if(inputValue == "" || inputValue == null || inputValue.length == 0){
						var errorEmpty = $(this).attr("data-errorEmpty");
						if(selectForm == "registerForm"){
							$("span#errorMessageHeader").text(errorEmpty);
							$("div#validateBubbleHeader").css({"left": + inputCoord.left , "top": + (inputCoord.top - -50)}).fadeIn("fast");
						}else if(selectForm == "resetPassword"){
							$("span#errorMessage").text(errorEmpty);
							$("div#validateBubble").css({"max-width": + 220 + "px" ,"left": + inputCoord.left , "top": + (inputCoord.top - +60)}).fadeIn("fast");	
						}
						validationPassed =  false;
						return false;
					}else{
						validationPassed = true;
					}
				}
				if($(this).attr("id") == "confirmPassword" || $(this).attr("id") == "pwdNewRepeat"){
					if(selectForm == "registerForm"){
						var matchPassword = $("input#passwordRegister").val();
					}else if(selectForm == "resetPassword"){
						var matchPassword = $("input#pwdNew").val();
					}
					var inputCoord = $(this).offset();
					if(inputValue == "" || inputValue == null || inputValue.length == 0){
						var errorEmpty = $(this).attr("data-errorEmpty");
						if(selectForm == "registerForm"){
							$("span#errorMessageHeader").text(errorEmpty);
							$("div#validateBubbleHeader").css({"left": + inputCoord.left , "top": + (inputCoord.top - -50)}).fadeIn("fast");
						}else if(selectForm == "resetPassword"){
							$("span#errorMessage").text(errorEmpty);
							$("div#validateBubble").css({"max-width": + 220 + "px" ,"left": + inputCoord.left , "top": + (inputCoord.top - +60)}).fadeIn("fast");	
						}
						validationPassed =  false;
						return false;
					}else{
						validationPassed = true;
					}
					if(inputValue.length > 0){
						if(matchPassword != inputValue){
							var errorChar = $(this).attr("data-errorMatch");
							if(selectForm == "registerForm"){
								$("span#errorMessageHeader").text(errorChar);
								$("div#validateBubbleHeader").css({"left": + inputCoord.left , "top": + (inputCoord.top - -50)}).fadeIn("fast");
							}else if(selectForm == "resetPassword"){
								$("span#errorMessage").text(errorChar);
								$("div#validateBubble").css({"max-width": + 220 + "px" ,"left": + inputCoord.left , "top": + (inputCoord.top - +60)}).fadeIn("fast");	
							}
							validationPassed =  false;
							return false;
						}else{
							validationPassed = true;
						}
					}
				}
			});
			if(validationPassed == false){
				return false;
			}else if(validationPassed == true){
				return true;
			}
		}
		var selectForm = $(this).parents("form").attr("id");
		var validationResult = validateRegister(selectForm);
		if(validationResult == false){
			return false;
		}else{
			return true;
		}
	});
	
	$("input#submit").click(function(){
		var makeTextField = $("input#make");
		var modelTextField = $("input#model");
		if($(makeTextField).val().length == 0){
			var makeError = $(makeTextField).attr("data-error");
			var makePosition = $(makeTextField).offset();
			$("span#errorMessage").text(makeError);
			$("div#validateBubble").css({"left": + makePosition.left , "top": + (makePosition.top - +55)}).fadeIn("fast");
			return false;
		}else if($(modelTextField).val().length == 0){
			var modelError = $(modelTextField).attr("data-error");
			var modelPosition = $(modelTextField).offset();
			$("span#errorMessage").text(modelError);
			$("div#validateBubble").css({"left": + modelPosition.left , "top": + (modelPosition.top - +55)}).fadeIn("fast");
			return false;
		}else{
			return true;
		}
	});
	
	//
	//$("a#logmeout").click(function(){
	//	$.ajax({
	//		url: "/profile/log_out",
	//		success: function(passed){
	//			$("ul#memberLinks").html(passed);
	//		}
	//	});
	//	return false;
	//});
	
	$("#addCommentLink").click(function(event){
		event.preventDefault();
		$("form#addCommentForm").slideDown();	
	});
	
	$("button.viewMore").toggle(function(){
		$(this).text("Ocultar Detalles");
		$(this).removeClass("viewMore").addClass("viewLess");
		$(this).parents("tbody").prev("tbody").show();
	}, function(){
		$(this).text("Ver Detalles");
		$(this).removeClass("viewLess").addClass("viewMore");
		$(this).parents("tbody").prev("tbody").hide();
	});
	
	$("button.edit").click(function(event){
		event.preventDefault();
		var clickedButton = $(this);
		var matchingField = clickedButton.attr("data-field");
		var hasHiddenField = clickedButton.attr("data-ishidden");
		if(hasHiddenField == "true"){
			var spanId = clickedButton.attr("data-spandata");
			$("#"+spanId).hide();
			$("#"+matchingField).show();
		}
		var getMatchingField = $("#"+matchingField).removeAttr("disabled").focus();
		clickedButton.hide();
		clickedButton.nextAll("button").show();
		$("button.edit, button.editGroup").hide();
	});
	
	$("button.editGroup").click(function(event){
		event.preventDefault();
		var clickedButton = $(this);
		var hasHiddenField = clickedButton.attr("data-ishidden");
		if(hasHiddenField == "true"){
			$(".groupSelectSpan").hide();
			$(".groupSelect").removeAttr("disabled").show();
		}
		var resetProvincia = document.getElementById('editProvincia');
		resetProvincia.children[0].selected = true;
		clickedButton.hide();
		clickedButton.nextAll("button").show();
		$("button.edit").hide();
	});
	
	$("select#editProvincia").change(function(){
		var currentCanton = $("#editCanton").val();
		$("select#editCanton").attr("data-selected", "false");
		$("select#editDistrito").attr("data-selected", "false");
		$("option.canton").remove();
		$("option.distrito").remove();
		var singleSelect = $(this);
		var selectedValue = singleSelect.val();
		var validSelection = selectedValue.length;
		if(validSelection == 0){
			singleSelect.attr("data-selected", "false");
		}else if(validSelection > 0){
			singleSelect.attr("data-selected", "true");
		}
		if(validSelection > 0){
			if(currentCanton){
				var values = {provincia: selectedValue, canton: currentCanton};
			}else{
				var values = {provincia: selectedValue};
			}
			$.ajax({
				url: "/ajax/cantones",
				type: "POST",
				data: values,
				success: function(passed){
					if(passed == "failed"){
						console.log("failed");
						return false;
					}else{
						$("span#contactCant").hide();
						$("select#editCanton").append(passed).removeAttr("disabled").show();
						
					}
				}
			});
		}
	});
	
	$("select#editCanton").change(function(){
		var currentDistrito = $("#editDistrito").val();
		$("select#editDistrito").attr("data-selected", "false");
		$("option.distrito").remove();
		var singleSelect = $(this);
		var selectedValue = singleSelect.val();
		var validSelection = selectedValue.length;
		if(validSelection == 0){
			singleSelect.attr("data-selected", "false");
		}else if(validSelection > 0){
			singleSelect.attr("data-selected", "true");
		}
		if(validSelection > 0){
			if(currentDistrito){
				var values = {canton: selectedValue, distrito: currentDistrito};
			}else{
				var values = {canton: selectedValue};
			}
			$.ajax({
				url: "/ajax/distritos",
				type: "POST",
				data: values,
				success: function(passed){
					if(passed == "failed"){
						console.log("failed");
						return false;
					}else{
						$("span#contactDist").hide();
						$("select#editDistrito").append(passed).removeAttr("disabled").show();
					}
				}
			});
		}
	});
	
	$("select#editDistrito").change(function(){
		var singleSelect = $(this);
		var selectedValue = singleSelect.val();
		var validSelection = selectedValue.length;
		if(validSelection == 0){
			singleSelect.attr("data-selected", "false");
		}else if(validSelection > 0){
			singleSelect.attr("data-selected", "true");
		}
	});
	
	$(".groupSelect").change(function(){
		$(".groupSelect").each(function(){
			var allSelect = $(this);
			var allSelectValue = allSelect.attr("data-selected");
			if(allSelectValue == "false"){
				$("button.saveLocation").attr("disabled", "disabled");
				return false;
			}else if(allSelectValue == "true"){
				$("button.saveLocation").removeAttr("disabled");
			}
		});
	});
	
	$("button.cancel").click(function(event){
		event.preventDefault();
		var clickedCancel = $(this);
		var matchingField = clickedCancel.attr("data-field");
		var isGroup = $("#"+matchingField).attr("class");
		var hasHiddenField = clickedCancel.attr("data-ishidden");
		if(hasHiddenField == "true"){
			var spanId = clickedCancel.attr("data-spandata");
			$("#"+spanId).show();
			$("#"+matchingField).hide();
			if(isGroup === "groupSelect"){
				$(".groupSelect").hide().attr("disabled", "disabled");
				$(".groupSelectSpan").show();
			}
		}
		clickedCancel.hide();
		clickedCancel.next("button").hide();
		$("button.edit, button.editGroup").show();
		var fieldOrigVal = $("#"+matchingField).attr("data-defaultvalue");
		if(fieldOrigVal){
			$("#"+matchingField).val(fieldOrigVal);
		}
		$("#"+matchingField).attr("disabled", "disabled");
		$("div#validateBubble").hide();
		
	});
	
	$("button.save").click(function(event){
		event.preventDefault();
		var clickedSave = $(this);
		var targetField = clickedSave.attr("data-field");
		var newValue = $("#"+targetField).val();
		var allElems = $("#"+targetField);
		var validation = validate(allElems);
		if(validation){
			$('#overlay').fadeIn('fast');
			var adId = $("#"+targetField).attr("data-adid");
			var adDbField = $("#"+targetField).attr("data-dbfield");
			var values = {
				ad_fullid: adId,
				db_field: adDbField,
				new_value: newValue
			};
			$.ajax({
				url: "/ajax/update_ad",
				type: 'POST',
				data: values,
				success: function(passed){
					if(passed == "success"){
						var hasHiddenField = clickedSave.attr("data-ishidden");
						if(hasHiddenField == "true"){
							var spanId = clickedSave.attr("data-spandata");
							if(spanId === "formattedPrice"){
								$("#"+spanId).html("&#8353;"+formatCurrency(newValue)).show();
							}else if(spanId == "adLocation"){
								$("#"+spanId).text($("#"+targetField+ " option:selected").text()).show();
							}else{
								$("#"+spanId).text(newValue).show();
							}
							$("#"+targetField).hide();
						}
						clickedSave.hide();
						clickedSave.prev("button").hide();
						$("button.edit").show();
						$("#"+targetField).attr("disabled", "disabled");
						$('#overlay').delay(2000).fadeOut();
					}
				}
			});
		}
	});
	
	$("button.saveProfile").click(function(event){
		event.preventDefault();
		var clickedSave = $(this);
		var targetField = clickedSave.attr("data-field");
		var newValue = $("#"+targetField).val();
		var allElems = $("#"+targetField);
		var validation = validate(allElems);
		if(validation){
			$('#overlay').fadeIn('fast');
			var adId = $("#"+targetField).attr("data-id");
			var adDbField = $("#"+targetField).attr("data-dbfield");
			var allFieldsComplete = testProfileStatus(fieldsToUpdate);
			if(allFieldsComplete){
				var values = {
					ad_fullid: adId,
					db_field: adDbField,
					new_value: newValue,
					profile_complete: 1
				};
			}else{
				var values = {
					ad_fullid: adId,
					db_field: adDbField,
					new_value: newValue,
					profile_complete: 0
				};
			}
			$.ajax({
				url: "/ajax/update_profile",
				type: 'POST',
				data: values,
				success: function(passed){
					if(passed == "success"){
						var hasHiddenField = clickedSave.attr("data-ishidden");
						if(hasHiddenField == "true"){
							var spanId = clickedSave.attr("data-spandata");
							$("#"+spanId).text(newValue).show();
							$("#"+targetField).hide();
						}
						clickedSave.hide();
						clickedSave.prev("button").hide();
						$("button.edit, button.editGroup").show();
						$("#"+targetField).attr("disabled", "disabled");
						$('#overlay').delay(2000).fadeOut();
						clickedSave.prev().prev(".edit").text(PageModel.DynamicVerbiage.edit);
					}
					if(passed == "success" && allFieldsComplete === true){
						$("div.userNotice").remove();
					}
				}
			});
		}
	});
	
	$("button.saveLocation").click(function(event){
		event.preventDefault();
		$('#overlay').fadeIn('fast');
		var clickedSave = $(this);
		var allFieldsComplete = testProfileStatus(fieldsToUpdate);
		if(allFieldsComplete){
			var values = {
				contact_fullid: $("#editProvincia").attr("data-adid"),
				contact_provincia: $("#editProvincia").val(),
				contact_canton: $("#editCanton").val(),
				contact_distrito: $("#editDistrito").val(),
				profile_complete: 1
			};
		}else{
			var values = {
				contact_fullid: $("#editProvincia").attr("data-adid"),
				contact_provincia: $("#editProvincia").val(),
				contact_canton: $("#editCanton").val(),
				contact_distrito: $("#editDistrito").val(),
				profile_complete: 0
			};
		}
		$.ajax({
			url: "/ajax/update_address",
			type: 'POST',
			data: values,
			success: function(passed){
				if(passed == "success"){
					clickedSave.hide();
					clickedSave.prev("button").hide();
					$("button.edit, button.editGroup").show();
					$("#contactProv").text($("#editProvincia").val()).show();
					$("#contactCant").text($("#editCanton").val()).show();
					$("#contactDist").text($("#editDistrito").val()).show();
					$("#editProvincia, #editCanton, #editDistrito").hide().attr("disabled", "disabled");
					clickedSave.prev().prev(".editGroup").text(PageModel.DynamicVerbiage.edit);
					$('#overlay').delay(2000).fadeOut();
				}
				if(passed == "success" && allFieldsComplete === true){
					$("div.userNotice").remove();
				}
			}
		});
	});
	
	$(".calendar").click(function(event){
		event.preventDefault();
		$('#overlay').fadeIn('fast');
		var clickedElem = $(this);
		var adFullid = clickedElem.attr("data-adfullid");
		var adExpires = clickedElem.attr("data-newdate");
		var formatDate = clickedElem.attr("data-formatdate");
		var values = {
			ad_fullid: adFullid,
			ad_expires: adExpires
		};
		$.ajax({
			url: "/ajax/renew_post",
			type: "POST",
			data: values,
			success: function(passed){
				$("#orig_exp_date").text(formatDate);
				$('#overlay').delay(2000).fadeOut();
			}
		});
	});
	
	$("img.tooltip").hover(function(){
		var tooltipMessage = $(this).attr("data-title");
		var messagePosition = $(this).offset();
		$("span#tooltipMessage").text(tooltipMessage);
		$("div#toolTip").css({"max-width": + 130 + "px" ,"left": + (messagePosition.left - 50 ), "top": + (messagePosition.top - +40)}).show();
	},function(){
		$("div#toolTip").hide();
	});
	
	$("a.tooltip").hover(function(){
		var tooltipMessage = $(this).attr("data-title");
		var messagePosition = $(this).offset();
		$("span#tooltipMessage").text(tooltipMessage);
		$("div#toolTip").css({"max-width": + 250 + "px" ,"left": + (messagePosition.left - 15), "top": + (messagePosition.top - +100)}).show();
	},function(){
		$("div#toolTip").hide();
	});
	
	$("#notLoggedInMessage, #notLoggedInComment, #notLoggedInFriend, #notLoggedInFavorites, span[id^='notLoggedInStar'], span[id^='ratingBlocked'], #notLoggedInReport, #reportBlocked").click(function(event){
		event.preventDefault();
		var messageError = $(this).attr("data-error");
		var messagePosition = $(this).offset();
		$("span#errorMessage").text(messageError);
		$("div#validateBubble").css({"max-width": + 220 + "px" ,"left": + messagePosition.left , "top": + (messagePosition.top - +55)}).fadeIn("fast");	
	});
	
	$("#notLoggedInMessage, #notLoggedInComment, #notLoggedInFriend, #notLoggedInFavorites, span[id^='notLoggedInStar'], span[id^='ratingBlocked'], #notLoggedInReport, #reportBlocked").mouseout(function(){
		$("div#validateBubble").delay(1000).fadeOut();
	});
	
	$("#buyCredits").click(function(event){
		event.preventDefault();
		var messageError = $(this).attr("data-error");
		var messagePosition = $(this).offset();
		$("span#errorMessage").text(messageError);
		$("div#validateBubble").css({"max-width": + 220 + "px" ,"left": + messagePosition.left , "top": + (messagePosition.top - +55)}).fadeIn("fast");	
	});
	
	$("input#add_pic").click(function(event){
		var validateImage = $("#singleImgUpload").val();
		if(validateImage == "" || validateImage == null || validateImage == undefined){
			event.preventDefault();
			var messageError = $("#singleImgUpload").attr("data-error");
			var messagePosition = $("#singleImgUpload").offset();
			$("span#errorMessage").text(messageError);
			$("div#validateBubble").css({"max-width": + 220 + "px" ,"left": + messagePosition.left , "top": + (messagePosition.top - +55)}).fadeIn("fast");
			return false;
		}else if(validateImage.length > 0){
			return true;
		}
	});
	
	$("#msgToSeller").click(function(event){
		event.preventDefault();
		var buyer_name_value = $("#buyer_name").val();
		var buyer_email_value = $("#buyer_email").val();
		var buyer_id_value = $("#buyer_id").val();
		var seller_id_value = $("#seller_id").val();
		var ad_fullid_value = $("#ad_fullid").val();
		var buyer_message_value = $("#buyer_message").val();
		var ad_expires_value = $("#ad_expires").val();
		var where_to = $("#donde").val();
		var values = {
			buyer_name: buyer_name_value,
			buyer_email: buyer_email_value,
			buyer_id: buyer_id_value,
			seller_id: seller_id_value,
			ad_fullid: ad_fullid_value,
			buyer_message: buyer_message_value,
			ad_expires: ad_expires_value,
			where_to_save: where_to
		};
		$.ajax({
			url: "/ajax/quick_message",
			type: 'POST',
			data: values,
			success: function(passed){
				if(passed == "success"){
					$("#quickMessageForm").hide();
					$("#quickMessageSuccess").show();
				}else{
					$("#quickMessageForm").hide();
					$("#quickMessageFailed").show();
				}
			}
		});
	});
	
	$("#commentSubmit").click(function(event){
		event.preventDefault();
		var buyer_id_comment = $("#buyer_id_comment").val();
		var buyer_name_comment = $("#buyer_name_comment").val();
		var buyer_comment_value = $("#buyer_comment").val();
		var comment_date_value = $("#comment_date").val();
		var ad_fullid_comment = $("#ad_fullid_comment").val();
		var ad_sellerId_comment = $("#ad_sellerId_comment").val();
		var ad_expires_comment = $("#ad_expires_comment").val();
		var where_to = $("#donde").val();
		var values = {
			buyer_id: buyer_id_comment,
			buyer_name: buyer_name_comment,
			buyer_comment: buyer_comment_value,
			comment_date: comment_date_value,
			ad_fullid: ad_fullid_comment,
			ad_sellerId: ad_sellerId_comment,
			ad_expires: ad_expires_comment,
			where_to_save: where_to
		};
		$.ajax({
			url: "/ajax/add_comment",
			type: 'POST',
			data: values,
			success: function(passed){
				if(passed == "success"){
					$("#addCommentForm").hide();
					$("#addCommentSuccess").show();
				}else{
					$("#addCommentForm").hide();
					$("#addCommentFailed").show();
				}
			}
		});
	});
	
	$("#emailToFriendSubmit").click(function(event){
		event.preventDefault();
		var buyer_name_friend = $("#buyer_name_friend").val();
		var ad_full_link = $("#ad_full_link").val();
		var adImageLink = document.getElementById('largeThumb').src;
		var friend_email = $("#friend_email").val();
		var message_to_friend = $("#message_to_friend").val();
		var values = {
			buyer_name: buyer_name_friend,
			buyer_link: ad_full_link,
			image_link: adImageLink,
			email_friend: friend_email,
			actual_message: message_to_friend
		};
		$.ajax({
			url: "/ajax/message_to_friend",
			type: 'POST',
			data: values,
			success: function(passed){
				if(passed == "success"){
					$("#emailToFriendForm").hide();
					$("#emailToFriendSuccess").show();
				}else{
					$("#emailToFriendForm").hide();
					$("#emailToFriendFailed").show();
				}
			}
		});
	});
	
	$("#report_submit").click(function(event){
		event.preventDefault();
		var report_buyer_fullid = $("#report_buyer_fullid").val();
		var report_seller_fullid = $("#report_seller_fullid").val();
		var report_ad_fullid = $("#report_ad_fullid").val();
		var report_ad_expires = $("#report_ad_expires").val();
		var report_ad_reports = $("#report_ad_reports").val();
		var reportsNewCount = parseInt(report_ad_reports) + 1;
		var report_message = $("#report_message").val();
		var where_to = $("#donde").val();
		var values = {
			buyer_fullid: report_buyer_fullid,
			seller_fullid: report_seller_fullid,
			ad_fullid: report_ad_fullid,
			ad_expires: report_ad_expires,
			ad_reports: reportsNewCount,
			message: report_message,
			where_to_save: where_to
		};
		$.ajax({
			url: "/ajax/report_post",
			type: 'POST',
			data: values,
			success: function(passed){
				if(passed == "success"){
					$("#reportPostForm").hide();
					$("#reportSuccess").show();
				}else{
					$("#reportPostForm").hide();
					$("#reportFailed").show();
				}
			}
		});
	});
	
	$("span[id^='star'], span[id^='notLoggedInStar'], span[id^='ratingBlocked']").hover(function(){
		var whichStar = $(this).attr("id");
		var isRated = $(this).attr("data-rated");
		if(isRated == "false"){
			$(this).addClass("full").prevAll("span[data-rated='false']").addClass("full");
		}
	},function(){
		var isRated = $(this).attr("data-rated");
		if(isRated == "false"){
			$(this).removeClass("full").prevAll("span[data-rated='false']").removeClass("full");
		}
	});
	
	$("span[id^='star']").click(function(){
		var clickedStar = $("div#rating").attr("data-postid");
		var currentVoters = $("div#rating").attr("data-voters");
		var currentScore = $("div#rating").attr("data-score");
		var clickedToRate = $("div#rating").attr("data-rated");
		var starPoints = $(this).attr("data-points");
		var isRated = $(this).attr("data-rated");
		if(isRated == "false" && clickedToRate == "false"){
			$(this).addClass("full").attr("data-rated", "true").prevAll("span").addClass("full").attr("data-rated", "true");
			var values = {
				ad_fullid: clickedStar,
				ad_rating: starPoints
			};
			$.ajax({
				url: "/ajax/rate_post",
				type: "POST",
				data: values,
				success: function(passed){
					if(passed == "success"){
						$("span#votersCount").text(parseInt(currentVoters) + 1);
						$("span#pointsCount").text(parseInt(parseInt(currentScore + starPoints) / (parseInt(currentVoters) + 1)));
						$("div#rating").attr("data-rated", "true");
					}
				}
			});
		}
	});
	
	$("span[id^='p_star']").click(function(){
		var clickedStar = $("div#rating").attr("data-postid");
		var currentVoters = $("div#rating").attr("data-voters");
		var currentScore = $("div#rating").attr("data-score");
		var clickedToRate = $("div#rating").attr("data-rated");
		var starPoints = $(this).attr("data-points");
		var isRated = $(this).attr("data-rated");
		if(isRated == "false" && clickedToRate == "false"){
			$(this).addClass("full").attr("data-rated", "true").prevAll("span").addClass("full").attr("data-rated", "true");
			var values = {
				ad_fullid: clickedStar,
				ad_rating: starPoints
			};
			$.ajax({
				url: "/ajax/rate_post_premier",
				type: "POST",
				data: values,
				success: function(passed){
					if(passed == "success"){
						$("span#votersCount").text(parseInt(currentVoters) + 1);
						$("span#pointsCount").text(parseInt(parseInt(currentScore + starPoints) / (parseInt(currentVoters) + 1)));
						$("div#rating").attr("data-rated", "true");
					}
				}
			});
		}
	});
	
	$("div#rating").hover(function(){
		$("div#ratingTitle, div#ratingDetails").animate({top: "-16px"}, 300);
	},function(){
		$("div#ratingTitle, div#ratingDetails").animate({top: "0px"}, 300);
	});
	
	$("a#adToFavorites").live('click', function(event){
		event.preventDefault();
		$('#overlay').fadeIn('fast');
		var clickedElem = $(this);
		var memberIdFav = $(this).attr("data-memberid");
		var adIdFav = $(this).attr("data-adid");
		var adExpires = $(this).attr("data-adexpires");
		var values = {
			ad_fullid: adIdFav,
			contact_fullid: memberIdFav,
			ad_expires: adExpires
		};
		$.ajax({
			url: "/ajax/add_to_fav",
			type: "POST",
			data: values,
			success: function(passed){
				if(passed == "success"){
					clickedElem.attr("id", "removeFromFavorites");
					clickedElem.parent("div").attr("id", "nofavorites");
					clickedElem.text("Eliminar de mis favoritos")
					$('#overlay').delay(2000).fadeOut();
				}
			}
		});
	});
	
	$("a#removeFromFavorites").live('click', function(event){
		event.preventDefault();
		$('#overlay').fadeIn('fast');
		var clickedElem = $(this);
		var memberIdFav = $(this).attr("data-memberid");
		var adIdFav = $(this).attr("data-adid");
		var values = {
			ad_fullid: adIdFav,
			contact_fullid: memberIdFav
		};
		$.ajax({
			url: "/ajax/remove_from_fav",
			type: "POST",
			data: values,
			success: function(passed){
				if(passed == "success"){
					clickedElem.attr("id", "adToFavorites");
					clickedElem.parent("div").attr("id", "favorites");
					var isFavorites = window.location.href;
					if(isFavorites.search("favorites") != -1){
						clickedElem.parents(".carThumb").remove();
					}else{
						clickedElem.text("Agregar a mis favoritos");
					}
					$('#overlay').delay(2000).fadeOut();
				}
			}
		});
	});
	
	$("a.expandComment").click(function(event){
		event.preventDefault();
		var clickedElem = $(this);
		var removeImage = clickedElem.attr("data-read");
		clickedElem.parents("tbody").next("tbody.expand").slideToggle();
		if(removeImage){
			var newCount = $("#newCommentCount");
			var newCountTotal = newCount.text();
			var commentId = $(this).attr("data-commentid");
			var adFullId = $(this).attr("data-adfullid");
			var values = {
				comment_id: commentId,
				ad_fullid: adFullId,
				reviewed: "1"
			};
			$.ajax({
				url: "/ajax/mark_as_read",
				type: "POST",
				data: values,
				success: function(passed){
					if(passed == "success"){
						$("#"+removeImage).remove();
						newCount.text(newCountTotal - 1);
						clickedElem.removeAttr("data-commentid").removeAttr("data-adfullid").removeAttr("data-read");
					}
				}
			});
		}
	});
	
	$("a.expandMessage").click(function(event){
		event.preventDefault();
		var clickedElem = $(this);
		var removeImage = clickedElem.attr("data-read");
		clickedElem.parents("tbody").next("tbody.expand").slideToggle();
		if(removeImage){
			var newCount = $("#newMessageCount");
			var newCountTotal = newCount.text();
			var commentId = $(this).attr("data-messageid");
			var adFullId = $(this).attr("data-adfullid");
			var values = {
				comment_id: commentId,
				ad_fullid: adFullId,
				reviewed: "1"
			};
			$.ajax({
				url: "/ajax/mark_message_as_read",
				type: "POST",
				data: values,
				success: function(passed){
					if(passed == "success"){
						$("#"+removeImage).remove();
						newCount.text(newCountTotal - 1);
						clickedElem.removeAttr("data-messageid").removeAttr("data-adfullid").removeAttr("data-read");
					}
				}
			});
		}
	});
	
	$("a.expandReport").click(function(event){
		event.preventDefault();
		var reportIcon = $(this).attr("data-reporticon");
		var reportId = $(this).attr("data-reportid");
		var clickedAnchor = $(this);
		$("#"+reportId).slideToggle();
		if(reportIcon){
			$('#overlay').fadeIn('fast');
			var topBarCount = $("span#newReportCount").attr("data-count");
			var newCount = parseInt(topBarCount) - 1;
			var adRowId = $(this).attr("data-adrowid");
			var adId = $(this).attr("data-adid");
			var sellerId = $(this).attr("data-sellerid");
			var values = {
				id: adRowId,
				ad_fullid: adId,
				seller_fullid: sellerId
			};
			$.ajax({
				url: "/ajax/verify_report",
				type: "POST",
				data: values,
				success: function(passed){
					if(passed == "success"){
						clickedAnchor.removeAttr("data-reporticon");
						$("img[data-reporticon='"+reportIcon+"']").remove();
						$("span#newReportCount").attr("data-count", newCount).text(newCount);
						$("span#userReviewedCount").attr("data-count", newCount).text(newCount);
						$('#overlay').delay(2000).fadeOut();
					}
				}
			});
		}
	});
	
	$("button.makePublic, button.makePrivate").click(function(){
		var privateOrPublic = $(this).attr("class");
		var privateCount = $("#commentPrivateCount");
		var privateCountTotal = privateCount.text();
		var adFullId = $(this).attr('data-adFullid');
		var commentId = $(this).attr("data-commentId");
		var publicIcon = $(this).attr("data-publicicon");
		var clickedButton = $(this);
		var makePublic = (privateOrPublic === "makePublic")? "1": "0";
		if(makePublic === "1"){
			var privateOrPublicFeedback = "<hr /><br /><span>Este comentario se ha publicado satisfactoriamente <img src='/images/checkmark_green.png' /></span>";
			var ajaxCall = "/ajax/make_public";
		}else if(makePublic === "0"){
			var privateOrPublicFeedback = "<hr /><br /><span>Este comentario ahora es privado <img src='/images/checkmark_green.png' /></span>";
			var ajaxCall = "/ajax/make_private";
		}
		var values = {
			ad_fullid: adFullId,
			comment_id: commentId,
			publicar: makePublic
		};
		$.ajax({
			url: ajaxCall,
			type: "POST",
			data: values,
			success: function(passed){
				if(passed == "success"){
					if(makePublic === "1"){
						$("#"+publicIcon).hide();
						$(clickedButton).hide();
						clickedButton.parent("td").append(privateOrPublicFeedback);
						privateCount.text(privateCountTotal - 1);
					}else if(makePublic === "0"){
						$(clickedButton).hide();
						clickedButton.parent("td").append(privateOrPublicFeedback);
						privateCount.text(parseInt(privateCountTotal) + 1);
					}
				}
			}
		});
	});
	
	$("button.replyToComment").click(function(){
		$(this).next("form").show();
		$(this).hide();
		$(".makePublic").hide();
		$(".makePrivate").hide();
	});
	
	$("button.cancelCommentReply").click(function(){
		$(this).parents("form").hide();
		$("button.replyToComment").show();
		$("button.replyToMessage").show();
		$(".makePublic").show();
		$(".makePrivate").show();
	});
	
	
	$("button.replyToMessage").click(function(){
		$(this).next("form").show();
		$(this).hide();
	});
	
	$("button.cancelMessageReply").click(function(){
		$(this).parents("form").hide();
		$("button.replyToMessage").show();
		$("button.replyToComment").show();
	});
	
	
	$("input.submitCommentReply").click(function(event){
		event.preventDefault();
		var parentFormId = $(this).attr("data-formid");
		var parentTag = $(this);
		var thisForm = document.getElementById(parentFormId);
		var commentId = thisForm.elements[1].value;
		var adFullId = thisForm.elements[2].value;
		var replyIcon = thisForm.elements[3].value;
		var actualReply = thisForm.elements[4].value;
		var noAnswerCount = $("#commentNoAnswerCount");
		var noAnswerCountTotal = noAnswerCount.text();
		var values = {
			comment_id: commentId,
			ad_fullid: adFullId,
			seller_reply: actualReply
		};
		$.ajax({
			url: "/ajax/reply_to_comment",
			type: "POST",
			data: values,
			success: function(passed){
				if(passed == "success"){
					$("#"+replyIcon).remove();
					thisForm.style.display='none';
					parentTag.closest("td").append("<span>Su respuesta se ha procesado satisfactoriamente <img src='/images/checkmark_green.png' /></span>");
					noAnswerCount.text(noAnswerCountTotal - 1);
				}
			}
		});
	});
	
	$("input.submitMessageReply").click(function(event){
		event.preventDefault();
		//debugger
		var parentFormId = $(this).attr("data-formid");
		var parentTag = $(this);
		var thisForm = document.getElementById(parentFormId);
		var messageId = thisForm.elements[1].value;
		var adFullId = thisForm.elements[2].value;
		var replyIcon = thisForm.elements[3].value;
		var actualReply = thisForm.elements[4].value;
		var buyerEmail = thisForm.elements[5].value;
		var noAnswerCount = $("#commentNoAnswerCount");
		var noAnswerCountTotal = noAnswerCount.text();
		var values = {
			message_id: messageId,
			ad_fullid: adFullId,
			seller_reply: actualReply,
			buyer_email: buyerEmail
		};
		$.ajax({
			url: "/ajax/reply_to_message",
			type: "POST",
			data: values,
			success: function(passed){
				if(passed == "success"){
					$("#"+replyIcon).remove();
					thisForm.style.display='none';
					parentTag.closest("td").append("<span>Su respuesta se ha procesado satisfactoriamente <img src='/images/checkmark_green.png' /></span>");
					noAnswerCount.text(noAnswerCountTotal - 1);
				}
			}
		});
	});
	
	$("img.toErase").click(function(){
		$(this).prev("span").show();
	});
	$("a.fixedNoBgLink").click(function(event){
		event.preventDefault();
		$(this).parent("span").hide();
	});
	$("a.fixedYesBgLink").click(function(event){
		event.preventDefault();
		$('#overlay').fadeIn('fast');
		var imgName = $(this).attr("name");
		var parentName = $(this).attr("data-parent");
		var folderName = $(this).attr("data-folder");
		var imgCount = $("#thumbContainer").attr("data-imgcount");
		var values = {image_name: imgName, folder_name: folderName, img_count: imgCount};
		$.ajax({
			url: "/ajax/delete_image",
			type: "POST",
			data: values,
			success: function(passed){
				if(passed == "success"){
					$("div#"+parentName).remove();
					$('#overlay').delay(2000).fadeOut();
					javascript:location.reload(true);
				}
			}
		});
	});
	
	$("input[type='text'], input[type='email'], input[type='password'], select").bind('focus change', function(){
		var isEmpty = $(this).val();
		if(isEmpty.length > 0){
			$("div#validateBubble").delay(1000).hide();
			$("div#validateBubbleHeader").delay(1000).hide();
		}
	});
	
	$("button#newCars").click(function(){
		$("div.usado").hide();
		$("div.nuevo").show();
	});
	
	$("button#usedCars").click(function(){
		$("div.usado").show();
		$("div.nuevo").hide();
	});
	
	$("button#allCars").click(function(){
		$("div.carThumb").show();
	});
	
	$( "#accordion" ).accordion({
		//fillSpace: true,
		autoHeight: false
	});
	
	$( "#accordion2" ).accordion({
		active: false,
		collapsible: true,
		autoHeight: false
	});
	
	$( "#accordion3" ).accordion({
		active: false,
		collapsible: true,
		autoHeight: false
	});
	
	$( "#accordion4" ).accordion({
		active: false,
		collapsible: true,
		autoHeight: false
	});
	
	$("select#asunto").change(function(){
		var selectedOption = $(this).val();
		if(selectedOption === "anuncio"){
			$("#ad_code_field").show();
			$("#ad_code").attr("required", true);
			$("#seller_code_field").hide();
			$("#seller_code").attr("required", false);
		}else if(selectedOption === "perfil"){
			$("#ad_code_field").hide();
			$("#ad_code").attr("required", false);
			$("#seller_code_field").show();
			$("#seller_code").attr("required", true);
		}
	});
	
	$("input#contactUs").click(function(event){
		event.preventDefault();
		var allElems = $("[required]");
		var validation = validate(allElems);
		if(validation){
			$('#overlay').fadeIn('fast');
			var sellerName = $("#sellerName").val();
			var userEmail = $("#sellerEmail").val();
			var dealerName = $("#dealerName").val();
			var asunto = $("#asunto").val();
			var adCode = $("#ad_code").val();
			var sellerCode = $("#seller_code").val();
			var userMessage = $("#user_message").val();
			var values = {
				seller_name: sellerName,
				user_email: userEmail,
				dealer_name: dealerName,
				asunto: asunto,
				ad_code: adCode,
				seller_code: sellerCode,
				user_message: userMessage
			};
			$.ajax({
				url: "/ajax/contact_us",
				type: 'POST',
				data: values,
				success: function(passed){
					if(passed == "success"){
						$("#resetMsgForm").trigger("click");
						$('#overlay').delay(2000).fadeOut();
						$("#emailToAdmin").show();
					}
				}
			});
		}
	});
	
	$("#postQuestion").click(function(event){
		event.preventDefault();
		$("#postQuestionForm").slideDown();
	});
	
	$("input#userQuestionSubmit").click(function(event){
		event.preventDefault();
		var allElems = $("[required]");
		var validation = validate(allElems);
		if(validation){
			$('#overlay').fadeIn('fast');
			var questionTopic = $("#questionTopic").val();
			var userQuestion = $("#userQuestion").val();
			var values = {
				question_topic: questionTopic,
				user_question: userQuestion
			};
			$.ajax({
				url: "/ajax/user_question",
				type: 'POST',
				data: values,
				success: function(passed){
					if(passed == "success"){
						$("#resetQuestionForm").trigger("click");
						$('#overlay').delay(2000).fadeOut();
						$("#userQuestionSuccess").show();
					}
				}
			});
		}
	});
	
});// ready ends

function formatCurrency(rawNumber){
	var numberToString = rawNumber.toString();
	var numberOfDigits = numberToString.length;
	if(numberOfDigits < 4){
		return rawNumber;
	}
	if(numberOfDigits == 4){
		var decenas = numberToString.substring(0,1);
		var decenasResto = numberToString.substr(1);
		var result = decenas + "." + decenasResto;
		return result;
	}
	if(numberOfDigits == 5){
		var decenas = numberToString.substring(0,2);
		var decenasResto = numberToString.substr(2);
		var result = decenas + "." + decenasResto;
		return result;
	}
	if(numberOfDigits == 6){
		var centenas = numberToString.substring(0,3);
		var centenasResto = numberToString.substr(3);
		var result = centenas + "." + centenasResto;
		return result;
	}
	if(numberOfDigits == 7){
		var millones = numberToString.substring(0,1);
		var millonesMedio = numberToString.substring(1,4);
		var millonesResto = numberToString.substr(4,7);
		var result = millones + "." + millonesMedio + "." + millonesResto;
		return result;
	}
	if(numberOfDigits == 8){
		var millones = numberToString.substring(0,2);
		var millonesMedio = numberToString.substring(2,5);
		var millonesResto = numberToString.substr(5,8);
		var result = millones + "." + millonesMedio + "." + millonesResto;
		return result;
	}
}

function validate(allElems){
	var isValid = true;
	$(allElems).each(function(){
		var fieldValue = $(this).val();
		var fieldError = $(this).attr("data-error");
		var isImage = $(this).attr("type");
		if(isImage == "file"){
			var inputMultiple = $(this).attr("id");
			if(inputMultiple == "imageFiles"){
				var fieldPosition = $("a#imagesModal").offset();
			}
		}else{
			var fieldPosition = $(this).offset();
		}
		var genericMessages = new Array();
			genericMessages[0] = "Por favor digite letras unicamente!";
			genericMessages[1] = "Por favor digite numeros unicamente!";
		if(fieldValue === null || fieldValue === undefined || fieldValue === ""){
			$("span#errorMessage").text(fieldError);
			$("div#validateBubble").css({"left": + fieldPosition.left , "top": + (fieldPosition.top - +68)}).fadeIn("fast");
			isValid = false;
			return false;
		}else if(fieldValue.length > 0){
			var validationType = $(this).attr("data-validationtype");
			var textRegex = /[a-zA-Z]/gi;
			var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var numberRegex = /[0-9]/gi;
			if(validationType === "email"){
				if(!emailRegex.test(fieldValue)){
					$("span#errorMessage").text(fieldError);
					$("div#validateBubble").css({"left": + fieldPosition.left , "top": + (fieldPosition.top - +68)}).fadeIn("fast");
					isValid = false;
					return false;
				}
			}else if(validationType === "number"){
				if(!numberRegex.test(fieldValue)){
					$("span#errorMessage").text(genericMessages[1]);
					$("div#validateBubble").css({"left": + fieldPosition.left , "top": + (fieldPosition.top - +68)}).fadeIn("fast");
					isValid = false;
					return false;
				}
			}else if(validationType === "text"){
				if(!textRegex.test(fieldValue)){
					$("span#errorMessage").text(genericMessages[0]);
					$("div#validateBubble").css({"left": + fieldPosition.left , "top": + (fieldPosition.top - +68)}).fadeIn("fast");
					isValid = false;
					return false;
				}
			}
		}
	});
	return isValid;
}
function testProfileStatus(fieldsToUpdate){
	var allFieldsComplete;
	for(var i = 0; i < fieldsToUpdate.length; i++){
		var getFieldValue = $("#"+fieldsToUpdate[i]).val();
		if(getFieldValue == "" || getFieldValue == undefined || getFieldValue == null){
			allFieldsComplete = false;
			return false;
		}else{
			allFieldsComplete = true;
		}
	}
	return allFieldsComplete;
}
