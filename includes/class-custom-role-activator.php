<?php

/**
 * Fired during plugin activation
 *
 * @link       https://egeekbin.com
 * @since      1.0.0
 *
 * @package    Custom_Role
 * @subpackage Custom_Role/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Custom_Role
 * @subpackage Custom_Role/includes
 * @author     Hamed Elahi <elahi.hamed@hotmail.com>
 */
class Custom_Role_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
				global $wp_roles;
				if ( ! isset( $wp_roles ) )
					$wp_roles = new WP_Roles();

				$customer_caps = $wp_roles->get_role('customer');
				//Adding a 'new_role' with all Customer caps
		$Major_Buyer_role = "Major buyer";
		$Fixed_Customer_role = "Fixed customer";
		if(!get_role($Major_Buyer_role)){
			$wp_roles->add_role($Major_Buyer_role, 'خریدار عمده', $customer_caps->capabilities);
		}
		if(!get_role($Fixed_Customer_role)){
			$wp_roles->add_role($Fixed_Customer_role, 'مشتری ثابت', $customer_caps->capabilities);
		}



	}

}
