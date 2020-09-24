<?php
    $cookies_policy_options = get_option( 'cookies_policy_options' );
    $cookies_policy_message = $cookies_policy_options['message'];
    $cookies_policy_link    = $cookies_policy_options['link'];
    $cookies_policy_link_message = $cookies_policy_options['link_message'];
    $cookies_policy_button_text = $cookies_policy_options['button_text']
?>
<div class="permission-use-cookies" role="dialog" id="allow-cookies-policy-component">
    <div class="permission-use-cookies-content">
        <span  class="permission-use-cookies-message">
            <?php echo($cookies_policy_message) ?>,
            <a  href="<?php echo($cookies_policy_link)?>" class="permission-use-cookies-message-link"><?php echo($cookies_policy_link_message) ?></a>
        </span>
        <div class="permission-use-cookies-actions">
            <a id="allow-cookies-button" role="button" tabindex="0" class="permission-use-cookies-button"><?php echo($cookies_policy_button_text)?></a>
        </div>
    </div>
</div>

