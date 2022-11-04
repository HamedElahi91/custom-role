<?php
function custom_role_show_major_customer_func(){
  echo '<div style = "font-size: 200%;margin: 10px;text-align: center;background-color: white;padding: 10px;border-radius: 28px;">Major Buyers</div>';
    $args = array(
      'role'    => "Major buyer",
      'orderby' => 'user_email',
      'order'   => 'ASC'
  );
  $users = get_users( $args );
  ?>
  <table id="major-buyers-table" class="widefat" style="border-radius: 15px;">
    <thead>
    <tr>
      <th>id</th>
      <th>Name</th>
      <th>number</th>
      <th>Purchase</th>
    </tr>
    </thead>
    <tbody>
        <?php  foreach($users as $user): ?>
              <tr>
                <td><?php echo $user->ID ; ?></td>
                <td><?php echo $user->user_name ; ?></td>
                <td><?php echo $user->user_email ; ?></td>
                <td>
                  <?php
                      
                        $total = 0;
                        $args2 = array(
                        'customer_id' => $user->ID,
                        'limit' => -1, // to get _all_ orders from this user
                        );
                        // call WC API
                        $orders = wc_get_orders($args2);
                        foreach ($orders as $order){
                          if($order->get_customer_id() == $user->ID){
                            $total+= intval($order->get_subtotal());
                          }
                          
                        }
                        if (0 != $total){
                          echo $total;
                        }else{
                          echo 0;
                        }
                      
                      
                    ?>
                </td>
                
              </tr>
          <?php endforeach  ?>
        </tbody>       
  </table>
  <?php
}
function custom_role_show_fixed_customer_func(){
  echo '<div style = "font-size: 200%;margin: 10px;text-align: center;background-color: white;padding: 10px;border-radius: 28px;">Fixed Customers</div>';
  $args = array(
    'role'    => "Fixed customer",
    'orderby' => 'user_email',
    'order'   => 'ASC'
  );
  $users = get_users( $args );
  ?>
  <table id = "fixed-customer-table" class="widefat" style="border-radius: 15px;">
    <thead>
    <tr>
      <th>id</th>
      <th>Name</th>
      <th>number</th>
      <th>Purchase</th>
    </tr>
    </thead>
        <?php foreach($users as $user): ?>
              <tr>
                <td><?php echo $user->ID ; ?></td>
                <td><?php echo $user->display_name ; ?></td>
                <td><?php echo $user->user_email ; ?></td>
                <td>
                  <?php
                      
                        $total = 0;
                        $args2 = array(
                        'customer_id' => $user->ID,
                        'limit' => -1, // to get _all_ orders from this user
                        );
                        // call WC API
                        $orders = wc_get_orders($args2);
                        foreach ($orders as $order){
                          if($order->get_customer_id() == $user->ID){
                            $total+= intval($order->get_subtotal());
                          }
                          
                        }
                        if (0 != $total){
                          echo $total;
                        }else{
                          echo 0;
                        }
                      
                      
                    ?>
                </td>
                
              </tr>
          <?php endforeach ?>    
  </table>
  <?php
}
function custom_role_show_requests_func(){
  echo '<div style = "font-size: 200%;margin: 10px;text-align: center;background-color: white;padding: 10px;border-radius: 28px;">Requests</div>';
  ?>
              <div>
                    <h1>
                          hello
                    </h1>
              </div>
        <?php
}

function custom_role_show_settings_func(){
  echo '<div style = "font-size: 200%;margin: 10px;text-align: center;background-color: white;padding: 10px;border-radius: 28px;">Settings</div>';
}


function custom_role_show_datatable(){
 ?>
  <table id="example">
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </thead>
    <tbody></tbody>
  </table>
 <?php
}


// function custom_role_register_requset_major_buyer_function(){  
//   global $wpdb;
//   $major_buyer_table_name = $wpdb->prefix . "customer_requests_custom_role_table";
//   $new_user_email = $_POST['user_email'];

//   if(email_exists($new_user_email)){
//   $major_buyer_customer = get_user_by( 'email', $new_user_email );
//   $wpdb->insert( $major_buyer_table_name, array(
//   'customerid' => $major_buyer_customer->ID,
//   'username' => $major_buyer_customer->user_email,
//   'request_type' => 'major_buyer'
//   ));
  
//   }
//   wp_send_json( [
//   'customerid' =>$major_buyer_customer->ID,
//   'username' =>$major_buyer_customer->user_email
//   ]);

//     }

// function custom_role_register_request_fixed_customer_function(){
//   //   global $wpdb;
//   //   $new_user_email = $_POST['user_email'];
//   //   $fixed_customer_table_name = $wpdb->prefix . "customer_requests_custom_role_table";
//   //   if(email_exists($new_user_email)){
//   //     $fixed_customer_customer = get_user_by( 'email', $new_user_email );
//   //     $wpdb->insert( $fixed_customer_table_name, array(
//   //       'customerid' => $fixed_customer_customer->ID,
//   //       'username' => $fixed_customer_customer->user_email,
//   //       'request_type' => 'fixed_customer'
//   //       ));
//   //   }

// }




