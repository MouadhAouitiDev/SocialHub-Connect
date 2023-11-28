<?php
/**
 *
 *
 * @package SocialHub
 *
 */
class SocialHubPluginDeactivate {
    public static function deactivate() {
        // Clean up options when deactivating the plugin
        delete_option('socialhub_options');
    }
}
