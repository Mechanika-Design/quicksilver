<?php
/**
 * Plugin Name: Quicksilver
 * Plugin URI: http://mechanikadesign.com
 * Description: A WordPress cleanup and performance optimization plugin.
 * Version: 1.2.1
 * Author: Mechanika Design
 * Author URI: https://mechanikadesign.com
 * License: GPL2+
 * Text Domain: quicksilver
 * Domain Path: /languages/
 */

namespace Quicksilver;

require __DIR__ . '/inc/Autoloader.php';
$loader = new Autoloader;
$loader->addNamespace( 'Quicksilver', __DIR__ . '/inc' );
$loader->register();

new General;
new Embed;

if ( is_admin() ) {
	new Settings;
} else {
	new Header;
	new Media;
	new AsyncCSS;
}

// Load plugin textdomain.
add_action('init', function () {
	load_plugin_textdomain('quicksilver', false, plugin_basename(dirname(__FILE__)) . '/languages');
});