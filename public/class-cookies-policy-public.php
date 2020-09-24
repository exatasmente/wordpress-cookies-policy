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
    }

    public function allow_cookies()
    {
        $domainOption = get_option('cookies_policy_options');
        $domain = $_SERVER['HTTP_HOST'];
        if( isset($domainOption['domain']) ){
            $domain = $domainOption['domain'];
        }

        $cookie = isset($_COOKIE['permission_use_cookies']) ? $_COOKIE['permission_use_cookies'] : null;
        $allow  = isset($_COOKIE['allow_cookies']) ? $_COOKIE['allow_cookies'] : null;
        if ( $allow && $cookie == null ) {
            setcookie( "permission_use_cookies","allow", time()*5, "/",'.'.$domain,false,true);
        }else if ($cookie == null) {
            $this->cookies_html();
        }

    }

	public function cookies_html(){
	    function add_cookie_html_message()
        {
            include_once('partials/cookies-policy-public-display.php');
        }
        function add_js_cookie(){
            wp_enqueue_script('js-cookie',"https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js",array(),'',false);
        }
        add_action('wp_head','add_js_cookie');
        add_action('wp_footer', 'add_cookie_html_message');
    }

}
