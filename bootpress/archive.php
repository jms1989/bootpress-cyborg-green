<?php
get_header(); ?>
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'bootpress' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'bootpress' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'bootpress' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'bootpress' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'bootpress' ) ) . '</span>' );
					else :
						_e( 'Archives', 'bootpress' );
					endif;
				?></h1>
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