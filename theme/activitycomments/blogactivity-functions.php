<?php
/* HTML for outputting blog comments as defined by the WP comment API */

function bp_activity_blog_comments_dtheme_blog_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type )
		return false;
	?>

	<li id="comment-<?php comment_ID(); ?>">
		<div class="comment-avatar-box">
			<div class="avb">
				<a href="<?php echo get_comment_author_url() ?>" rel="nofollow">
					<?php if ( $comment->user_id ) : ?>
						<?php echo bp_core_fetch_avatar( array( 'item_id' => $comment->user_id, 'width' => 50, 'height' => 50, 'email' => $comment->comment_author_email ) ); ?>
					<?php else : ?>
						<?php echo get_avatar( $comment, 50 ) ?>
					<?php endif; ?>
				</a>
			</div>
		</div>

		<div class="comment-content">

			<div class="comment-meta">
				<a href="<?php echo get_comment_author_url() ?>" rel="nofollow"><?php echo get_comment_author(); ?></a> <?php _e( 'said:', 'buddypress' ) ?>
				<em><?php _e( 'On', 'buddypress' ) ?> <a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date() ?></a></em>
			</div>

			<?php if ( $comment->comment_approved == '0' ) : ?>
			 	<em class="moderate"><?php _e('Your comment is awaiting moderation.'); ?></em><br />
			<?php endif; ?>

			<?php comment_text() ?>

			<div class="comment-options">
				<?php echo comment_reply_link( array('depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ?>
				<?php edit_comment_link( __( 'Edit' ),'','' ); ?>
			</div>

		</div>
	</li>
	
	<?php do_action( 'bp_before_activity_blog_comments_loop' ) ?>

	<?php if ( bp_activity_blog_comments_wpcomment_has_activities() ) : ?>

		<?php include( bp_activity_blog_comments_locate_template( array( 'activitycomments/blogactivity-loop.php' ), false ) ) ?>

	<?php endif; ?>

	<?php do_action( 'bp_after_activity_blog_comments_loop' ) ?>

	
<?php
}
?>