<?php
/**
 * Plugin Name:     WooCommerce Delivery Slots by Kadence [Local Pickup Plus by SkyVerge]
 * Plugin URI:      https://iconicwp.com/products/woocommerce-delivery-slots/
 * Description:     Compatibility between WooCommerce Delivery Slots by Kadence and 'Local Pickup Plus' by SkyVerge.
 * Author:          Kadence
 * Author URI:      https://www.kadencewp.com/
 * Text Domain:     iconic-woo-delivery-slots-compat-local-pickup-plus
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Iconic_Woo_Delivery_Slots_Compat_Local_Pickup_Plus
 */


/**
 * Is Local Pickup plus active?
 *
 * @return bool
 */
function iconic_compat_local_pickup_plus_is_active() {
	return class_exists( 'WC_Local_Pickup_Plus_Loader' );
}

/**
 * Change format of the shipping method ID.
 *
 * @return array
 */
function iconic_compat_local_pickup_plus_update_shipping_method_id( $shipping_method_options ) {
	if ( ! iconic_compat_local_pickup_plus_is_active() ) {
		return $shipping_method_options;
	}

	$updated_shipping_method = array();

	foreach ( $shipping_method_options as $method_key => $method_name ) {
		if ( 'wc_shipping_local_pickup_plus' === $method_key ) {
			$method_key = 'local_pickup_plus';
		}

		$updated_shipping_method[ $method_key ] = $method_name;
	}

	return $updated_shipping_method;
}

add_filter( 'iconic_wds_shipping_method_options', 'iconic_compat_local_pickup_plus_update_shipping_method_id', 10 );
