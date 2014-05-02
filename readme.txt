=== Display Post Meta ===

Contributors: BrashRebel

Tags: post meta, custom fields, taxonomies

Requires at least: 3.0.0

Tested up to: 3.5.2

Stable tag: 1.1.1

License: GPLv2 or later

License URI: http://www.gnu.org/licenses/gpl-2.0.html



== Description ==



This plugin was designed for the purpose of outputting the meta data associated with a WP post or page so developers and site designers can verify what information is available.

To use this plugin, simply activate then either simply navigate to a post, page or custom post type and then click on the "DPM" link in the toolbar. For those who have the toolbar disabled, setting show_meta=true in the URL will activate the meta display. Example:

`http://example.com/test-post/?show_meta=true`



== Installation ==



Using this plugin is very simple. All you have to do is:


1. Upload the `display-post-meta` folder to the `/wp-content/plugins/` directory

1. Activate the plugin through the 'Plugins' menu in WordPress

1. Navigate to any Post or Page on your website and click on the "DPM" link in the toolbar.



== Frequently Asked Questions ==



= What is this plugin for? =



When working with WordPress it is often useful to view the meta data that is being associated with a given post or page. This can be helpful especially when designing templates and other such things. This plugin simply outputs in a  visual way, all the data it can find.



= What can we expect in future releases? =



* Better support for custom taxonomies.

* A better looking design.

* Choices for how you would like to the data to be displayed.



== Screenshots ==

1. screenshot-1.png

Data is output in tabs on the side of the screen that reveal more on hover.



== Changelog ==

= 1.1.1 =

* Better function names
* DPM link actually adds a query arg instead of just appending to the URL
* Display now looks for the show_meta query parameter instead of parsing the URL

= 1.1 =

* Better CSS
* Fixed taxonomy loop to no longer nest

= 1.0 =


* Initial release.



== Upgrade Notice ==

= 1.1 =