<?php
/**
 * Plugin Name: Quicksilver
 * Plugin URI: http://mechanikadesign.com
 * Description: A WordPress cleanup and performance optimization plugin.
 * Version: 1.3.1
 * Author: Mechanika Design
 * Author URI: https://mechanikadesign.com
 * License: GPL2+
 * Text Domain: quicksilver
 * Domain Path: /languages/
 *
 * @package Quicksilver
 */

namespace Quicksilver;
require __DIR__ . '/vendor/autoload.php';

new General;
new Embed;

if ( ! is_admin() ) {
	new Header;
	new Media;
}