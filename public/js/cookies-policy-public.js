(function( $ ) {
	'use strict';
	$(document).on("click", "#inversa-allow-cookies", function(e) {
		e.preventDefault();
		document.getElementById("inversa-cookies-policy-message").style.display = "none";
		Cookies.set("permission_use_cookies", "allow");
		window.location.reload();
	});
})( jQuery );
