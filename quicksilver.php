<?php
/**
 * Plugin Name: Quicksilver
 * Plugin URI: http://mechanikadesign.com
 * Description: A WordPress cleanup and performance optimization plugin.
 * Version:     2.0.2
 * Author: Mechanika Design
 * Author URI: https://mechanikadesign.com
 * License: GPL2+
 * Text Domain: quicksilver
 * Domain Path: /languages/
 */

namespace Quicksilver;
require __DIR__ . '/vendor/autoload.php';

new General;
new Settings;

if ( Settings::is_feature_active( 'no_embeds' ) ) {
	require __DIR__ . '/vendor/disable-embeds/disable-embeds.php';
}

if ( ! is_admin() ) {
	new Header;
}

add_action( 'init', function () {
	load_plugin_textdomain( 'quicksilver', false, plugin_basename( __DIR__ ) . '/languages/' );
} );