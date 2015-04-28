<?php
get_header(); ?>


		<?php if ( have_posts() ) : ?>

			<?php
				the_post();
			?>

			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Author Archives: %s', 'bootpress' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
			</header><!-- .archive-header -->

			<?php
				rewind_posts();
			// If a user has filled out their description, show a bio on their entries.
			if ( get_the_author_meta( 'description' ) ) : ?>
			<div class="author-info panel panel-default">
			<div class="panel-heading"><?php printf( __( 'About %s', 'bootpress' ), get_the_author() ); ?></div>
			<div class="panel-body">
					<?php
					echo get_avatar( get_the_author_meta( 'user_email' ), 60 );
					?>
					<p><?php the_author_meta( 'description' ); ?></p>
					</div>
			</div><!-- .author-info -->
			<?php endif; ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php bootpress_content_nav( 'nav-below' ); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>