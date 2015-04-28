<?php
get_header(); ?>

			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'bootpress' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bootpress' ); ?></p>
					<div class="col-sm-6"><?php get_search_form(); ?></div>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>