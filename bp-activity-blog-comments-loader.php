<?php
/*
 Plugin Name: BuddyPress Activity Stream as Blog Comments
 Plugin URI: http://wordpress.org/extend/plugins/buddypress-activity-as-blog-comments/
 Description: Replace the main buddypress blog commenting with activity stream comments (activity must be enabled for blog postings)
 Author: rich fuller - etiviti (rich!)
 Author URI: http://buddypress.org/developers/nuprn1/
 License: GNU GENERAL PUBLIC LICENSE 3.0 http://www.gnu.org/licenses/gpl.txt
 Version: 0.1.0
 Text Domain: bp-activity-blog-comments
 Site Wide Only: true
*/

/* Only load code that needs BuddyPress to run once BP is loaded and initialized. */
function bp_activity_blog_comments_init() {

    require( dirname( __FILE__ ) . '/bp-activity-blog-comments.php' );
	
	//don't waste if we don't care
	if ( ( !(int)get_site_option( 'bp-disable-blogforum-comments' ) || false === get_site_option( 'bp-disable-blogforum-comments' ) ) && bp_is_blog_page() && bp_is_active( 'activity' ) && bp_is_active( 'blogs' ) ) {
		add_action( 'bp_head', 'bp_activity_blog_comments_insert_head');
	
		include( bp_activity_blog_comments_locate_template( array( 'activitycomments/blogactivity-functions.php' ), false ) );
		
		add_filter('comments_template', bp_activity_blog_comments_template );
	
	}
	
}
add_action( 'bp_init', 'bp_activity_blog_comments_init' );
?>