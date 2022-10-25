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

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
		wp_enqueue_script( 'ajax_script', plugin_dir_url( __FILE__ ) . 'js/test.js', array( 'jquery' ), $this->version, true );
		wp_localize_script( 'ajax_script', 'my_ajax_object',
			array( 'ajax_url' => admin_url('admin-ajax.php' ) ) );
        wp_enqueue_script('jquery-datatables-js','//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js',array('jquery'));
	}
	
}
 