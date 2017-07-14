=== Plugin Name ===
Contributors: nuprn1
Donate link: http://firevortex.net/donatebeer/
Tags: buddypress, activity stream, blog comments
Requires at least: PHP 5.2, WordPress 2.9.2, BuddyPress 1.2.x
Tested up to: PHP 5.2.x, WordPress 2.9.2, BuddyPress 1.2.3
Stable tag: 0.1.0

This plugin will replace the blog comments section with the activity stream

== Description ==

** IMPORTANT **

This plugin will not be updated for future versions of BuddyPress (1.3) - if you would like to take over this plugin, please contact me.
http://twitter.com/#!/etiviti/statuses/29550143485247489

This plugin will replace the main BuddyPress blog (for what BP is activated on) comments section with the activity stream.

= Requirements =

* Activity stream enabled
* blog and forum activity stream enabled

= Important Notes = 

Please see the FAQ - if you have an existing BP install with blog postings and comments you MUST run an additional plugin to tag items into the activity stream (this is untested)

Currently no WPMU subblog support - looking for any brave souls to configure it properly. :)

= Related Links: = 

* <a href="http://blog.etiviti.com/2010/04/buddypress-activity-stream-as-blog-comments/" title="BuddyPress Activity Stream as Blog Comments - Blog About Page">About Page</a>
* <a href="http://etivite.com/2010/04/what-does-it-mean/" title="Plugin Demo Site">See it in action</a>

Please report any bugs, ideas, concerns, etc - detailed.

== Installation ==

1. Upload the full directory into your wp-content/plugins directory
2. Activate the `BuddyPress Activity Stream as Blog Comments` on the plugin administration page
3. If needed: Copy and modified the /theme/activitycomments/ files to your default theme (important to keep the folder activitycomments into the root default theme directory)

== Frequently Asked Questions ==

= What theme edit is required? =

If you do not use the default BuddyPress theme - you may copy the files in theme/activitycomments/ and drop them into your defaulttheme/activitycomments/ directory and adjust according to your needs.

See Extra Configuration for more.

= I have existing blog comments, what happens to those? =

This has been taken into consideration and this plugin will display previous blog comments but will REMOVE the old reply textarea box (only is_site_admin may reply in a traditional comment)

you MUST however run this plugin <a href="http://wordpress.org/extend/plugins/bp-import-blog-activity/">BP Import Blog Activity</a> which tags each blog post and comment with activity stream data. This is a requirement in order to pull in activity stream data on a blog post.

= I don't see the activity stream on my blog post =

The most important caveat here is an activity record against the blog post - without this - no activity stream data will appear (not even a reply/favorite)

= How? =

When a blog post (new_blog_post) or comment (new_blog_comment) is made - an activity record is created corresponding to the post_ID or comment_ID. This plugin will cycle over the activity records for threaded comments made and display them in the same fashion as BuddyPress activity stream (ability to reply and nested via the same ajax means)

= Why? =

The activity stream is a centralized commenting system in BuddyPress - the disconnect on the BP Blog portion may alienate user discussion on your site. This is NOT for everyone - you will lose the powerful internal WP Commenting admin system and will rely only on activity stream for comments.

= What about WPMU and subblogs? =

I'm not sure yet - if anyone wants to investigate this further - please drop me a note. 

= My question isn't answered here =

Please contact me at

* <a href="http://blog.etiviti.com/2010/04/buddypress-activity-stream-as-blog-comments/" title="BuddyPress Activity Stream as Blog Comments - Blog About Page">About Page</a>
* <a href="http://etivite.com" title="Plugin Demo Site">Author's BuddyPress Demo Site</a>
* <a href="http://twitter.com/etiviti" title="Twitter">Author's Twitter</a>


== Changelog ==

= 0.1.0 =
* First [BETA] version


== Upgrade Notice ==


== Extra Configuration ==

= Remove comments_popup_link() in BP blog theme files = 

You may want to remove the function call comments_popup_link used on the BuddyPress theme files - as this will output the wp comments count instead of the activity comment count.

= Allow other members to use traditional blog comment reply =

Edit the theme file theme/activitycomments/blogactivity-commments.php (you may want to copy this activitycomments/file to your default theme to prevent future updates from overwriting)

change the line
`<?php if ( comments_open() && is_site_admin() ) : ?>`

you may use `current_user_can()` with the wp_cap level (lets say you want editors or authors to reply to comments in the traditional sense)