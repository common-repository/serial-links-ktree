<?php
/*
Plugin Name: Serial Link Plugin
Plugin URI: http://wordpress.ktree.com/serial-links-plugin.html
Version: 1.0
Author: Ramana Raju.S, KTree Computer Solutions Inc.
Author URI: http://www.ktree.com
Description: Allows you to assign Links to a Serial, using custom fields, and then displays a list of all links assigned to the same Serial in your single post page (usually single.php or index.php).
*/

/*  Copyright 2009  Ramana Raju.S  (email : info@ktree.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License 2 as published by
    the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can be found here: 
    http://www.gnu.org/licenses/gpl-2.0.html
	
*/


/* Dev Notes 
* Plugin folder:		serial-links
* Plugin file:	 		seriallinks-plugin.php
* Var prefix: 			$selp
* Function prefix:		$selp


/* ******************** DO NOT edit below this line! ******************** */

/* Prevent direct access to the plugin */
if (!defined('ABSPATH')) {
	exit("Sorry, you are not allowed to access this page directly.");
}


/* Pre-2.6 compatibility to find directories */
if ( ! defined( 'WP_CONTENT_URL' ) )
	define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
	define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );


/* Set constant for plugin directory */
define( 'selp_URL', WP_PLUGIN_URL.'/seriallinks-plugin' );


/* Set constant for plugin version number */
define ( 'selp_VER', '1.0' );


/* Internationalization functionality */
define('selp_DOMAIN', 'Serial Links Wordpress plugin');
$selp_text_loaded = false;

function selp_load_textdomain() {
	global $selp_text_loaded;
   	if($selp_text_loaded) return;

   	load_plugin_textdomain(selpDOMAIN, WP_PLUGIN_DIR.'/'.dirname(plugin_basename(__FILE__)), dirname(plugin_basename(__FILE__)));
   	$selp_text_loaded = true;
}


/* Function to create serial links list */
function serial_links_build() {
	
	global $id;
	
	/* Check if current link is a member of a series
	and get serial_name of current post */
	$serial_value = get_post_meta($id, 'Links', true);
	
	//exit();
	
	/* If we have a Serial assigned to this post, let's do our stuff */
	if ( $serial_value ) {
	
		/* Replace whitespace to use Serial Name as CSS class name */
		$serial_value_css = str_replace( " ", "-", $serial_value );
	
		/* Get plugin options */
		$options = get_option('selp_plugin_settings');
	
		/* Build mySQL query to pull in custom fields */
		/* Instantiate the wpdb object */
		global $wpdb;
	
		if ( $options['list_current'] == "1" ) {
			/* Do the query excluding current post */
			$findposts = $wpdb->get_results(
				"SELECT *
				FROM $wpdb->posts
				LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id)
				LEFT JOIN $wpdb->links ON ($wpdb->postmeta.meta_value = $wpdb->links.link_notes)
				WHERE $wpdb->postmeta.meta_key = 'Links'
				AND $wpdb->postmeta.meta_value = '$serial_value'
				AND $wpdb->posts.post_status = 'publish'
				AND $wpdb->posts.post_type = 'post'
				AND $wpdb->postmeta.post_id != $id
				ORDER BY $wpdb->posts.post_date ASC"
			);
			/*echo "SELECT *
				FROM $wpdb->posts
				LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id)
				LEFT JOIN $wpdb->links ON ($wpdb->postmeta.meta_value = $wpdb->links.link_notes)
				WHERE $wpdb->postmeta.meta_key = 'Links'
				AND $wpdb->postmeta.meta_value = '$serial_value'
				AND $wpdb->posts.post_status = 'publish'
				AND $wpdb->posts.post_type = 'post'
				AND $wpdb->postmeta.post_id != $id
				ORDER BY $wpdb->posts.post_date ASC";*/
			
		} else {
			/* Do the query including current post */
			$findposts = $wpdb->get_results(
				"SELECT *
				FROM $wpdb->posts
				LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id)
				LEFT JOIN $wpdb->links ON ($wpdb->postmeta.meta_value = $wpdb->links.link_notes)
				WHERE $wpdb->postmeta.meta_key = 'Links'
				AND $wpdb->postmeta.meta_value = '$serial_value'
				AND $wpdb->posts.post_status = 'publish'
				AND $wpdb->posts.post_type = 'post'
				ORDER BY $wpdb->posts.post_date ASC"
			);
			/*echo "SELECT *
				FROM $wpdb->posts
				LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id)
				LEFT JOIN $wpdb->links ON ($wpdb->postmeta.meta_value = $wpdb->links.link_notes)
				WHERE $wpdb->postmeta.meta_key = 'Links'
				AND $wpdb->postmeta.meta_value = '$serial_value'
				AND $wpdb->posts.post_status = 'publish'
				AND $wpdb->posts.post_type = 'post'
				ORDER BY $wpdb->posts.post_date ASC";*/
			
		}

		/* Build the list elements */
		if ($findposts):
			
			/* Get the admin defined parts of the list heading */
			$selp_pre_text = '';
			if ( $options['pre_text'] !='' ) {
				$selp_pre_text = '<span class="serial-pre-text">' . stripslashes($options['pre_text']) . '</span>&nbsp;';
			}
			
			$selp_serial_value = '<span class="serial-name">' . $serial_value . '</span>';
			
			$selp_post_text = '';
			if ( $options['post_text'] !='' ) {
				$selp_serial_value = '<span class="serial-name">' . $serial_value . '</span>&nbsp;';
				$selp_post_text = '<span class="serial-post-text">' . stripslashes($options['post_text']) . '</span>';
			}
			
			/* Create the div container for the list */
			$selp_div = '<div id="' . $serial_value_css . '">' . "\n";
						
			/* Create the list heading */
			$selp_heading = '<h3>' . $selp_pre_text . $selp_serial_value . $selp_post_text . '</h3>' . "\n";
			
			/* Create the ul container for the list */
			$selp_list_ul = '<ul class="' . $options['ul_class'] . '">' . "\n";
			
			/* Create the post list as an array */
			$selp_list_li = array();
			
			/* Populate the post list array */
			foreach ($findposts as $findpost):
			
				if ( ( ( $findpost->ID ) == $id ) && ( $options['link_current'] == "1" ) ) {
					// we have the current post and link is to be shown
					$selp_list_li[] = '<li class="'.$serial_value_css.' current-active"><a href="'.$findpost->link_url.'" title="'. $findpost->link_url.'" >'.$findpost->link_description.'</a></li>'."\n";
				} /*elseif ( ( $findpost->ID ) != $id ) {
				
					// all other posts except the current post
					$selp_list_li[] = '<li class="'.$serial_value_css.'"><a href="'.$findpost->link_url.'" title="'.$findpost->link_url.'">'.$findpost->link_url.'</a></li>'."\n";
				}*/ else {					
				
					// this must be the current post and link is not to be shown
					$selp_list_li[] = '<li class="' . $serial_value_css . ' current-inactive"><a href="'.$findpost->link_url.'" title="'. $findpost->link_url.'" target="_blank">'.$findpost->link_description.'</a></li>'."\n";
				}
    		endforeach;
			
			/* Create the list of posts from the array */
			$selp_list_li = implode('', $selp_list_li);
			
			/* Create the closing ul tag for the list */
			$selp_list_ul_end = '</ul>' . "\n";
			
			/* Create the closing div tag to end the XHTML */
			$selp_div_end = '</div>' . "\n";
			
			/* Put all the elements together and construct the output array */
			$selp_output = array ($selp_div, $selp_heading, $selp_list_ul, $selp_list_li, $selp_list_ul_end, $selp_div_end);
			$selp_output = implode('', $selp_output);
			
			/* Final output ready for use */
			return $selp_output;
			
		endif;
	}
}


