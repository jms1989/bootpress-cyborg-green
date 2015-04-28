<?php
get_header();
while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

				<nav class="navigation">
				<ul class="pager">
					<li class="previous"><?php previous_post_link( '%link', '<span class="glyphicon glyphicon-arrow-left"></span> %title' ); ?></li>
					<li class="next"><?php next_post_link( '%link', '%title <span class="glyphicon glyphicon-arrow-right"></span>' ); ?></li>
				</ul>
				</nav><!-- .nav-single -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>