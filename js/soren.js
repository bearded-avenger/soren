jQuery(document).ready(function() {

	jQuery('body').css('display', 'none');

	jQuery('body').fadeIn(500);

	jQuery('nav a, .soren-fader').click(function(event) {
		event.preventDefault();
		newLocation = this.href;
		jQuery('body').fadeOut(400, newpage);
	});

	function newpage() {
		window.location = newLocation;
	}

});