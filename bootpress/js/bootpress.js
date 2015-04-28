jQuery(function($){
		$inputs = $("input");
        $inputs.filter("[type='submit'],[type='reset'],[type='button']").addClass("btn btn-default");
        $inputs.filter("[type='text'], :not([type]), [type='password'], [type='search'], [type='email'], [type='url']").addClass("form-control");
		$("textarea").addClass("form-control");
		$("select").addClass("form-control");
		$("table:not([class])").addClass("table table-condensed");
    	$("dl:not([class])").addClass("dl-horizontal");

		$("li.selected").addClass("active");//current
		$("li.current").addClass("active");//current
		});
jQuery(document).ready(function($) {
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
	var txt=$('.row-offcanvas').hasClass('active') ? "Hide Sidebar" : "View Sidebar";
	$(this).text(txt);
  });
});
				(function ($) {
							function bootpress_hover_nav() {
			var $hover_nav_style = "<style id='hover-nav' type='text/css'> ul.nav li.dropdown:hover > ul.dropdown-menu{ display: block; } .nav-tabs .dropdown-menu, .nav-pills .dropdown-menu, .navbar .dropdown-menu { margin-top: 0; margin-bottom: 0; } </style>";
			var $hover_style_inserted = $("style#hover-nav");
            if (visible_md() || visible_lg()){
				if(!$hover_style_inserted.length) {
                	$("link#bootstrap3-css").after($hover_nav_style);
                    $('a.dropdown-toggle').each(function(){
                        var data_toggle = $(this).attr('data-toggle');
                        $(this).attr('data-toggle-removed',data_toggle).removeAttr('data-toggle');
                    });
                }						
			} else {
				$hover_style_inserted.remove();
				$('[data-toggle-removed]').each(function(){
					var data_toggle_removed = $(this).attr('data-toggle-removed');
					$(this).attr('data-toggle',data_toggle_removed).removeAttr('data-toggle-removed');
				});						
			}
		}
		bootpress_hover_nav();
		$(window).resize(throttle(function(){
        	bootpress_hover_nav();
		},250));
				})(jQuery);