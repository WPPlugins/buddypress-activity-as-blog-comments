<div class="activity">
	<ul id="activity-stream" class="activity-list item-list activity-blog-comments">
	<?php while ( bp_activities() ) : bp_the_activity(); ?>
	
		<?php do_action( 'bp_before_activity_entry' ) ?>

		<li class="<?php bp_activity_css_class() ?>" id="activity-<?php bp_activity_id() ?>">

			<div class="activity-content">

				<div class="activity-meta">
					<?php if ( is_user_logged_in() && bp_activity_can_comment() ) : ?>
						<a href="<?php bp_activity_comment_link() ?>" class="acomment-reply" id="acomment-comment-<?php bp_activity_id() ?>"><?php _e( 'Reply', 'buddypress' ) ?> (<span><?php bp_activity_comment_count() ?></span>)</a>
					<?php endif; ?>

					<?php if ( is_user_logged_in() ) : ?>
						<?php if ( !bp_get_activity_is_favorite() ) : ?>
							<a href="<?php bp_activity_favorite_link() ?>" class="fav" title="<?php _e( 'Mark as Favorite', 'buddypress' ) ?>"><?php _e( 'Favorite', 'buddypress' ) ?></a>
						<?php else : ?>
							<a href="<?php bp_activity_unfavorite_link() ?>" class="unfav" title="<?php _e( 'Remove Favorite', 'buddypress' ) ?>"><?php _e( 'Remove Favorite', 'buddypress' ) ?></a>
						<?php endif; ?>
					<?php endif;?>

					<?php do_action( 'bp_activity_entry_meta' ); //do we keep this? ?>
				</div>
			</div>

			<?php include( bp_activity_blog_comments_locate_template( array( 'activitycomments/blogactivity-entry.php' ), false ) ) ?>

	
			<?php if ( !bp_activity_blog_comments_has_children() ) { ?>

			<?php } ?>
			
		</li>

		<?php do_action( 'bp_after_activity_entry' ) ?>

	<?php endwhile; ?>
	</ul>
</div>