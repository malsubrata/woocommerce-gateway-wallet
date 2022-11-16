<?php
/**
 * Plugin Name: WooCommerce Wallet Payments Gateway
 * Plugin URI: https://satandalonetech.com/
 * Description: Adds the Wallet Payments gateway to your WooCommerce checkout block.
 * Version: 1.0.0
 *
 * Author: StandaloneTech
 * Author URI: https://satandalonetech.com/
 *
 * Text Domain: woocommerce-gateway-wallet
 * Domain Path: /languages/
 *
 * Requires at least: 4.2
 * Tested up to: 4.9
 *
 * Copyright: © 2022 Standalone Tech Solutions.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package WooWallet
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WC Dummy Payment gateway plugin class.
 *
 * @class WC_Wallet_Payments
 */
class WC_Wallet_Payments {

	/**
	 * Plugin bootstrapping.
	 */
	public static function init() {
		// Registers WooCommerce Blocks integration.
		add_action( 'woocommerce_blocks_loaded', array( __CLASS__, 'woocommerce_gateway_dummy_woocommerce_block_support' ) );

	}

	/**
	 * Plugin url.
	 *
	 * @return string
	 */
	public static function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	 * Plugin url.
	 *
	 * @return string
	 */
	public static function plugin_abspath() {
		return trailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Registers WooCommerce Blocks integration.
	 */
	public static function woocommerce_gateway_dummy_woocommerce_block_support() {
		if ( class_exists( 'Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType' ) ) {
			require_once 'includes/class-wc-wallet-payments-blocks.php';
			add_action(
				'woocommerce_blocks_payment_method_type_registration',
				function( Automattic\WooCommerce\Blocks\Payments\PaymentMethodRegistry $payment_method_registry ) {
					$payment_method_registry->register( new WC_Gateway_Wallet_Blocks_Support() );
				}
			);
		}
	}
}

WC_Wallet_Payments::init();
