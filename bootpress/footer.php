</div><!-- Row -->
    </div> <!-- /container -->
	<div class="footer clearfix">
	<div class="container">
	<div class="col-sm-12 col-xs-6">
	 <?php wp_nav_menu(array(
			'theme_location' => 'footer',
			'container_id'    => 'footer-menu',
			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'fallback_cb'    => 'link_to_menu_editor',
			'depth' => -1,
		)); ?>
	<?php bootpress_credits(); ?>
	</div>
	</div>
	</div>
  <?php wp_footer(); ?>
  </body>
</html>