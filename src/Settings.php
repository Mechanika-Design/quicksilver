<?php
namespace Quicksilver;

class Settings {
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_menu' ] );
	}

	public function add_menu() {
		$page_hook = add_options_page( esc_html__( 'Quicksilver', 'quicksilver' ), esc_html__( 'Quicksilver', 'quicksilver' ), 'manage_options', 'quicksilver', [ $this, 'render' ] );
		add_action( "load-{$page_hook}", [ $this, 'save' ] );
	}

	public function render() {
		?>
		<div class="wrap">
			<h1><?= esc_html( get_admin_page_title() ) ?></h1>
			<form method="POST" action="">
				<?php wp_nonce_field( 'save' ) ?>
				<p><?php esc_html_e( 'Select the features you want the plugin to do to clean up your website and optimize for a better performance.', 'quicksilver' ); ?></p>

				<h3><?php esc_html_e( 'General', 'quicksilver' ) ?></h3>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="no_heartbeats"<?php checked( self::is_feature_active( 'no_heartbeats' ) ) ?>>
						<?php esc_html_e( 'Disable heartbeats', 'quicksilver' ) ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="no_emojis"<?php checked( self::is_feature_active( 'no_emojis' ) ) ?>>
						<?php esc_html_e( 'Disable emojis', 'quicksilver' ) ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="no_embeds"<?php checked( self::is_feature_active( 'no_embeds' ) ) ?>>
						<?php esc_html_e( 'Prevent others from embedding your site and vise-versa.', 'quicksilver' ) ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="no_self_pings"<?php checked( self::is_feature_active( 'no_self_pings' ) ) ?>>
						<?php esc_html_e( 'Disable self pings', 'quicksilver' ) ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="no_query_string"<?php checked( self::is_feature_active( 'no_query_string' ) ) ?>>
						<?php esc_html_e( 'Remove query string for JavaScript and CSS files', 'quicksilver' ) ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="schema_less_urls"<?php checked( self::is_feature_active( 'schema_less_urls' ) ) ?>>
						<?= wp_kses_post( __( 'Set scheme-less URLs for JavaScript and CSS files, e.g. remove <code>http:</code> and <code>https:</code> from URLs', 'quicksilver' ) ) ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="no_recent_comments_widget_style"<?php checked( self::is_feature_active( 'no_recent_comments_widget_style' ) ) ?>>
						<?= wp_kses_post( __( 'Removes styles for recent comments widget', 'quicksilver' ) ) ?>
					</label>
				</p>

				<h3><?php esc_html_e( 'Header Cleanup', 'quicksilver' ) ?></h3>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="no_feed_links"<?php checked( self::is_feature_active( 'no_feed_links' ) ) ?>>
						<?= wp_kses_post( __( 'Remove feed links', 'quicksilver' ) ) ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="no_rsd_link"<?php checked( self::is_feature_active( 'no_rsd_link' ) ) ?>>
						<?= wp_kses_post( __( 'Remove RSD link', 'quicksilver' ) ) ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="no_wlwmanifest_link"<?php checked( self::is_feature_active( 'no_wlwmanifest_link' ) ) ?>>
						<?= wp_kses_post( __( 'Remove wlwmanifest link', 'quicksilver' ) ) ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="no_adjacent_posts_links"<?php checked( self::is_feature_active( 'no_adjacent_posts_links' ) ) ?>>
						<?= wp_kses_post( __( 'Remove adjacent posts links', 'quicksilver' ) ) ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="no_wp_generator"<?php checked( self::is_feature_active( 'no_wp_generator' ) ) ?>>
						<?= wp_kses_post( __( 'Remove WordPress version number', 'quicksilver' ) ) ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="quicksilver[features][]" value="no_shortlink"<?php checked( self::is_feature_active( 'no_shortlink' ) ) ?>>
						<?= wp_kses_post( __( 'Remove shortlink', 'quicksilver' ) ) ?>
					</label>
				</p>
				<?php submit_button( esc_html__( 'Save Changes', 'quicksilver' ) ); ?>
			</form>
		</div>
		<?php
	}

	public function save() {
		if ( empty( $_POST['submit'] ) || ! check_ajax_referer( 'save', false, false ) ) {
			return;
		}

		$data = isset( $_POST['quicksilver'] ) ? $_POST['quicksilver'] : [];
		update_option( 'quicksilver', $data );
	}

	public static function is_feature_active( $feature ) {
		$data = get_option( 'quicksilver', null );
		return null === $data ? true : in_array( $feature, $data['features'], true );
	}
}