/* Function to create a shortcode
Use [seriallinks] in post edit/write */
function selp_shortcode() {
	$selp_result = serial_links_build();
	return $selp_result;
}
add_shortcode('seriallinks', 'selp_shortcode');


/* Function to create template tag */
function serial_links() {
	$selp_result = serial_links_build();
	echo $selp_result;
}


/* Setup the plugin and create Admin settings page */
function selp_setup() {
	selp_load_textdomain();
	if ( current_user_can('manage_options') && function_exists('add_options_page') ) {
		add_options_page('Serial Links Options', 'Serial Links', 'manage_options', 'seriallinks-plugin.php', 'selp_options_page');
		add_filter( 'plugin_action_links', 'selp_filter_plugin_actions', 10, 2 );
		selp_set_options();
	}
}
add_action('admin_menu', 'selp_setup');


/* selp_filter_plugin_actions() - Adds a "Settings" action link to the plugins page */
function selp_filter_plugin_actions($links, $file){
	static $this_plugin;

	if( !$this_plugin ) $this_plugin = plugin_basename(__FILE__);

	if( $file == $this_plugin ){
		$settings_link = '<a href="admin.php?page=seriallinks-plugin.php">' . __('Settings') . '</a>';
		$links = array_merge( array($settings_link), $links); // before other links
	}
	return $links;
}


/* Create the options and provide some defaults */
function selp_set_options() {
	// Provide some defaults
	$selp_new_options = array(
		'pre_text' => 'You are reading',
		'post_text' => 'Read more from this series of articles.',
		'ul_class' => 'serial-links',
		'list_current' => '1',
		'link_current' => '0',
		'reset' => 'false',
	);
	
	add_option('selp_plugin_settings', $selp_new_options );
}


// Only for WP versions less than 2.7
//Delete the options when plugin is deactivated 
function selp_unset_options() {
	delete_option('selp_plugin_settings');
}

// Determine whether to register deactivation hook
//if installed on pre 2.7 WP. 
// Are we in WP 2.7+ ?
if ( function_exists('register_uninstall_hook') ) {
     // We are in 2.7+, so do nothing
} else {
	// we're in < 2.7 so register the deactivation hook
     register_deactivation_hook(__FILE__, 'selp_unset_options');
}	


/* Display and handle the options page */
function selp_options_page(){
	// Are we in WPMU?
	if ( function_exists('wpmu_create_blog') ) {
		// Yes, load the WPMU options page
		include_once('selp-wpmu-ui.php');
		// No, load the WP options page
		} else { include_once('selp-wp-ui.php');
	}
}
