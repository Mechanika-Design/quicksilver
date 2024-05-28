<?php
/**
 * Optimization for media.
 *
 * @package Quicksilver
 * @author  Mechanika Design <info@mechanikadesign.com>
 * @link    https://mechanikadesign.com
 */

namespace Quicksilver;

/**
 * Media class.
 */
class Media {
	/**
	 * Add hooks.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'dequeue' ], 20 );

		// No styles for recent comments widget.
		add_filter( 'show_recent_comments_widget_style', '__return_false' );

		// Remove query string for resources.
		add_filter( 'script_loader_src', [ $this, 'remove_query_string' ] );
		add_filter( 'style_loader_src', [ $this, 'remove_query_string' ] );

		// Remove protocol for resources.
		add_filter( 'script_loader_src', [ $this, 'remove_protocol' ] );
		add_filter( 'style_loader_src', [ $this, 'remove_protocol' ] );
	}

	/**
	 * Dequeue unnecessary resources
	 */
	public function dequeue() {
		// Jetpack
		wp_dequeue_script( 'devicepx' );
	}

	/**
	 * Remove version for scripts and styles.
	 *
	 * @param string $url Resource URL.
	 *
	 * @return string
	 */
	public function remove_query_string( $url ) {
		return remove_query_arg( 'ver', $url );
	}

	/**
	 * Remove protocol for resources.
	 *
	 * @param string $url Resource URL.
	 *
	 * @return string
	 */
	public function remove_protocol( $url ) {
		return str_replace( [ 'https:', 'http:' ], '', $url );
	}
}