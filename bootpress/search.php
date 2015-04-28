<?php
get_header(); 
if ( have_posts() ) : ?>

			<header class="page-header">
		    <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'bootpress' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>

			<?php bootpress_content_nav( 'nav-above' ); ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php bootpress_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'bootpress' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'bootpress' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>