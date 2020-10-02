<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Cookies_Policy
 * @subpackage Cookies_Policy/includes
 * @author     exatasmente <luizneto@rits.com.br>
 */
class Cookies_Policy {

    protected $loader;
    protected $plugin_name;
    protected $version;
    public function __construct() {
        if ( defined( 'COOKIES_POLICY_VERSION' ) ) {
            $this->version = COOKIES_POLICY_VERSION;
        } else {
            $this->version = '3.0.0';
        }
        $this->plugin_name = 'cookies-policy';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }


    private function load_dependencies() {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cookies-policy-loader.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cookies-policy-i18n.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cookies-policy-admin.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-cookies-policy-public.php';

        $this->loader = new Cookies_Policy_Loader();

    }


    private function set_locale() {

        $plugin_i18n = new Cookies_Policy_i18n();

        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

    }

    private function define_admin_hooks() {

        $plugin_admin = new Cookies_Policy_Admin( $this->get_plugin_name(), $this->get_version() );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'cookies_add_plugin_page' );
        $this->loader->add_action( 'admin_init', $plugin_admin, 'cookies_page_init' );
    }

    private function define_public_hooks() {
        $plugin_public = new Cookies_Policy_Public( $this->get_plugin_name(), $this->get_version());
        $this->loader->add_action('init', $plugin_public, 'cookies_policy_init');
    }
    public function run() {
        $this->loader->run();
    }


    public function get_plugin_name() {
        return $this->plugin_name;
    }


    public function get_loader() {
        return $this->loader;
    }


    public function get_version() {
        return $this->version;
    }

}
