<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://egeekbin.com
 * @since      1.0.0
 *
 * @package    Custom_Role
 * @subpackage Custom_Role/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Custom_Role
 * @subpackage Custom_Role/public
 * @author     Hamed Elahi <elahi.hamed@hotmail.com>
 */
class Custom_Role_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Role_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Role_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-role-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Role_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Role_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-role-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'custom-role-checkbox', plugin_dir_url( __FILE__ ) . 'js/custom-role-checkbox.js', array( 'jquery' ), null, true );
		wp_localize_script( 'custom-role-checkbox', 'my_ajax_url',
			array( 'ajax_url' => admin_url('admin-ajax.php' ) ) );
		
			
	}

	public function login_enqueue_scripts() {
		wp_enqueue_script( 'add_custom_role_checkbox', plugin_dir_url( __FILE__ ) . 'js/custom-role-checkbox.js', array( 'jquery' ), '1', false );
	}

	
	function custom_role_register_requset_major_buyer_function(){  
		global $wpdb;
		$major_buyer_table_name = $wpdb->prefix . 'customer_requests_custom_role_table';
		$new_user_email = $_POST['user_email'];
	
		if(email_exists($new_user_email)){
		$major_buyer_customer = get_user_by( 'email', $new_user_email );
		$wpdb->insert( $major_buyer_table_name, array(
		'customerid' => $major_buyer_customer->ID,
		'username' => $major_buyer_customer->user_email,
		'request_type' => 'major_buyer'
		));
		
		}
		wp_send_json( [
		'customerid' =>$major_buyer_customer->ID,
		'username' =>$major_buyer_customer->user_email
		]);
	
      }

	function custom_role_register_request_fixed_customer_function(){
		global $wpdb;
		$new_user_email = $_POST['user_email'];
		$fixed_customer_table_name = $wpdb->prefix . "customer_requests_custom_role_table";
		if(email_exists($new_user_email)){
		$fixed_customer_customer = get_user_by( 'email', $new_user_email );
		$wpdb->insert( $fixed_customer_table_name, array(
		'customerid' => $fixed_customer_customer->ID,
		'username' => $fixed_customer_customer->user_email,
		'request_type' => 'fixed_customer'
		));
		}
		wp_send_json( [
		'customerid' =>$fixed_customer_customer->ID,
		'username' =>$fixed_customer_customer->user_email
		] );
      }

	
    

}
