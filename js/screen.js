var deviceObj = {
	screenWidth: $(window).width(),
	screenHeight: $(window).height(),
    screenOrientation: window.orientation,
    phone: undefined,
    smallTablet: undefined,
    tablet: undefined,
    desktop: false
}

function handleOrientation() {
	if(deviceObj.screenOrientation === 0 || deviceObj.screenOrientation === 180){
		if(deviceObj.screenWidth === 320){
			deviceObj.phone = true;
		}else if(deviceObj.screenWidth === 600 && deviceObj.screenWidth < 768){
			deviceObj.smallTablet = true;
		}else if(deviceObj.screenWidth === 768 && deviceObj.screenWidth < 1024){
			deviceObj.tablet = true;
		}
	}else if(deviceObj.screenOrientation === 90 || deviceObj.screenOrientation === -90){
		if(deviceObj.screenWidth >= 480 && deviceObj.screenWidth < 1024){
			deviceObj.phone = true;
		}else if(deviceObj.screenWidth === 800 && deviceObj.screenWidth < 1024){
			deviceObj.smallTablet = true;
		}else if(deviceObj.screenWidth >= 1024){
			deviceObj.tablet = true;
		}
	}else if(deviceObj.screenOrientation === undefined){
		deviceObj.phone = false;
		deviceObj.smallTablet = false;
		deviceObj.tablet = false;
		deviceObj.desktop = true;
	}
	return deviceObj;
}