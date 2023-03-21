<?php
class Custom_Role_Ajax_Handler{

      public function __construct()
      {
            // Register the AJAX action
            add_action( 'wp_ajax_test2', array( $this, 'test2_function' ) );
            add_action( 'wp_ajax_remove_customer_role', array( $this, 'remove_customer_role_function' ) );
            add_action( 'wp_ajax_receive_customer_requests', array( $this, 'receive_customer_requests_function' ) );
            add_action( 'wp_ajax_fc_search_products_data_fetch', array( $this, 'fc_search_products_data_fetch_function' ) );
            add_action( 'wp_ajax_update_fc_value_condition', array( $this, 'update_fc_value_condition_func' ) );
      }

      public function test2_function(){
            wp_send_json_success(array(
                  'res' => 'success',
                  'sdf' => '123'
            )); 
      }

      public function remove_customer_role_function(){
		$customer_id = $_POST['customer_id'];
		$customer_type = $_POST['customer_type'];
		global $wpdb;
		
		switch ($customer_type){
			case "major_buyer":
				get_user_by( 'id', $customer_id ) -> set_role('customer');
				$wpdb->delete($wpdb->prefix . 'major_buyer_custom_role_table', array( 'customerid' => $customer_id ));
				wp_send_json( array(
					'msg' => 'majo',
					'id' => $customer_id
				));
				break;
			case "fixed_customer":
				get_user_by( 'id', $customer_id ) -> set_role('customer');
				$wpdb->delete($wpdb->prefix . 'fixed_customer_custom_role_table', array( 'customerid' => $customer_id ));
				wp_send_json( array(
					'msg' => 'fix',
					'id' => $customer_id
				));
				break;
			default:
			wp_send_json( array(
				'msg' => 'error',
				'id' => $customer_id
			));

		}
	}

	public function receive_customer_requests_function(){
		$customer_id = $_POST['customerid'];
		$request_type = $_POST['type'];
		$user = get_user_by( 'id', $customer_id );
		global $wpdb;
		switch ($request_type){
			case "confirm_major_buyer":
				$user->set_role('Major buyer');
				$wpdb->delete($wpdb->prefix.'customer_requests_custom_role_table', array('customerid' => $customer_id));
				break;
			
			case "refuse_major_buyer":
				$wpdb->delete($wpdb->prefix.'customer_requests_custom_role_table', array('customerid' => $customer_id));
				break;

			case "confirm_fixed_customer":
				$user->set_role('Fixed customer');
				
				$wpdb->delete($wpdb->prefix.'customer_requests_custom_role_table', array('customerid' => $customer_id));
				break;
			case "refuse_fixed_customer":
				$wpdb->delete($wpdb->prefix.'customer_requests_custom_role_table', array('customerid' => $customer_id));
				break;
			default:

		}
		 
		wp_json_encode( array(
			"success" =>"yes"
		) );
	}

	public function fc_search_products_data_fetch_function(){
		
		$search_query = esc_attr($_POST['q']) ;
		
		$products = get_posts( array(
			'post_type' => 'product',
			'numberposts' => 5,
			'post_status' => 'publish',
			's' => $search_query
		   ) );
		
		$final=[];
		if($products){
			$finalIds =  array_column($products, 'ID');
			$finalTitles= array_column($products, 'post_title');
			$final = array_combine($finalIds,$finalTitles);			
		}
		
		
		wp_send_json($final);
		
	}

	public function update_fc_value_condition_func(){
		
		header('Content-Type: application/json');
		global $wpdb;
		$custom_role_fixed_customer_table_name = $wpdb->prefix . 'fixed_customer_custom_role_table';
		$condition_value = $_POST['value'];
		$customer_args = array(
			'role' => 'customer'
		  );
		$customers = get_users( $customer_args );
		
		$fixed_customer_args =  array(
			'role' => 'Fixed customer'
		);
		$fixed_customers = get_users($fixed_customer_args);
	

		$customer_ids = []; 
		$customernames = []; 
		foreach($customers as $customer){
			$total = 0;
                  $args2 = array(
                        'customer_id' => $customer->ID,
                        'limit' => -1, // to get _all_ orders from this user
                  );
                  // call WC API
                  $orders = wc_get_orders($args2);
                  foreach ($orders as $order){
                  	if($order->get_customer_id() == $customer->ID){
                            $total+= intval($order->get_subtotal());
                        }
                  }
			if($total >= $condition_value){
				$user = get_user_by('id', $customer->ID);
				$user->set_role('Fixed customer');
				$wpdb->insert($custom_role_fixed_customer_table_name, array(
					'customerid' => $user->ID,
					'username' => $user->user_email
				));
				
				
			}	
		}

		foreach($fixed_customers as $customer){
			$total = 0;
                  $args2 = array(
                        'customer_id' => $customer->ID,
                        'limit' => -1, // to get _all_ orders from this user
                  );
			$orders = wc_get_orders($args2);

                  foreach ($orders as $order){
                  	if($order->get_customer_id() == $customer->ID){
                            $total+= intval($order->get_subtotal());
                        }
                  }

			if($total < $condition_value){
				$user = get_user_by('id', $customer->ID);
				$user->set_role('customer');
				$wpdb->delete($custom_role_fixed_customer_table_name , array('customerid' => $user->ID));
			}	
		}
		$result = array(
		'msg' => 'true',
		'val' => $customernames
		);
		
		
		wp_send_json_success($result);
	}
}