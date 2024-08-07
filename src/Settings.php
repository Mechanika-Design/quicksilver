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
	                    <?php
	                    $this->checkbox( 'no_gutenberg', __( 'Disable Gutenberg (the block editor)', 'quicksilver' ) );
	                    $this->checkbox( 'no_heartbeat', __( 'Disable heartbeat', 'quicksilver' ) );
	                    $this->checkbox( 'no_xmlrpc', __( 'Disable XML-RPC', 'quicksilver' ) );
	                    $this->checkbox( 'no_emojis', __( 'Disable emojis', 'quicksilver' ) );
	                    $this->checkbox( 'no_embeds', __( 'Disable embeds, e.g. prevent others from embedding your site and vise-versa', 'quicksilver' ) );
	                    $this->checkbox( 'no_self_pings', __( 'Disable self pings', 'quicksilver' ) );
	                    $this->checkbox( 'no_query_string', __( 'Remove query string for JavaScript and CSS files', 'quicksilver' ) );
	                    $this->checkbox( 'schema_less_urls', __( 'Set scheme-less URLs for JavaScript and CSS files, e.g. remove <code>http:</code> and <code>https:</code> from URLs', 'quicksilver' ) );
	                    $this->checkbox( 'no_recent_comments_widget_style', __( 'Removes styles for recent comments widget', 'quicksilver' ) );
	                    $this->checkbox( 'no_jquery_migrate', __( 'Removes jQuery Migrate', 'quicksilver' ) );
	                    ?>

                        <h3><?php esc_html_e( 'Header Cleanup', 'quicksilver' ) ?></h3>
	                    <?php
	                    $this->checkbox( 'no_feed_links', __( 'Remove feed links', 'quicksilver' ) );
	                    $this->checkbox( 'no_rsd_link', __( 'Remove RSD link', 'quicksilver' ) );
	                    $this->checkbox( 'no_wlwmanifest_link', __( 'Remove wlwmanifest link', 'quicksilver' ) );
	                    $this->checkbox( 'no_adjacent_posts_links', __( 'Remove adjacent posts links', 'quicksilver' ) );
	                    $this->checkbox( 'no_wp_generator', __( 'Remove WordPress version number', 'quicksilver' ) );
	                    $this->checkbox( 'no_shortlink', __( 'Remove shortlink', 'quicksilver' ) );
	                    ?>
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

	private function checkbox( $name, $label ) {
		?>
        <p>
            <label>
                <input type="checkbox" name="quicksilver[features][]" value="<?= esc_attr( $name ) ?>"<?php checked( self::is_feature_active( $name ) ) ?>>
				<?= esc_html( $label ) ?>
            </label>
        </p>
		<?php
	}
}