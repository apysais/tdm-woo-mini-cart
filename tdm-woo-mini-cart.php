<?php

/**
 * The plugin bootstrap file
 *
 * Description
 *
 * @link              http://thedigitalmarketers.com.au/
 * @since             1.0.0
 * @package           Tdm_Woo_Mini_Cart
 *
 * @wordpress-plugin
 * Plugin Name:       TDM WOO Mini Cart
 * Plugin URI:        http://thedigitalmarketers.com.au/
 * Description:       Display Woocommerce mini cart in sidebars with widget support.
 * Version:           1.0.0
 * Author:            TDM
 * Author URI:        http://thedigitalmarketers.com.au/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tdm-woo-mini-cart
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TDM_WOO_MINI_CART_VERSION', '1.0.0' );

/**
 * For autoloading classes
 * */
spl_autoload_register('wmc_directory_autoload_class');
function wmc_directory_autoload_class($class_name){
		if ( false !== strpos( $class_name, 'WMC' ) ) {
	 $include_classes_dir = realpath( get_template_directory( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	 $admin_classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	 $class_file = str_replace( '_', DIRECTORY_SEPARATOR, $class_name ) . '.php';
	 if( file_exists($include_classes_dir . $class_file) ){
		 require_once $include_classes_dir . $class_file;
	 }
	 if( file_exists($admin_classes_dir . $class_file) ){
		 require_once $admin_classes_dir . $class_file;
	 }
 }
}
function wmc_get_plugin_details(){
 // Check if get_plugins() function exists. This is required on the front end of the
 // site, since it is in a file that is normally only loaded in the admin.
 if ( ! function_exists( 'get_plugins' ) ) {
	 require_once ABSPATH . 'wp-admin/includes/plugin.php';
 }
 $ret = get_plugins();
 return $ret['tdm-woo-mini-cart/tdm-woo-mini-cart.php'];
}
function wmc_get_text_domain(){
 $ret = wmc_get_plugin_details();
 return $ret['TextDomain'];
}
function wmc_get_plugin_dir(){
 return plugin_dir_path( __FILE__ );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tdm-woo-mini-cart-activator.php
 */
function activate_tdm_woo_mini_cart() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tdm-woo-mini-cart-activator.php';
	Tdm_Woo_Mini_Cart_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tdm-woo-mini-cart-deactivator.php
 */
function deactivate_tdm_woo_mini_cart() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tdm-woo-mini-cart-deactivator.php';
	Tdm_Woo_Mini_Cart_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tdm_woo_mini_cart' );
register_deactivation_hook( __FILE__, 'deactivate_tdm_woo_mini_cart' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tdm-woo-mini-cart.php';
require plugin_dir_path( __FILE__ ) . 'functions/nav-menu.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tdm_woo_mini_cart() {

	$plugin = new Tdm_Woo_Mini_Cart();
	$plugin->run();

	WMC_Widget::get_instance();
	//WMC_Sidebar::get_instance();

}
add_action('plugins_loaded', 'run_tdm_woo_mini_cart');
