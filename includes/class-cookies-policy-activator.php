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
        add_option('cookies_policy_options',[
            'domain' => '',
            'message' => 'Nossos sites utilizam cookies para personalizar anúncios e melhorar a sua experiência. Ao continuar navegando, você concorda com a nossa,',
            'link_message' => 'Política de Utilização de Cookies.',
            'link' => '',
            'button_text' => 'Prosseguir'
        ]);
	}

}
