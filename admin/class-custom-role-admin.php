<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://egeekbin.com
 * @since      1.0.0
 *
 * @package    Custom_Role
 * @subpackage Custom_Role/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_Role
 * @subpackage Custom_Role/admin
 * @author     Hamed Elahi <elahi.hamed@hotmail.com>
 */
class Custom_Role_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	private $ajax_handler;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->load_dependencis();
		$this->ajax_handler = new Custom_Role_Ajax_Handler;
		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function load_dependencis(){
		require_once plugin_dir_path( __FILE__ ) . 'partials/class-cr-ajax-handler.php';
	}
	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-role-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style('jquery-datatables-css','//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css');
		wp_enqueue_style('fontawesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_enqueue_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap2','https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
		wp_enqueue_style('select2library','https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');



	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-role-admin.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script('jquery-datatables-js','//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js',array('jquery'));
		
		if(!strcmp($_SERVER['REQUEST_URI'] , '/wp-admin/admin.php?page=define-customers.php&tab=fixed-customer-definition' )){
			wp_enqueue_script('definition_fc_value_condition', plugin_dir_url( __FILE__ ) . 'js/definition-fc-value-condition.js', array( 'jquery' ), $this->version, true);
		}
		
		if(!strcmp($_SERVER['REQUEST_URI'], '/wp-admin/admin.php?page=requests.php&tab=fixed-customer-requests') || !strcmp($_SERVER['REQUEST_URI'], '/wp-admin/admin.php?page=requests.php&tab=major-buyer-requests') || !strcmp($_SERVER['REQUEST_URI'], '/wp-admin/admin.php?page=requests.php') ){
			wp_enqueue_script('custom_role_confirm_actions', plugin_dir_url( __FILE__ ) . 'js/custom_role_confirm_requests.js' ,array('jquery'), null, true);
		}
		wp_enqueue_script('cr-mb-add-dsicount-rules', plugin_dir_url( __FILE__ ) . 'js/cr-mb-add-discount-rules.js' ,array('jquery'));
		
		// wp_enqueue_script('cr-jq-repeater', plugin_dir_url( __FILE__ ) . 'vendors/repeatable-field-group/jquery.repeater.min.js' ,array('jquery'));
		wp_enqueue_script('cr-jq-repeater-frest', plugin_dir_url( __FILE__ ) . 'vendors/form-repeater/js/jquery.repeater.min.js' ,array('jquery'));
		wp_enqueue_script('cr-jq-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js' ,array('jquery'), null, true);
		wp_enqueue_script('select2library', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js' ,array('jquery'), null, true);
	

	}

	

	public function change_user_role_manually_function($user_id, $role){
		global $wpdb;
		$custom_role_major_customer_table_name = $wpdb->prefix . 'major_buyer_custom_role_table';
		$custom_role_fixed_customer_table_name = $wpdb->prefix . 'fixed_customer_custom_role_table';
		$current_user_email = get_user_by( 'id', $user_id )->user_email;
		switch ($role){
			case "Major buyer":
				$wpdb->insert($custom_role_major_customer_table_name, array(
					'customerid' => $user_id,
					'username' => $current_user_email
				));
				break;
			case "Fixed customer":
				$wpdb->insert($custom_role_fixed_customer_table_name, array(
					'customerid' => $user_id,
					'username' => $current_user_email
				));
				break;
		
		}
	}
	


}
 