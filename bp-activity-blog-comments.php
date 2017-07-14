<?php 
//TODO
//wpmu testing? for all blogs?

function bp_activity_blog_comments_template( $file = '' ) {
   return bp_activity_blog_comments_locate_template( array( 'activitycomments/blogactivity-comments.php' ), false );
}

function bp_activity_blog_comments_has_activities( $args = '' ) {
	global $bp, $wpdb, $activities_template;

	if ( !bp_is_active( 'activity' ) )
		return;
		
	if ( !bp_is_active( 'blogs' ) )
		return;

	if ( $activities_template->disable_blogforum_replies )
		return;

	/* Group filtering */
	$object = $bp->blogs->id;
	$primary_id = (int) $wpdb->blogid;

	/* Note: any params used for filtering can be a single value, or multiple values comma separated. */
	$defaults = array(
		'display_comments' => 'threaded', // false for none, stream/threaded - show comments in the stream or threaded under items
		'sort' => 'DESC', // sort DESC or ASC
		'page' => 1, // which page to load
		'per_page' => false, // number of items per page
		'max' => false, // max number to return
		'include' => false, // pass an activity_id or string of ID's comma separated
		'show_hidden' => false, // Show activity items that are hidden site-wide?

		/* Filtering */
		'object' => $object, // object to filter on e.g. groups, profile, status, friends
		'primary_id' => $primary_id, // object ID to filter on e.g. a group_id or forum_id or blog_id etc.
		'action' => 'new_blog_post', // action to filter on e.g. activity_update, new_forum_post, profile_updated
		'secondary_id' => get_the_ID(), // secondary object ID to filter on e.g. a post_id

		/* Searching */
		'search_terms' => false // specify terms to search on
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r );

	$filter = array( 'user_id' => false, 'object' => $object, 'action' => $action, 'primary_id' => $primary_id, 'secondary_id' => $secondary_id );

	$activities_template = new BP_Activity_Template( $page, $per_page, $max, $include, $sort, $filter, $search_terms, $display_comments, $show_hidden );

	return apply_filters( 'bp_activity_blog_comments_has_activities', $activities_template->has_activities(), &$activities_template );
}

function bp_activity_blog_comments_wpcomment_has_activities( $args = '' ) {

	global $bp, $wpdb, $activities_template;

	if ( !bp_is_active( 'activity' ) )
		return;
		
	if ( !bp_is_active( 'blogs' ) )
		return;

	if ( $activities_template->disable_blogforum_replies )
		return;

	/* Group filtering */
	$object = $bp->blogs->id;
	$primary_id = (int) $wpdb->blogid;

	/* Note: any params used for filtering can be a single value, or multiple values comma separated. */
	$defaults = array(
		'display_comments' => 'threaded', // false for none, stream/threaded - show comments in the stream or threaded under items
		'sort' => 'DESC', // sort DESC or ASC
		'page' => 1, // which page to load
		'per_page' => false, // number of items per page
		'max' => false, // max number to return
		'include' => false, // pass an activity_id or string of ID's comma separated
		'show_hidden' => false, // Show activity items that are hidden site-wide?

		/* Filtering */
		'object' => $object, // object to filter on e.g. groups, profile, status, friends
		'primary_id' => $primary_id, // object ID to filter on e.g. a group_id or forum_id or blog_id etc.
		'action' => 'new_blog_comment', // action to filter on e.g. activity_update, new_forum_post, profile_updated
		'secondary_id' => get_comment_ID(), // secondary object ID to filter on e.g. a post_id

		/* Searching */
		'search_terms' => false // specify terms to search on
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r );

	$filter = array( 'user_id' => false, 'object' => $object, 'action' => $action, 'primary_id' => $primary_id, 'secondary_id' => $secondary_id );

	$activities_template = new BP_Activity_Template( $page, $per_page, $max, $include, $sort, $filter, $search_terms, $display_comments, $show_hidden );

	return apply_filters( 'bp_activity_blog_comments_has_activities', $activities_template->has_activities(), &$activities_template );
}



function bp_activity_blog_comments_insert_head() {
	echo '<style type="text/css">.activity-blog-comments { margin-left: 25px; width: 95% !important; } ul.activity-blog-comments li { border-bottom: none !important; }</style>';
}

function bp_activity_blog_comments_has_children() {
	global $activities_template;

	if ( $activities_template->activity->children )
		return true;
		
	return false;
}

function bp_activity_blog_comments_catch_action_delete_activity( $activity_id, $user_id ) {
	global $bp;
	
	if ( !$activity_id )
		return;

	if ( !$user_id )
		return;
		
	$activity = new BP_Activity_Activity( $activity_id );
	
	if ( $activity->type == 'new_blog_post' || $activity->type == 'new_blog_comment' ) {
	
		bp_core_add_message( __( 'Unable to remove Activity item due to Activity as Blog Comments', 'bp-activity-blog-comments' ) );
	
		bp_core_redirect( wp_get_referer() );
	}
	
}
add_action( 'bp_activity_action_delete_activity', 'bp_activity_blog_comments_catch_action_delete_activity', 1, 2 );


/**
 * Check if template exists in style path, then check custom plugin location (code snippet from MrMaz)
 *
 * @param array $template_names
 * @param boolean $load Auto load template if set to true
 * @return string
 */
function bp_activity_blog_comments_locate_template( $template_names, $load = false ) {

	if ( !is_array( $template_names ) )
		return '';

	$located = '';
	foreach($template_names as $template_name) {

		// split template name at the slashes
		$paths = explode( '/', $template_name );
		
		// only filter templates names that match our unique starting path
		if ( !empty( $paths[0] ) && 'activitycomments' == $paths[0] ) {


			$style_path = STYLESHEETPATH . '/' . $template_name;
			$plugin_path = dirname( __FILE__ ) . "/theme/{$template_name}";

			if ( file_exists( $style_path )) {
				$located = $style_path;
				break;
			} else if ( file_exists( $plugin_path ) ) {
				$located = $plugin_path;
				break;
			}
		}
	}

	if ($load && '' != $located)
		load_template( $located );

	return $located;
}
?>