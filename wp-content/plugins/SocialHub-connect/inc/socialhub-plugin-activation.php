<?php
/**
 *
 *
 * @package SocialHub
 *
 */
class SocialHubPluginActivate {
    public static function activate() {
        // Set default options when activating the plugin
        $default_options = array(
            'socialhub_text_field' => 'Default Value',
        );
        add_option('socialhub_options', $default_options);
    }
}
