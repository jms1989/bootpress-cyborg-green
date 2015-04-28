<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
<?php if ( ! dynamic_sidebar( 'right-sidebar' ) ) : ?>
	<aside id="meta" class="widget">
					<h3 class="widget-title">Meta</h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>
<?php endif; ?>
</div>