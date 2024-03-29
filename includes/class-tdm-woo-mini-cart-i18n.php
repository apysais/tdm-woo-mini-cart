<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://thedigitalmarketers.com.au/
 * @since      1.0.0
 *
 * @package    Tdm_Woo_Mini_Cart
 * @subpackage Tdm_Woo_Mini_Cart/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Tdm_Woo_Mini_Cart
 * @subpackage Tdm_Woo_Mini_Cart/includes
 * @author     TDM <support@thedigitalmarketers.com.au>
 */
class Tdm_Woo_Mini_Cart_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tdm-woo-mini-cart',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
