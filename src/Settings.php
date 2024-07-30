<?php
namespace Quicksilver;

class Settings {
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_menu' ] );
	}

	public function add_menu() {
		$page = add_options_page(
			__( 'Quicksilver', 'quicksilver' ),
			__( 'Quicksilver', 'quicksilver' ),
			'manage_options',
			'quicksilver',
			[ $this, 'render' ]
		);
		add_action( "load-$page", [ $this, 'save' ] );
	}

	public function render() {
		?>
        <div class="wrap">
            <h1><?= esc_html( get_admin_page_title() ) ?></h1>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <form method="POST" action="" id="post-body-content">
						<?php wp_nonce_field( 'save' ) ?>
                        <p><?php esc_html_e( 'Select the features you want the plugin to do to clean up your website and optimize for a better performance.', quicksilver ); ?></p>

                        <h3><?php esc_html_e( 'General', 'quicksilver' ) ?></h3>
                        <p>
                            <label>
                                <input type="checkbox" name="quicksilver[features][]" value="no_heartbeat"<?php checked( self::is_feature_active( 'no_heartbeat' ) ) ?>>
								<?php esc_html_e( 'Disable heartbeat', 'quicksilver' ) ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="quicksilver[features][]" value="no_xmlrpc"<?php checked( self::is_feature_active( 'no_xmlrpc' ) ) ?>>
			                    <?php esc_html_e( 'Disable XML-RPC', 'quicksilver' ) ?>
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
	                            <?php esc_html_e( 'Disable embeds, e.g. prevent others from embedding your site and vise-versa', 'quicksilver' ) ?>
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
	                            <?php esc_html_e( 'Removes styles for recent comments widget', 'quicksilver' ) ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="quicksilver[features][]" value="no_jquery_migrate"<?php checked( self::is_feature_active( 'no_jquery_migrate' ) ) ?>>
	                            <?php esc_html_e( 'Removes jQuery Migrate', 'quicksilver' ) ?>
                            </label>
                        </p>

                        <h3><?php esc_html_e( 'Header Cleanup', 'quicksilver' ) ?></h3>
                        <p>
                            <label>
                                <input type="checkbox" name="quicksilver[features][]" value="no_feed_links"<?php checked( self::is_feature_active( 'no_feed_links' ) ) ?>>
	                            <?php esc_html_e( 'Remove feed links', 'quicksilver' ) ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="quicksilver[features][]" value="no_rsd_link"<?php checked( self::is_feature_active( 'no_rsd_link' ) ) ?>>
	                            <?php esc_html_e( 'Remove RSD link', 'quicksilver' ) ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="quicksilver[features][]" value="no_wlwmanifest_link"<?php checked( self::is_feature_active( 'no_wlwmanifest_link' ) ) ?>>
	                            <?php esc_html_e( 'Remove wlwmanifest link', 'quicksilver' ) ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="quicksilver[features][]" value="no_adjacent_posts_links"<?php checked( self::is_feature_active( 'no_adjacent_posts_links' ) ) ?>>
	                            <?php esc_html_e( 'Remove adjacent posts links', 'quicksilver' ) ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="quicksilver[features][]" value="no_wp_generator"<?php checked( self::is_feature_active( 'no_wp_generator' ) ) ?>>
	                            <?php esc_html_e( 'Remove WordPress version number', 'quicksilver' ) ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="quicksilver[features][]" value="no_shortlink"<?php checked( self::is_feature_active( 'no_shortlink' ) ) ?>>
	                            <?php esc_html_e( 'Remove shortlink', 'quicksilver' ) ?>
                            </label>
                        </p>
						<?php submit_button( esc_html__( 'Save Changes', 'quicksilver' ) ); ?>
                    </form>
                    <div id="postbox-container-1" class="postbox-container">
                        <div class="postbox">
                            <h3 class="hndle">
                                <span><?php esc_html_e( 'Our WordPress Plugins', 'quicksilver' ) ?></span>
                            </h3>
                            <div class="inside">
                                <p><?php esc_html_e( 'Like this plugin? Check out our other WordPress plugins:', 'quicksilver' ) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

	public static function is_feature_active( string $name ) : bool {
		$data = get_option( 'quicksilver', null );
		return null === $data ? true : in_array( $name, $data['features'], true );
	}
}