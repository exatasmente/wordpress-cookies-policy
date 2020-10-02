var cookies_message;
window.Cookies_Policy = (function( $ ) {
	'use strict';
	function setCookies(name,value,expirationInDays= 1,path = "/",domain = null,samesite=null,secure=false) {
		const date = new Date();
		date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
		document.cookie = name + '=' + value
			+ ';expires=' + date.toUTCString()
			+ ';path='+path
			+ (domain ? ';domain='+domain : '')
			+ (secure ? ';secure' : '')
			+ ';samesite='+ ( samesite ?? 'Lax');
	}
	function cookieExists(name,value) {
		return document.cookie.split(';').filter(
			(cookie) => cookie.trim() == name+'='+value
		).length > 0;

	}
	function getDomain(){
		if(document.domain.length){
			let parts = document.domain.replace(/^(www\.)/,"").split('.');
			while(parts.length > 2){
				parts.shift();
			}
			let domain = parts.join('.');

			return domain.replace(/(^\.*)|(\.*$)/g, "");
		}
		return '';
	}
	if (!cookieExists('permission_use_cookies','allow')) {
		document.addEventListener('DOMContentLoaded', function () {
			if(!document.getElementById("allow-cookies-policy-component")) {
				document.body.insertAdjacentHTML('afterBegin', cookies_message.html);
			}
			$(document).on("click", "#allow-cookies-button", function (e) {
				e.preventDefault();
				$("#allow-cookies-policy-component")
					.fadeOut()
					.fadeOut("slow")
					.fadeOut(500);
				setCookies('permission_use_cookies','allow',1085,'/',getDomain());
				window.location.reload();
			});
		})
	}else if(document.getElementById("allow-cookies-policy-component")){
		document.getElementById("allow-cookies-policy-component").remove();
	}
	return {
		getDomain : getDomain,
		cookieExists : cookieExists,
	}

})( jQuery );
