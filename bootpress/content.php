	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_post_thumbnail(); ?>
			<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php endif; // is_single() ?>
			<div class="entry-meta">
			<?php bootpress_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'bootpress' ), '<span class="edit-link"><span class="glyphicon glyphicon-pencil"></span> ', '</span>' ); ?>
			</div>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bootpress' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bootpress' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer>
		<?php if ( comments_open() ) : ?>
				<div class="comments-link">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'bootpress' ) . '</span>', __( '1 Reply', 'bootpress' ), __( '% Replies', 'bootpress' ) ); ?>
				</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
		<div class="author-info panel panel-default">
			<div class="panel-heading"><?php printf( __( 'About %s', 'bootpress' ), get_the_author() ); ?></div>
			<div class="panel-body">
					<?php
					echo get_avatar( get_the_author_meta( 'user_email' ), 60 );
					?>
					<p><?php the_author_meta( 'description' ); ?></p>
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'bootpress' ), get_the_author() ); ?>
							</a>
			</div>
			</div><!-- .author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
