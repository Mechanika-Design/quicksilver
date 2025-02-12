=== Quicksilver ===
Contributors: Warren Galyen
Tags: optimization, optimize, optimizer, loading speed, performance, speed, clean, clean up, cleaner, ping, pingback, heartbeat, emoji, emojis
Requires at least: 5.9
Tested up to: 6.4.3
Stable tag: 2.0.2
Requires PHP: 5.6
License: GPLv2 or later

**Quicksilver** is a WordPress plugin which cleans up your website and optimizes it for better performance.

== Description ==

**Quicksilver** is a WordPress plugin which **cleans up your website and optimizes it for better performance**.

### Features

* Disable Gutenberg
* Disable XML-RPC
* Disable REST API
* Disable heartbeat
* Disable emojis
* Disable embeds, e.g. prevent others from embedding your site and vise-versa
* Disable self pings
* Remove query string for JavaScript and CSS files
* Set scheme-less URLs for JavaScript and CSS files, e.g. remove `http:` and `https:` from URLs
* Removes styles for recent comments widget.
* Cleanup header

To configure the async CSS loading, go to *Settings | Quicksilver*.

**Quicksilver** is created and maintained FREE on [Github](https://github.com/mechanika-design/quicksilver). Please open a [new issue](https://github.com/mechanika-design/quicksilver/issues) to add a suggestion or report a bug.

== Installation ==

1. Unzip the download package
1. Upload `quicksilver` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

The plugin doesn't have any settings page or configuration. Just install and forget!

== Frequently Asked Questions ==

== Screenshots ==

== Changelog ==

= 2.0.2 =
- Update compatibility tag
- Fix missing vendor folder

= 2.0.1 =
- Fix PHP warning when blocking self-pings

= 2.0.0 =
- Re-add settings page
- Update disable embeds module

= 1.3.1 =
* Fix not working with WP-CLI

= 1.3.0 =
* Remove settings page
* Do not use jQuery from Google CDN for better compatibility
* Remove support for loading CSS async

= 1.2.2 =
* Add option to use latest version of jQuery
* Add option to exclude static resources from removing query string

= 1.2.1 =
* Fix: Load PHP file using absolute path.

= 1.2 =
* New: Load CSS asynchronously (and selectively).
* Fix: No error in the login page.
* Requires PHP 5.4

= 1.1.1 =
* Fix not loading file for media.

= 1.1
* Remove Jetpack devicex script.
* Requires PHP 5.9.

= 1.0.1 =
* Sets scheme-less URLs for JS and CSS files, e.g. removes 'http:' and 'https:' from URLs.

= 1.0.0 =
* Initial release

== Upgrade Notice ==