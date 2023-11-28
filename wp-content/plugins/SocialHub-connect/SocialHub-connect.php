<?php
/*
 * Plugin Name:       SocialHub Connect
 * Plugin URI:
 * Description:       SocialHub Connect est un plugin WordPress qui facilite la gestion et l'intégration des interactions sociales directement depuis votre site web. Il permet aux utilisateurs de connecter et de synchroniser leurs profils de médias sociaux (Facebook, Twitter, Instagram, LinkedIn, etc.) avec leur compte WordPress.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mouadh Aouiti
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die( 'you can\t acces to this file' );

class SocialHubPlugin{
    //contructeur
    function __construct(){
        add_action('admin_enqueue_scripts',array($this,'enqueue'));// declaration of scripts files like css and js
    }
    function enqueue(){
        //enqueue all your scripts
        wp_enqueue_style('mypluginstyle',plugins_url('/public/mystyle.css', __FILE__ ));
        wp_enqueue_script('mypluginscript',plugins_url('/public/myscript.js', __FILE__ ));
    }
}
add_action('admin_menu', 'social_hub_menu');
function social_hub_menu() {
    add_menu_page(
        'SocialHub Connect',
        'SocailHub Connect',
        'manage_options',
        'socialhub-connect-settings',
        'socialhub_settings_page'
    );
}
function socialhub_settings_page() {
    ?>
    <div class="wrap">
        <h2>SocialHub Connect</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('social_hub_settings');
            do_settings_sections('socialhub-connect-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
if ( class_exists( 'SocialHubPlugin' )){
    $SocialHubPlugin = new SocialHubPlugin();
}
add_action('admin_init', 'my_plugin_settings');

function my_plugin_settings() {
    register_setting('my_plugin_settings', 'my_option_name');
    add_settings_section('socialhub_connect', 'General Settings', 'socialhub_connect_callback', 'socialhub-connect-settings');
   //add_settings_field('my_field_id', 'My Field Label', 'my_field_callback', 'socialhub-connect-settings', 'socialhub_connect');
   add_settings_field('my_field_id', 'dashboard', 'socialhub_connect_dashboard', 'socialhub-connect-settings', 'socialhub_connect');
}

function socialhub_connect_callback() {

  //  echo 'This is the description for my settings section.';
}


function my_sanitize_callback($input) {
    return $input;
}
function socialhub_connect_dashboard() {
    include_once(plugin_dir_path(__FILE__) . 'dashboard.php');
}


//activation
require_once plugin_dir_path(__FILE__).'inc/socialhub-plugin-activation.php';
register_activation_hook(__FILE__,array( 'SocialHubPluginActivate', 'activate' ));


//desactivation
require_once plugin_dir_path(__FILE__).'inc/socialhub-plugin-desactivation.php';
register_deactivation_hook(__FILE__,array('SocialHubPluginDeactivate' , 'desactivate' ));