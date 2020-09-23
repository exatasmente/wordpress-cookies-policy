<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Cookies_Policy
 * @subpackage Cookies_Policy/includes
 * @author     exatasmente <luizneto@rits.com.br>
 */
class Cookies_Policy_Activator {

	public static function activate() {
        add_option('cookies_policy_options','');
	}

}
