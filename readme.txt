=== Display Post Meta ===

Contributors: BrashRebel, bretterer
Donate link: http://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=admin%40realbigmarketing%2ecom
Tags: post meta, custom fields, taxonomies
Requires at least: 3.0.0
Tested up to: 4.1
Stable tag: 1.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html



== Description ==


This plugin was designed for the purpose of outputting the meta data associated with a WP post or page so developers and site designers can verify what information is available.

To use this plugin, simply activate then either simply navigate to a post, page or custom post type and then click on the "DPM" link in the toolbar. For those who have the toolbar disabled, setting show_meta=true in the URL will activate the meta display. Example:

`http://example.com/test-post/?show_meta=true`

If you are interested in learning about the other plugins we have created and/or are working on and would like to know about new releases and special offers we have, please [subscribe here](http://eepurl.com/3KR1D).

== Installation ==


Using this plugin is very simple. All you have to do is:


1. Upload the `display-post-meta` folder to the `/wp-content/plugins/` directory

2. Activate the plugin through the 'Plugins' menu in WordPress

3. Navigate to any Post or Page on your website and click on the "DPM" link in the toolbar.



== Frequently Asked Questions ==


= What is this plugin for? =


When working with WordPress it is often useful to view the meta data that is being associated with a given post or page. This can be helpful especially when designing templates and other such things. This plugin simply outputs in a  visual way, all the data it can find.


= What can we expect in future releases? =


* A better looking design.

* Choices for how you would like to the data to be displayed.

* More detailed data pertaining to the current post.



== Screenshots ==

1. screenshot-1.png

Data is output in tabs on the side of the screen that reveal more on hover.

2. screenshot-2.png

Data is output inline via the Post Meta link (not present in all themes).

== Changelog ==

= 1.5 =

* Check to ensure user is an administrator before displaying content or button rather than just logged in
* Don't show the toolbar button on archives, admin pages and others where it doesn't make sense
* Show the toolbar button for small screens (was hidden)
* Add a Post Meta link next to the Edit post link on the front end
* Show meta data inline when Post Meta link is clicked

= 1.4 =

* Added "Other" section which includes post info like author, published date, ID and current template
* Added some sanitization for increased security
* Refactored lots of the core code for more clarity and flexibility
* Added a close button on the info screen

= 1.3.1 =

* Placed all core functions into a class
* Improved WordPress coding standards compliance

= 1.3 =

* Lots of styling adjustments
* Output content on `wp_footer` hook instead of `wp` (which was so dumb)
* Better naming and modulation of functions
* Add support for custom taxonomies on all post types
* Greatly improved display of custom field data
* Removed the `[show_meta]` shortcode
* Add clarifying statement if no custom fields

= 1.2.0 = 

* Some updates to fix the function of DPM button
* Add active style to the DMP Button

= 1.1.4 =

* Ability added to close DPM window by clicking on 'DPM' from the admin bar

= 1.1.3 =

* Fix for a few undefined index errors showing when in debug mode.

= 1.1.2 =

* Register stylesheet
* Enqueue stylesheet if `show_meta` query parameter is equal to true

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

= 1.5 =

* Improved conditional button rendering
* Inline option for displaying meta data
* Tighter security measures