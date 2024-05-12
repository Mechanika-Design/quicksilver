<?php
/**
 * Plugin Name: Quicksilver
 * Plugin URI: http://mechanikadesign.com
 * Description: A WordPress cleanup and performance optimization plugin.
 * Version: 1.1
 * Author: Mechanika Design
 * Author URI: http://mechanikadesign.com
 * License: GPL2+
 * Text Domain: quicksilver
 * Domain Path: /lang/
 */

namespace Quicksilver;

require plugin_dir_path( __FILE__ ) . 'inc/autoloader.php';
$loader = new Psr4AutoloaderClass;
$loader->addNamespace( 'Quicksilver', plugin_dir_path( __FILE__ ) . 'inc' );
$loader->register();

new General;
new Embed;

if ( ! is_admin() ) {
	new Header;
	new Media;
}