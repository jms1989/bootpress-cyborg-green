<?php
get_header();
if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'bootpress' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );
			endwhile;

			bootpress_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>