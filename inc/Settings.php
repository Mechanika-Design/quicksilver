<?php
/**
 * Plugin settings.
 *
 * @package Quicksilver
 * @author  Mechanika Design <info@mechanikadesign.com>
 * @link    https://mechanikadesign.com
 */

namespace Quicksilver;

/**
 * Settings class.
 *
 * @package Quicksilver
 */
class Settings {
	/**
	 * Add hooks to create settings page and register settings.
	 */
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_menu' ] );
		add_action( 'admin_init', [ $this, 'register_settings' ] );
	}

	/**
	 * Add plugin settings menu.
	 */
	public function add_menu() {
		add_options_page( esc_html__( 'Quicksilver', 'quicksilver' ), esc_html__( 'Quicksilver', 'quicksilver' ), 'manage_options', 'quicksilver', [ $this, 'render' ] );
	}

	/**
	 * Render settings page.
	 */
	public function render() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Quicksilver', 'quicksilver' ); ?></h1>
			<form method="POST" action="options.php">
				<?php
				settings_fields( 'quicksilver' );
				do_settings_sections( 'quicksilver' );
				submit_button( esc_html__( 'Save Changes', 'quicksilver' ) );
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register plugin settings.
	 */
	public function register_settings() {
		register_setting( 'quicksilver', 'quicksilver' );
		add_settings_section( 'async_css', esc_html__( 'Load CSS asynchronously', 'quicksilver' ), [ $this, 'render_async_css_section' ], 'quicksilver' );
		add_settings_field( 'async_css_handles', esc_html__( 'Stylesheet handles', 'quicksilver' ), [ $this, 'render_field' ], 'quicksilver', 'async_css' );
	}

	public function render_async_css_section() {
		?>
		<p><?php esc_html_e( 'The normal stylesheet loading causes most browsers to delay page rendering while the it loads. When the stylesheets are not critical to the initial rendering of a page, load them asynchronously make the page render faster.', 'quicksilver' ); ?></p>
		<?php
	}

	/**
	 * Render async CSS handle field.
	 */
	public function render_field() {
		$option  = get_option( 'quicksilver' );
		$handles = isset( $option['async_css_handles'] ) ? $option['async_css_handles'] : '';
		?>
		<input type="text" class="regular-text" name="quicksilver[async_css_handles]" value="<?= esc_attr( $handles ); ?>">
		<p class="description"><?= wp_kses_post( sprintf( __( 'Separate multiple handles with commas. To get the CSS handle, view the page source and look for <a href="%s" target="_blank">this</a>.', 'quicksilver' ), 'http://prnt.sc/cw30dr' ) ) ; ?></p>
		<?php
	}
}