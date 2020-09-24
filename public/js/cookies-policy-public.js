(function( $ ) {
	'use strict';
	$(document).on("click", "#allow-cookies-button", function(e) {
		e.preventDefault();
		document.getElementById("allow-cookies-policy-component").style.display = "none";
		Cookies.set("allow_cookies", "allow",{expires: 0.0001});
		window.location.reload();
	});
})( jQuery );
