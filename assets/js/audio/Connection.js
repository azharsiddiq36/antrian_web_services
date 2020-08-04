class Connection {

	BASE_URL;

	constructor(){
		const getUrl = window.location;
		this.BASE_URL = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+'/';
	}

	baseUrl(){
		const getUrl = window.location;
		return getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+'/';
	}

	setCookies(cookiesName,cookiesValue,cookiesExpireDays){
		var d = new Date();
		d.setTime(d.getTime() + (cookiesExpireDays*24*60*60*1000));
		var expires = "expires="+ d.toUTCString();
		document.cookie = cookiesName + "=" + cookiesValue + ";" + expires + ";path=/";
	}

	getCookies(cookiesName){
		let name = cookiesName + "=";
		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for(let i = 0; i <ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
}
