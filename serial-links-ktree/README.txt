=== Serial Links ===

Version: 1.0
Author: Ramana Raju.S, KTree Computer Solutions Inc.
Author page: http://wordpress.ktree.com/
Plugin page: http://wordpress.ktree.com/serial-posts-plugin.html
Tags: posts,series,serial,related,post listings,custom
Requires at least: 2.5
Tested up to: 2.8.3 (WP) and 2.8.3 (WPMU)
Stable tag: 1.0

Allows you to assign Links posts to a Serial, using custom fields, and then displays a list of all Links assigned to the same Serial in your single post page (usually single.php or index.php).


== Description==

This plugin allows you to assign a Serial name, using custom fields, to your posts and then automatically displays a list of other links posts which have the same Serial name when viewing this post. You can create as many Serial Links as you need, therefore allowing you to create multiple groupings of links. Designed for authors who wish to group links into series - independantly of the usual Wordpress Category and Tag structure - its usage does not have to be limited to this. You can create as many different Serial Links as you wish, and assign these to any posts that you wish to group together to create a wide variety of "related links" or other link groupings. 


**Key Features**
----------------

* Allows you to assign Links posts to a Serial, using custom fields, and then displays a list of all Links assigned to the same Serial in your single post page (usually single.php or index.php).
* The Serial Links list is added to your single post page either by inserting the [seriallinks] shortcode in the Post editor or by using the Serial Links template tag in your single.php or index.php theme file.
* The position of the Serial Links list on your page is determined by where you insert the shortcode in your post, or where you insert the Serial Links template tag in your single.php or index.php template file, depending on which method is used (shortcode or template tag).
* You can create as many different Serial Links as you wish.
* User options for including the currently viewed post in the list, with or without a link.
* Configurable Heading for the Serial Links list.
* Valid xhtml output.
* Highly customisable CSS styling of the Heading and Serial Links list. 
* Compatible with Wordpress Mu.

**Further information**
-----------------------
Comprehensive information on installing, configuring and using the plugin can be found at http://wordpress.ktree.com


== Installation ==

1. Download the latest version of the plugin to your computer.
2. Extract and upload the folder **serial-links** and its contents to your **/wp-content/plugins/** directory.  Please ensure that you do not rename any folder or filenames in the process.
3. Activate the plugin in your Dashboard via the Admin **Plugins** menu.
4. Configure the plugin's Settings page in Admin **Settings**.

**Upgrading from an older version**
-----------------------------------

You can use the Wordpress Automatic Plugin upgrade link in the Admin Plugins menu to automatically upgrade the plugin. 


== Instructions for use ==


== Using the plugin == 

The plugin provides two methods: a shortcode and a template tag, either of which may be used. It is recommended that you use one or the other, but not both, in accordance with your needs and preferences.

**Template tag:** Add this template tag to your single post theme template file, typically single.php or index.php, wherever you want to display the list of posts. This tag must appear within the Loop.

&lt;?php serial_links(); ?&gt;

**Shortcode:** Add this shortcode directly into the post editor when writing or editing a post.

[seriallinks]


== Configuration and set-up ==


Further information can be found at http://wordpress.ktree.com/serial-links-configuration.html and a comprehensive "how to" at http://wordpress.ktree.com/serial-links-plugin-tutorial.html


**Configuring the Options page**
--------------------------------
 
In the Dashboard, go to Settings and open the Serial Links Configuration page.

**List Display options**. This is where you can customise the Serial Links heading and list of posts. The Heading is made up of three elements: "Text before Serial name" "Serial Name" "Text after Serial name". 

**Text before Serial name**: Enter the text that you would like to appear in the Heading BEFORE the Serial name. If you don't want to show any text before the Serial name, just blank out the field before saving your settings.

**Text after Serial name**: Enter the text that you would like to appear in the Heading AFTER the Serial name. If you don't want to show any text after the Serial name, just blank out the field before saving your settings.

**List &lt;ul&gt; class**: To allow even greater control over the styling of the unordered list, you may specify a class name for the list's &lt;ul&gt; tag. The default is serial-links. Note that the plugin replaces any whitespace with hyphens.


**Reset all options to the Default settings**: Check this box if you want to rest all the options to their default settings.

That's it!  The Settings Page is now configured.


== Frequently Asked Questions ==

**So, what does it do?**
------------------------
* Allows you to assign links to a Serial, using custom fields, and then displays a list of all links assigned to the same Serial in your single post page (usually single.php or index.php).
* The position of the Serial Links list on your page is determined by where you insert the shortcode in your post, or where you insert the Serial Links template tag in your single.php or index.php template file, depending on which method is used (shortcode or template tag).
* Designed for authors who wish to group Links into series - independantly of the usual Wordpress Category and Tag structure - its usage does not have to be limited to this. You can create as many different Serial Links as you wish, and assign these to any posts that you wish to group together to create a wide variety of "related links" or other link groupings.


**Download**
------------

Latest stable version is version 1.0 available from 


**Troubleshooting**
-------------------

The following points should be noted:

1. Although you can create as many different Serials as you wish, do not assign a post to more than one Serial. 

2. The list of links is displayed in ascending order, ie oldest links at the top of the list. This cannot currently be changed by the user without hacking the plugin code. I may add a user Option for the links order in a future release.


**Support**
-----------

This plugin is provided free of charge without warranty.  In the event you experience problems you should visit the dedicated FAQ at http://wordpress.ktree.com/serial-links-plugin.html

If you cannot find a solution to a problem in the FAQ visit the support pageforum at http://wordpress.ktree.com/serial-links-plugin.html.  Support is provided in my free time but every effort will be made to respond to support queries as quickly as possible.

Thanks for downloading the plugin.  Enjoy!



== Technical Notes ==

* Language Support: This is not yet fully implemented in this version but is scheduled for a future release. (Sorry, ran out of time for this release!)  


== Acknowledgements ==

With acknowledgements to <a href="www.studiograsshopper.ch" title="Ade Walker">Ade Walker</a> whose original code idea inspired this plugin.