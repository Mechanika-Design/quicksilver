<?php
/**
 * Plugin Name: Quicksilver
 * Plugin URI: http://mechanikadesign.com
 * Description: A WordPress cleanup and performance optimization plugin.
 * Version: 1.0.0
 * Author: Mechanika Design
 * Author URI: http://mechanikadesign.com
 * License: GPL2+
 * Text Domain: quicksilver
 * Domain Path: /lang/
 */

require plugin_dir_path( __FILE__ ) . 'inc/general.php';
new Quicksilver_General;

if ( ! is_admin() )
{
	require plugin_dir_path( __FILE__ ) . 'inc/frontend.php';
	new Quicksilver_Frontend;
}