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

		//Create custom role Table
		global $wpdb; 
		
		//Define table versions
		global $major_buyer_table_version;
		global $fixed_customer_table_version;
		global $request_table_version;
		$major_buyer_table_version = '1.0';
		$fixed_customer_table_version = '1.0';
		$request_table_version = '1.0';

		$charset_collate = $wpdb->get_charset_collate();
		$major_buyer_table_name = $wpdb->prefix . "major_buyer_custom_role_table";
		$fixed_customer_table_name = $wpdb->prefix . "fixed_customer_custom_role_table";
		$customer_requests_table_name = $wpdb->prefix . "customer_requests_custom_role_table";
		
		$sql_major_buyer_table = "CREATE TABLE IF NOT EXISTS `{$major_buyer_table_name}` (
			`id` mediumint(9) NOT NULL AUTO_INCREMENT,
			`customerid` mediumint(9) NOT NULL,
			`username` tinytext NOT NULL,
			PRIMARY KEY  (id)
		    ) $charset_collate;";
		    
		    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		    dbDelta( $sql_major_buyer_table );

		add_option( 'major_buyer_table_version', $major_buyer_table_version);

		$sql_fixed_customer_table = "CREATE TABLE IF NOT EXISTS `{$fixed_customer_table_name}` (
			`id` mediumint(9) NOT NULL AUTO_INCREMENT,
			`customerid` mediumint(9) NOT NULL,
			`username` tinytext NOT NULL,
			PRIMARY KEY  (id)
		    ) $charset_collate;";
		    
		    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		    dbDelta( $sql_fixed_customer_table );
		    
		add_option( 'fixed_customer_table_version', $fixed_customer_table_version);


		$sql_requests_customer_table = "CREATE TABLE IF NOT EXISTS `{$customer_requests_table_name}` (
			`id` mediumint(9) NOT NULL AUTO_INCREMENT,
			`customerid` mediumint(9) NOT NULL,
			`username` tinytext NOT NULL,
			`request_type` tinytext NOT NULL,
			PRIMARY KEY  (id)
		    ) $charset_collate;";
		    
		    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		    dbDelta( $sql_requests_customer_table );    
		    
		add_option( 'request_table_version', $request_table_version);
	
	}

}
