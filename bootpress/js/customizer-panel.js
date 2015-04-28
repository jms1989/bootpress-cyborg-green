(function ($) {
wp.customize( 'bootpress_settings[style]', function( value ) {
		value.bind( function( newval ) {
			// we got link href
			newval=newval+'.min.css';
			
			var href = $('link#bootstrap3-css').attr('href');
			// we split it to parts
			var oldstyle = href.split('/');
			// we got style name part
			var oldstylename = oldstyle[oldstyle.length - 1];
			// we replaced old style name with new value			
			href = href.replace(oldstylename,newval);
			// we giving proper class to #page
			$('#page').removeClass( oldstylename + '-theme' );	
			$('#page').addClass(  newval + '-theme' );
			// we replace style css.. styles_url comes with wp_localize_script
			$('link#bootstrap3-css').attr('href', href);
		} );
													});
})(jQuery);
