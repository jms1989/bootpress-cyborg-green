	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-header">
			<header>
				<h1><?php the_author(); ?></h1>
				<div class="entry-meta text-right">
			<span class="glyphicon glyphicon-time"></span> <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bootpress' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a>
			<?php edit_post_link( __( 'Edit', 'bootpress' ), '<span class="edit-link"><span class="glyphicon glyphicon-pencil"></span> ', '</span>' ); ?></div>
				</header>
			<?php
		
			$status_avatar = apply_filters( 'bootpress_status_avatar', 125 );
			echo get_avatar( get_the_author_meta( 'ID' ), $status_avatar );
			?>
		</div><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bootpress' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php if ( comments_open() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'bootpress' ) . '</span>', __( '1 Reply', 'bootpress' ), __( '% Replies', 'bootpress' ) ); ?>
			</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
