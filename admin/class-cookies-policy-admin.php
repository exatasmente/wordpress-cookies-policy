<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       github.com/exatasmente
 * @since      1.0.0
 *
 * @package    Cookies_Policy
 * @subpackage Cookies_Policy/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cookies_Policy
 * @subpackage Cookies_Policy/admin
 * @author     exatasmente <luizneto@rits.com.br>
 */
class Cookies_Policy_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version
	 */
	private $version;

    /**
     * Plugin options
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version
     */
    private $cookies_options;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name
	 * @param      string    $version
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


    public function cookies_add_plugin_page() {
        add_options_page(
            'Cookies', // page_title
            'Cookies', // menu_title
            'manage_options', // capability
            'cookies', // menu_slug
            array( $this, 'cookies_create_admin_page' ) // function
        );
    }

    public function cookies_create_admin_page() {
        $this->cookies_options = get_option( 'cookies_policy_options' );
        ?>
        <div class="wrap">
            <h2>Cookies</h2>
            <p>Política de Cookies </p>
            <?php settings_errors(); ?>

            <form method="post" action="options.php">
                <?php
                settings_fields( 'cookies_option_group' );
                do_settings_sections( $this->plugin_name.'options' );
                submit_button();
                ?>
            </form>
        </div>
    <?php }

    public function cookies_page_init() {
        register_setting(
            'cookies_option_group', // option_group
            'cookies_policy_options', // option_name
            array( $this, 'cookies_sanitize' ) // sanitize_callback
        );

        add_settings_section(
            'cookies_setting_section', // id
            'Configirações', // title
            array( $this, 'cookies_section_info' ), // callback
            $this->plugin_name.'options' // page
        );

        add_settings_field(
            'domain', // id
            'Dominio', // title
            array( $this, 'domain_callback' ), // callback
            $this->plugin_name.'options', // page
            'cookies_setting_section' // section
        );
    }

    public function cookies_sanitize($input) {
        $sanitary_values = array();
        if ( isset( $input['domain'] ) ) {
            $sanitary_values['domain'] = sanitize_text_field( $input['domain'] );
        }

        return $sanitary_values;
    }

    public function cookies_section_info() {
        ?>
            <p>Informe o dominio do site principal, caso seja um subdominio. </p>
            <p>por exemplo o site <b>sub.exemplo.com</b> tem o Dominio <b>exemplo.com</b> </p>
        <?php
    }

    public function domain_callback() {
        printf(
            '<input class="regular-text" type="text" name="cookies_policy_options[domain]" id="domain" value="%s">',
            isset( $this->cookies_options['domain'] ) ? esc_attr( $this->cookies_options['domain']) : ''
        );
    }

}
