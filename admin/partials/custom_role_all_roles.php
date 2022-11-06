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
  ?>
    <div style = "font-size: 200%;margin: 10px;text-align: center;background-color: white;padding: 10px;border-radius: 28px;"> 
      <?php echo esc_html( get_admin_page_title() ); ?>
    </div>;
  <?php 
  $default_tab = 'major-buyer-requests';
  $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
  global $wpdb;
  $custom_role_request_table_name = $wpdb->prefix . 'customer_requests_custom_role_table';
  $major_buyer_request_results = $wpdb->get_results("SELECT * FROM $custom_role_request_table_name WHERE request_type = 'major_buyer' ");
  $fixed_customer_request_results = $wpdb->get_results("SELECT * FROM $custom_role_request_table_name WHERE request_type = 'fixed_customer' ");
  ?>
    <div class="wrap">    
      <!-- Here are our tabs -->
      <nav class="nav-tab-wrapper">
        <a href="?page=requests.php&tab=major-buyer-requests" class="nav-tab <?php if($tab=='major-buyer-requests'):?>nav-tab-active<?php endif; ?>">Major Buyers requests</a>
        <a href="?page=requests.php&tab=fixed-customer-requests" class="nav-tab <?php if($tab=='fixed-customer-requests'):?>nav-tab-active<?php endif; ?>">Fixed Customer requests</a>
        
      </nav>

      <div class="tab-content">
      <?php switch($tab) :
        case 'major-buyer-requests':
          
          echo 'major_buyer'; //Put your HTML here
          if(!empty($major_buyer_request_results)){
            ?>
              <table class="widefat" style="border-radius: 15px;">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>customerid</th>
                  <th>action</th>
                </tr>
                </thead>
                <?php foreach($major_buyer_request_results as $row): ?>
                <tr>
                  <td><?php echo $row->id ; ?></td>
                  <td><?php echo $row->username ; ?></td>
                  <td><?php echo $row->customerid ; ?></td>
                  <td>
                      <a href="#" data-customerid="<?php echo $row->customerid ?>" data-action="confirm_major_buyer" class= "action-requests">confirm</a>
                      ||
                      <a href="#" data-customerid="<?php echo $row->customerid ?>" data-action="refuse_major_buyer" class= "action-requests">refuse</a>
                  </td>
                </tr>
                <?php endforeach ?>    
              </table>
            <?php 
        }
          
          break;
        case 'fixed-customer-requests':
          echo 'fixed_customer_requests';
          if(!empty($fixed_customer_request_results)){
            ?>
              <table class="widefat" style="border-radius: 15px;">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>customerid</th>
                  <th>action</th>
                </tr>
                </thead>
                <?php foreach($fixed_customer_request_results as $row): ?>
                <tr>
                  <td><?php echo $row->id ; ?></td>
                  <td><?php echo $row->username ; ?></td>
                  <td><?php echo $row->customerid ; ?></td>
                  <td>
                      <a href="#" data-customerid="<?php echo $row->customerid ?>" data-action="confirm_fixed_customer" class= "action-requests" >confirm</a>
                      ||
                      <a href="#" data-customerid="<?php echo $row->customerid ?>" data-action="refuse_fixed_customer" class= "action-requests" >refuse</a>
                  </td>
                </tr>
                <?php endforeach ?>    
              </table>
            <?php 
        }
          break;
        default:
          echo 'Default tab';
          break;
      endswitch; ?>
      </div>
    </div>
  <?php
}

function custom_role_show_settings_func(){
  echo '<div style = "font-size: 200%;margin: 10px;text-align: center;background-color: white;padding: 10px;border-radius: 28px;">Settings</div>';
}





