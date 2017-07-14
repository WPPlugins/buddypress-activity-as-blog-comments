<?php do_action( 'bp_before_activity_entry_comments' ) ?>

<?php if ( bp_activity_can_comment() ) : ?>
	<div class="activity-comments">
	
		<?php bp_activity_comments() ?>

		<?php if ( is_user_logged_in() ) : ?>
		<form action="<?php bp_activity_comment_form_action() ?>" method="post" id="ac-form-<?php bp_activity_id() ?>" class="ac-form"<?php bp_activity_comment_form_nojs_display() ?>>
			<div class="ac-reply-avatar"><?php bp_loggedin_user_avatar( 'width=25&height=25' ) ?></div>
			<div class="ac-reply-content">
				<div class="ac-textarea">
					<textarea id="ac-input-<?php bp_activity_id() ?>" class="ac-input" name="ac_input_<?php bp_activity_id() ?>"></textarea>
				</div>
				<input type="submit" name="ac_form_submit" value="<?php _e( 'Post', 'buddypress' ) ?> &rarr;" /> &nbsp; <?php _e( 'or press esc to cancel.', 'buddypress' ) ?>
				<input type="hidden" name="comment_form_id" value="<?php bp_activity_id() ?>" />
			</div>
			<?php wp_nonce_field( 'new_activity_comment', '_wpnonce_new_activity_comment' ) ?>
		</form>
		<?php endif; ?>
		
	</div>
<?php endif; ?>

<?php do_action( 'bp_after_activity_entry_comments' ) ?>