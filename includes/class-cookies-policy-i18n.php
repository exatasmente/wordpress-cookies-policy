<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cookies_Policy
 * @subpackage Cookies_Policy/includes
 * @author     exatasmente <luizneto@rits.com.br>
 */
class Cookies_Policy_i18n {

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cookies-policy',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
