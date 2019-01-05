$(document).ready(function(){
	
	$("#markAsSold").click(function(event){
		event.preventDefault();
		var clickedElem = $(this);
		$('#overlay').fadeIn('fast');
		var adId = $(this).attr("data-adid");
		var values = {ad_fullid: adId}
		$.ajax({
			url: "/ajax/mark_as_sold",
			type: "POST",
			data: values,
			success: function(passed){
				if(passed == "success"){
					clickedElem.hide();
					$("#forSale").show();
					$('#overlay').delay(2000).fadeOut();
				}
			}
		});
	});
	
	$("#forSale").click(function(event){
		event.preventDefault();
		var clickedElem = $(this);
		$('#overlay').fadeIn('fast');
		var adId = $(this).attr("data-adid");
		var values = {ad_fullid: adId}
		$.ajax({
			url: "/ajax/mark_for_sale",
			type: "POST",
			data: values,
			success: function(passed){
				if(passed == "success"){
					clickedElem.hide();
					$("#markAsSold").show();
					$('#overlay').delay(2000).fadeOut();
				}
			}
		});
	});
	
	$("input#userEmail").change(function(){
		var typedEmail = $(this).val();
		var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		//debugger
		if(emailRegex.test(typedEmail) == true){
			var values = {contact_email: typedEmail};
			$.ajax({
				url: "/password_reset/validate_email",
				type: "POST",
				data: values,
				success: function(passed){
					if(passed == "failed"){
						$("span#fetch_email_failed").css("display", "inline-block").html("Ese correo electr&oacute;nico no aparece registrado!");
						$("#resetSubmit").attr("disabled", "disabled");
						return false;
					}else if(passed == "success"){
						$("span#fetch_email_failed").hide();
						$("#resetSubmit").removeAttr("disabled");
					}
				}
			});
		}else{
			var inputCoord = $(this).offset();
			var errorChar = $(this).attr("data-errorChar");
			$("span#errorMessage").text(errorChar);
			$("div#validateBubble").css({"max-width": + 220 + "px" ,"left": + inputCoord.left , "top": + (inputCoord.top - +60)}).fadeIn("fast");
			return false;
		}
	});
	
	$("input#emailRegister").change(function(){
		var thisInput = $(this);
		var typedEmail = $(this).val();
		var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var inputCoord = $(this).offset();
		if(emailRegex.test(typedEmail) == true){
			var values = {contact_email: typedEmail};
			$.ajax({
				url: "/password_reset/validate_email",
				type: "POST",
				data: values,
				success: function(passed){
					if(passed == "success"){
						var errorEmpty = thisInput.attr("data-errorExist");
						$("span#errorMessageHeader").text(errorEmpty);
						$("div#validateBubbleHeader").css({"left": + inputCoord.left , "top": + (inputCoord.top - -50)}).fadeIn("fast");
						$("#register").attr("disabled", "disabled");
						return false;
					}else if(passed == "failed"){
						$("#register").removeAttr("disabled");
					}
				}
			});
		}else{
			if(typedEmail != ""){
				var inputCoord = $(this).offset();
				var errorChar = $(this).attr("data-errorChar");
				$("span#errorMessageHeader").text(errorChar);
				$("div#validateBubbleHeader").css({"left": + inputCoord.left , "top": + (inputCoord.top - -50)}).fadeIn("fast");
				return false;
			}
		}
	});
	
}); // ready ends
