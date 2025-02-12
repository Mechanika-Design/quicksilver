<?php
/**
 * Plugin Name: Quicksilver
 * Plugin URI: http://mechanikadesign.com
 * Description: A WordPress cleanup and performance optimization plugin.
 * Version:     2.1.0
 * Author: Mechanika Design
 * Author URI: https://mechanikadesign.com
 * License: GPL2+
 * Text Domain: quicksilver
 * Domain Path: /languages/
 */

namespace Quicksilver;

define('QUICKSILVER_URL', plugin_dir_url(__FILE__));
define('QUICKSILVER_DIR', __DIR__);

require __DIR__ . '/vendor/autoload.php';

new Settings;

new General;
new Admin;
if ( ! is_admin() ) {
	new Header;
    new Assets;
}

add_action( 'init', function () {
	load_plugin_textdomain( 'quicksilver', false, plugin_basename( __DIR__ ) . '/languages/' );
} );