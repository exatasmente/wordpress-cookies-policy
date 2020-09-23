<?php

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Cookies_Policy
 * @subpackage Cookies_Policy/includes
 * @author     exatasmente <luizneto@rits.com.br>
 */
class Cookies_Policy_Deactivator {

	public static function deactivate() {
        delete_option('cookies_policy_options');
	}

}
