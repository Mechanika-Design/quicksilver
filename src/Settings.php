<?php

namespace Quicksilver;

class Settings
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_menu']);
    }

    public function add_menu()
    {
        $page = add_options_page(
            __('Quicksilver', 'quicksilver'),
            __('Quicksilver', 'quicksilver'),
            'manage_options',
            'quicksilver',
            [$this, 'render']
        );
        add_action("load-$page", [$this, 'save']);
        add_action("admin_print_styles-$page", [$this, 'enqueue']);
    }

    public function render()
    {
?>
        <div class="wrap">
            <h1><?= esc_html(get_admin_page_title()) ?></h1>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <form method="POST" action="" id="post-body-content">
                        <?php wp_nonce_field('save') ?>
                        <nav class="nav-tab-wrapper">
                            <a href="#tab-general" class="nav-tab nav-tab-active"><?php esc_html_e('General', 'quicksilver') ?></a></li>
                            <a href="#tab-header" class="nav-tab"><?php esc_html_e('Header', 'quicksilver') ?></a></li>
                            <a href="#tab-assets" class="nav-tab"><?php esc_html_e('Assets', 'quicksilver') ?></a></li>
                            <a href="#tab-admin" class="nav-tab"><?php esc_html_e('Admin', 'quicksilver') ?></a></li>
                        </nav>
                        <div class="tab-pane" id="tab-general">
                            <?php
                            $this->checkbox('no_gutenberg', __('Disable Gutenberg (the block editor)', 'quicksilver'));
                            $this->checkbox('no_rest_api', __('Disable REST API', 'quicksilver'));
                            $this->checkbox('no_heartbeat', __('Disable heartbeat', 'quicksilver'));
                            $this->checkbox('no_xmlrpc', __('Disable XML-RPC', 'quicksilver'));
                            $this->checkbox('no_emojis', __('Disable emojis', 'quicksilver'));
                            $this->checkbox('no_embeds', __('Disable embeds, e.g. prevent others from embedding your site and vise-versa', 'quicksilver'));
                            $this->checkbox('no_revisions', __('Disable revisions', 'quicksilver'));
                            $this->checkbox('no_self_pings', __('Disable self pings', 'quicksilver'));
                            ?>
                        </div>
                        <div class="tab-pane hidden" id="tab-header">

                            <?php
                            $this->checkbox('no_feed_links', __('Remove feed links', 'quicksilver'));
                            $this->checkbox('no_rsd_link', __('Remove RSD link', 'quicksilver'));
                            $this->checkbox('no_wlwmanifest_link', __('Remove wlwmanifest link', 'quicksilver'));
                            $this->checkbox('no_adjacent_posts_links', __('Remove adjacent posts links', 'quicksilver'));
                            $this->checkbox('no_wp_generator', __('Remove WordPress version number', 'quicksilver'));
                            $this->checkbox('no_shortlink', __('Remove shortlink', 'quicksilver'));
                            $this->checkbox('no_rest_link', __('Remove REST API link', 'quicksilver'));
                            ?>
                        </div>
                        <div class="tab-pane hidden" id="tab-assets">
                            <?php
                            $this->checkbox('no_query_string', __('Remove query string for JavaScript and CSS files', 'quicksilver'));

                            $this->checkbox('no_jquery_migrate', __('Removes jQuery Migrate', 'quicksilver'));
                            $this->checkbox('schema_less_urls', __('Set scheme-less URLs for JavaScript and CSS files, e.g. remove <code>http:</code> and <code>https:</code> from URLs', 'quicksilver'));
                            $this->checkbox('no_recent_comments_widget_style', __('Removes styles for recent comments widget', 'quicksilver'));

                            ?>
                        </div>
                        <div class="tab-pane hidden" id="tab-admin">
                            <?php
                            $this->checkbox('login_site_icon', __('Show site icon on login page', 'quicksilver'));
                            $this->checkbox('no_update_nags', __('Remove update nags', 'quicksilver'));
                            $this->checkbox('no_footer_text', __('Remove footer text', 'quicksilver'));
                            $this->checkbox('no_dashboard_widgets', __('Remove default dashboard widgets', 'quicksilver'));
                            $this->checkbox('no_wp_logo', __('Remove WordPress logo in the admin bar', 'quicksilver'));
                            $this->checkbox('no_admin_email_confirm', __('Remove admin email confirmation', 'quicksilver'));
                            ?>
                        </div>

                        <?php submit_button(esc_html__('Save Changes', 'quicksilver')); ?>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }

    public function enqueue()
    {
        wp_enqueue_style('quicksilver-settings', QUICKSILVER_URL . 'assets/settings.css', [], filemtime(QUICKSILVER_DIR . '/assets/settings.css'));
        wp_enqueue_script('quicksilver-settings', QUICKSILVER_URL . 'assets/settings.js', [], filemtime(QUICKSILVER_DIR . '/assets/settings.js'), true);
    }

    public function save()
    {
        if (empty($_POST['submit']) || ! check_ajax_referer('save', false, false)) {
            return;
        }

        $data = $_POST['quicksilver'] ?? [];
        update_option('quicksilver', $data);
        add_settings_error(null, 'quicksilver', __('Settings saved.', 'quicksilver'), 'success');
    }

    public static function is_feature_active(string $name): bool
    {
        $data = get_option('quicksilver', null);
        return null === $data ? true : in_array($name, $data['features'], true);
    }

    private function checkbox($name, $label)
    {
    ?>
        <p>
            <label class="switch">
                <input type="checkbox" name="quicksilver[features][]" value="<?= esc_attr($name) ?>" <?php checked(self::is_feature_active($name)) ?>>
                <span class="switch-icon"></span>
                <?= wp_kses_post($label) ?>
            </label>
        </p>
<?php
    }
}
