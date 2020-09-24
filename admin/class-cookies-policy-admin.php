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
            'cookies_setting_section',
            'Configurações',
            array( $this, 'cookies_section_info' ),
            $this->plugin_name.'options'
        );

        add_settings_field(
            'domain',
            'Domínio',
            array( $this, 'domain_callback' ),
            $this->plugin_name.'options',
            'cookies_setting_section'
        );
        add_settings_field(
            'message',
            'Mensagem',
            array( $this, 'message_callback' ),
            $this->plugin_name.'options',
            'cookies_setting_section'
        );
        add_settings_field(
            'link',
            'Link Política de Privacidade',
            array( $this, 'link_callback' ),
            $this->plugin_name.'options',
            'cookies_setting_section'
        );
        add_settings_field(
            'link_message',
            'Texto do Link',
            array( $this, 'link_message_callback' ),
            $this->plugin_name.'options',
            'cookies_setting_section'
        );
        add_settings_field(
            'button_text',
            'Texto do Botão',
            array( $this, 'button_text_callback' ),
            $this->plugin_name.'options',
            'cookies_setting_section'
        );
    }

    public function cookies_sanitize($input) {
        $sanitary_values = array();
        if ( isset( $input['domain'] ) ) {
            $sanitary_values['domain'] = sanitize_text_field( $input['domain'] );
        }
        if ( isset( $input['message'] ) ) {
            $sanitary_values['message'] = sanitize_text_field( $input['message']);
        }
        if ( isset( $input['link'] ) ) {
            $sanitary_values['link'] = sanitize_text_field( $input['link']);
        }
        if ( isset( $input['link_message'] ) ) {
            $sanitary_values['link_message'] = sanitize_text_field( $input['link_message']);
        }
        if ( isset( $input['button_text'] ) ) {
            $sanitary_values['button_text'] = sanitize_text_field( $input['button_text']);
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
    public function message_callback() {
        printf(
            '<input class="regular-text" type="text" name="cookies_policy_options[message]" id="message" value="%s">',
            isset( $this->cookies_options['message'] ) ? esc_attr( $this->cookies_options['message']) : ''
        );
    }

    public function link_callback() {
        printf(
            '<input class="regular-text" type="text" name="cookies_policy_options[link]" id="link" value="%s">',
            isset( $this->cookies_options['link'] ) ? esc_attr( $this->cookies_options['link']) : ''
        );
    }
    public function link_message_callback() {
        printf(
            '<input class="regular-text" type="text" name="cookies_policy_options[link_message]" id="link_message" value="%s">',
            isset( $this->cookies_options['link_message'] ) ? esc_attr( $this->cookies_options['link_message']) : ''
        );
    }
    public function button_text_callback() {
        printf(
            '<input class="regular-text" type="text" name="cookies_policy_options[button_text]" id="button_text" value="%s">',
            isset( $this->cookies_options['button_text'] ) ? esc_attr( $this->cookies_options['button_text']) : ''
        );
    }




}
