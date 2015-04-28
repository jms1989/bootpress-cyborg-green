<?php
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'bootpress' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'bootpress_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation pager" role="navigation">
			<li class="previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bootpress' ) ); ?></li>
			<li class="next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bootpress' ) ); ?></li>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'bootpress' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php 
	$args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => __( 'Leave a Reply','bootpress'),
  'title_reply_to'    => __( 'Leave a Reply to %s','bootpress'),
  'cancel_reply_link' => __( 'Cancel Reply','bootpress'),
  'label_submit'      => __( 'Post Comment','bootpress'),

  'comment_field' =>  '<div class="comment-form-comment row comment-row"><div class="col-sm-12 comment-box"><label for="comment" class="sr-only">' . _x( 'Comment', 'noun','bootpress' ) .
    '</label><textarea id="comment" name="comment" rows="8" aria-required="true" placeholder="'.esc_attr__('Comment...','bootpress').'">' .
    '</textarea></div></div>',

  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<div class="comment-form-author row"><div class="col-sm-4">' .
      '<label for="author" class="sr-only">' . __( 'Name', 'bootpress' ) . '</label> ' .
      '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
</span><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30" aria-required="true" placeholder="' . esc_attr__( 'Name', 'bootpress' ) . '"></div></div></div>',

    'email' =>
      '<div class="comment-form-email row"><div class="col-sm-4"><label for="email" class="sr-only">' . __( 'Email', 'bootpress' ) . '</label> ' .
      '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
</span><input id="email" class="form-control" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30" aria-required="true" placeholder="' . esc_attr__( 'Email', 'bootpress' ) . '"></div></div></div>',

    'url' =>
      '<div class="comment-form-url row"><div class="col-sm-4"><label for="url" class="sr-only">' . __( 'Website', 'bootpress' ) . '</label>' .
      '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span>
</span><input id="url" class="form-control" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" placeholder="' . esc_attr__( 'Website', 'bootpress' ) . '"></div></div></div>'
    )
  ),
);
comment_form($args); ?>

</div><!-- #comments .comments-area -->