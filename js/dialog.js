$(document).ready(function(){

	$('#dialogMakes').dialog({
		autoOpen: false,
		width: 400,
		modal: true
	});
	$('#dialog_linkMakes').click(function(){
		$('#dialogMakes').dialog('open');
		return false;
	});
	
	$('#dialogModels').dialog({
		autoOpen: false,
		width: 400,
		modal: true
	});
	$('#dialog_linkModels').click(function(){
		$('#dialogModels').dialog('open');
		return false;
	});
	
	$('#dialogQuickMessage').dialog({
		autoOpen: false,
		width: 440,
		modal: true
	});
	$('#quickMessage').click(function(){
		$('#dialogQuickMessage').dialog('open');
		return false;
	});
	
	$('#dialogEmailToFriend').dialog({
		autoOpen: false,
		width: 440,
		modal: true
	});
	$('#emailToFriend').click(function(){
		$('#dialogEmailToFriend').dialog('open');
		return false;
	});
	
	$('#dialogReportPost').dialog({
		autoOpen: false,
		width: 440,
		modal: true
	});
	$('#reportThisPost').click(function(){
		$('#dialogReportPost').dialog('open');
		return false;
	});
	
	$('#postNewAd').dialog({
		autoOpen: false,
		modal: true,
        closeOnEscape: false,
        dialogClass: 'no_close',
        width: 300
	});
	
	$('#expirationNotice').dialog({
		modal: true,
        closeOnEscape: false,
        width: 700,
		height:300,
		title: 'Recordatorio'
	});
	
	$('#promotionNotice').dialog({
		modal: true,
        closeOnEscape: false,
        width: 600,
		height: 200,
		title: 'Promoci&oacute;n Por Lanzamiento'
	});
	
	$('#inDevelopment').dialog({
		modal: true,
        closeOnEscape: false,
        width: 700,
		height: 200,
		title: 'Demostraci&oacute;n'
	});
	
	if(whatDevice.phone){
		$('#smartPhone').dialog({
			modal: true,
	        closeOnEscape: false,
	        width: 280,
			height: 160,
			title: 'Tel&eacute;fonos'
		});
	}
	
	if(whatDevice.smallTablet){
		$('#smallTablet').dialog({
			modal: true,
	        closeOnEscape: false,
	        width: 360,
			height: 240,
			title: 'Tabletas peque&ntilde;as'
		});
	}
	
	if(whatDevice.tablet){
		$('#regularTablet').dialog({
			modal: true,
	        closeOnEscape: false,
	        width: 460,
			height: 160,
			title: 'Tabletas'
		});
	}
	
	$('#lgsample_basic_add').dialog({
		autoOpen: false,
		width: 530,
		modal: true,
		title: "Muestra de anuncio b&aacute;sico"
	});
	
	$('#lgsample_detailed_add').dialog({
		autoOpen: false,
		width: 530,
		modal: true,
		title: "Muestra de anuncio detallado"
	});
	
	$('#lgsample_full_add').dialog({
		autoOpen: false,
		width: 530,
		modal: true,
		title: "Muestra de anuncio completo"
	});
	
	$('#sample_basic_trigger').click(function(){
		$('#lgsample_basic_add').dialog('open');
		return false;
	});
	
	$('#sample_detailed_trigger').click(function(){
		$('#lgsample_detailed_add').dialog('open');
		return false;
	});
	
	$('#sample_full_trigger').click(function(){
		$('#lgsample_full_add').dialog('open');
		return false;
	});
});