<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       github.com/exatasmente
 * @since      1.0.0
 *
 * @package    Cookies_Policy
 * @subpackage Cookies_Policy/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cookies_Policy
 * @subpackage Cookies_Policy/public
 * @author     exatasmente <luizneto@rits.com.br>
 */
class Cookies_Policy_Public {
    private $plugin_name;
    private $version;


    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }


    public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cookies-policy-public.css', array(), $this->version, 'all' );
    }

    public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cookies-policy-public.js', array( 'jquery' ), $this->version, true);
        add_action('wp_footer', array($this, 'load_html'));
        wp_localize_script( $this->plugin_name, 'cookies_message', ['html' => $this->cookies_html()]);
    }

    public function cookies_policy_init()
    {
        $cookie = isset($_COOKIE['permission_use_cookies']) ? $_COOKIE['permission_use_cookies'] : null;
        if (!$cookie && !is_admin()) {
            $this->enqueue_scripts();
            $this->enqueue_styles();

        }
    }

    public function cookies_html(){
        $cookies_policy_options = get_option( 'cookies_policy_options' );
        $cookies_policy_message = $cookies_policy_options['message'];
        $cookies_policy_link    = $cookies_policy_options['link'];
        $cookies_policy_link_message = $cookies_policy_options['link_message'];
        $cookies_policy_button_text = $cookies_policy_options['button_text'];

        return '<div class="permission-use-cookies" role="dialog" id="allow-cookies-policy-component">'
            .'<div class="permission-use-cookies-content">'
            .'<span  class="permission-use-cookies-message">'
            .$cookies_policy_message
            .'<a  href="'.$cookies_policy_link.'" target="_blank" class="permission-use-cookies-message-link">'.$cookies_policy_link_message.'</a>'
            .'</span>'
            .'<div class="permission-use-cookies-actions">'
            .'<a id="allow-cookies-button" role="button" tabindex="0" class="permission-use-cookies-button">'.$cookies_policy_button_text.'</a>'
            .'</div>'
            .'</div>'
            .'</div>';
    }
    public function load_html(){
        echo $this->cookies_html();
    }

}
