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
  <table class="widefat" style="border-radius: 15px;">
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
function custom_role_show_fixed_customer_func(){
  echo '<div style = "font-size: 200%;margin: 10px;text-align: center;background-color: white;padding: 10px;border-radius: 28px;">Fixed Customers</div>';
  $args = array(
    'role'    => "Fixed customer",
    'orderby' => 'user_email',
    'order'   => 'ASC'
  );
  $users = get_users( $args );
  ?>
  <table class="widefat" style="border-radius: 15px;">
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
}

function custom_role_show_settings_func(){
  echo '<div style = "font-size: 200%;margin: 10px;text-align: center;background-color: white;padding: 10px;border-radius: 28px;">Settings</div>';
}




   





