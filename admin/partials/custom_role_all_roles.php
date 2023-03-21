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
      <th>Action</th>
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
                <td><a href="" class="action-btn action-btn-major-buyer" data-customer-id="<?php echo $user->ID;?>" data-customer-type="major_buyer"> Remove <i class="fa fa-remove" style="font-size: 150%;"></i> </a></td>
                
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
      <th>Action</th>
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
                <td><a href="" class="action-btn action-btn-fixed-customer" data-customer-id="<?php echo $user->ID;?>" data-customer-type="fixed_customer"> Remove <i class="fa fa-remove" style="font-size: 150%;"></i> </a></td>

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
  ?>
    <input id= "test_btn" type="button" value="test">
  <?php
}

function custom_role_define_customers_func(){
  $default_tab = 'major-buyer-definition';
  $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
  global $wpdb;
  ?>
  <div class="wrap">    
      <!-- Here are our tabs -->
      <nav class="nav-tab-wrapper">
        <a href="?page=define-customers.php&tab=major-buyer-definition" class="nav-tab <?php if($tab=='major-buyer-definition'):?>nav-tab-active<?php endif; ?>">Major Buyers definition</a>
        <a href="?page=define-customers.php&tab=fixed-customer-definition" class="nav-tab <?php if($tab=='fixed-customer-definition'):?>nav-tab-active<?php endif; ?>">Fixed Customer definition</a>
        
      </nav>

      <div class="tab-content">
      <?php switch($tab) {
        case 'major-buyer-definition':
          break;
        case 'fixed-customer-definition':
          ?>
          <form action="" method="get" id="fixed-customer-definition-form">
            <div class="form-row">
              <div class="col">
                <label for="value-condition">value:</label>
                <input name="value-condition" id="value-condition" type="text">
                <input type="submit" id="save-val-condition" value="Save">
              </div>
            </div>
          </form>  
          <?php
          break;
        default:
          echo 'Default tab';
          break;
        } ?>
      </div>
    </div>
  <?php
}
function custom_role_discounts_func(){
  $default_tab = 'major-buyer-discounts';
  $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
  global $wpdb;
  ?>
  <div class="wrap">    
      <!-- Here are our tabs -->
      <nav class="nav-tab-wrapper">
        <a href="?page=discounts.php&tab=major-buyer-discounts" class="nav-tab <?php if($tab=='major-buyer-discounts'):?>nav-tab-active<?php endif; ?>">Major Buyers discounts</a>
        <a href="?page=discounts.php&tab=fixed-customer-discounts" class="nav-tab <?php if($tab=='fixed-customer-discounts'):?>nav-tab-active<?php endif; ?>">Fixed Customer discounts</a>
        
      </nav>

      <div class="tab-content">
      <?php 
      switch($tab) {
        case 'major-buyer-discounts':
          ?>
            <div class="discount-roles">
              <div id="mb-discount-rules-header-section" class="discount-roles-header">
                <p>
                اعمال تخفیف بر روی یک یا چند محصول                
                </p>
              </div>
              <!-- outer repeater -->
              <div class="repeater">
                <div data-repeater-list="outer-list" id="mb-discount-rules-main-section" class="discount-roles-main">
                  <div data-repeater-item class="outer-list ">
                    <i data-repeater-delete class="fa fa-window-close" aria-hidden="true"></i>
                    <table class="table table-striped">
                      <form  action="#" class="" enctype="multipart/form-data">
                        <tr>
                          <td>
                            <label  for="note-text" >Note</label>
                          </td>
                          <td>
                          <label  for="explain-text"  >Explain</label>
                          </td>
                        </tr>
                        <tr>
                          <td ><input  type="text" id="note-text" /></td>
                          <td><input  type="text" id="explain-text"/></td>
                        </tr>
                        <tr>
                          <td>
                          <label for="discount-value">Set</label>
                          </td>
                          <td>
                          <label for="discount-mode">Kind</label>
                          </td>
                        </tr>
                        <tr>
                          <td><input  type="number" id="discount-value" name="discount-value"/></td>
                          <td>
                            <select name="discount-mode" id="discount-mode">
                              <option value="fixed">fixed</option>
                              <option value="percentage">percentage</option>
                            </select>
                          </td>
                        </tr>
                      </form>
                    </table>
                    <!-- innner repeater -->
                    <div class="inner-repeater container" style="width: 100%;">
                      <div  data-repeater-list="inner-list" id="inner-list">
                        <div data-repeater-item style="float: right; width:100%">
                          <div class="col-md-2">
                            <select class="form-control" style="width: 100%;">
                              <option>
                                product
                              </option>
                              <option>
                                product tag
                              </option>
                              <option>
                                product category
                              </option>
                            </select>
                          </div>
                          <div class="col-md-2">
                            <select class="form-control" style="width: 100%;">
                                <option>
                                  in list
                                </option>
                                <option>
                                  not in list
                                </option>
                            </select>
                          </div>
                          <div class="col-md-7">
                            <!-- <input type="search" style="width: 100%;"> -->
                            <select style="width: 100%;" id="search-product-select" class="product-select form-control" multiple="multiple">
                              
                            </select>
                          </div>
                          <div class="col-md-1">
                            <i data-repeater-delete class="fa fa-window-close" style="float: left;" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                      <button  data-repeater-create class="btn btn-primary add-product-rules">add product</button>
                    </div>
                    <hr style="border-top: 2px solid black;"/>
                  </div>
              </div>
              <div id="mb-discount-rules-footer-section" class="discount-roles-footer">
                    <button class="btn btn-success" id="mb-discount-rules-save-chenges" style="float:left;">
                      ذخیره تغییرات
                    </button>
                    <button data-repeater-create class="button button-primary" id="mb-discount-rules-add-rule">
                    اضافه کردن قانون جدید
                  </button>
                </div>
            </div>
            <?php
            break;
        case 'fixed-customer-discounts':
            ?>
              <!-- <form class="form repeater-default">
                <div data-repeater-list>
                   
                  <div data-repeater-item class="group-a">
                    <div class="row justify-content-between">
                      <div class="col-md-1 col-sm-12 form-group d-flex align-items-center pt-2">
                        <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                          X
                        </button>
                      </div>
                      <div class="col-md-4 col-sm-12 form-group">
                        <label for="note">Note</label>
                        <input type="text" name="note" id="note" class="form-control discount-note"  placeholder="write a note">
                      </div>
                      <div class="col-md-7 col-sm-12 form-group">
                        <label for="explain">Explain</label>
                        <input type="text" name="explain" id="explain" class="form-control discount-explain" placeholder="write an explain">
                      </div>
                      <div class="col-md-5 col-sm-12 form-group">
                        <label for="set">Set</label>
                        <input type="number" id="set">
                      </div>
                      <div class="col-md-5 col-sm-12 form-group">
                        <label for="kind">Kind</label>
                        <select name="kind" id="kind" class="form-control">
                          <option value="fixed">Fixed</option>
                          <option value="percentage">Percentage</option>
                        </select>
                      </div>
                    </div>  
                  </div>        
                  
                  <div data-repeater-list>
                    <div data-repeater-item class="group-b">
                      <div class="row justify-content-between">
                        <div class="col-md-6 col-sm-12 form-group">
                          <label for="search-product">search</label>
                          <input type="search" class="form-control" id="search-product" placeholder="Search products">
                        </div>
                        <div class="col-md-2 col-sm-12 form-group">
                          <label for="list">List</label>
                          <select name="list" id="list" class="form-control">
                            <option value="in-list">In list</option>
                            <option value="not-in-list">Not in list</option>
                          </select>
                        </div>
                        <div class="col-md-2 col-sm-12 form-group">
                          <label for="product">Product</label>
                          <select name="profession" id="Profession" class="form-control">
                            <option value="product">Product</option>
                            <option value="product-category">Product category</option>
                            <option value="Product-tag">Product tag</option>
                          </select>
                        </div>
                        <div class="col-md-1 col-sm-12 form-group d-flex align-items-center pt-2">
                          <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                            -
                          </button>
                        </div>
                        <div class="col-md-1 col-sm-12 form-group d-flex align-items-center pt-2">
                          <button class="btn btn-primary" data-repeater-create type="button"> <i class="bx bx-x"></i>
                            +
                          </button>
                        </div>
                      </div>
                      <hr>
                    </div>  
                  </div>
                  
                  
                  </div>
                  
                      </div>
                  </div>
                </div>
                <div class="form-group">
                    <div class="col p-0">
                      <button class="btn btn-primary" data-repeater-create type="button"><i class="bx bx-plus"></i>
                        Add
                      </button>
                    </div>
              </form> -->
            <div class="discount-rules">
              <div id="fc-discount-rules-header-section" class="discount-rules-header">
                <p>
                اعمال تخفیف بر روی یک یا چند محصول                
                </p>
              </div>
              <div id="fc-discount-rules-main-section" class="discount-rules-main">
                <form class="fc-repeater">
                  <div data-repeater-list="fc-outer-list">
                    <div data-repeater-item class="container fc-outer-list">
                      <div class="col-md-4 col-sm-12 d-flex align-items-stretch">
                        <input type="text" name="fc-note" id="fc-note" placeholder="Note">
                      </div>
                      <div class="col-md-7 col-sm-12 d-flex align-items-stretch">
                        <input type="text" name="fc-explain" id="fc-explain" placeholder="Explain">
                      </div>
                      <div class="col-md-1 col-sm-12 d-flex align-items-stretch">
                        <input data-repeater-delete type="button" class="btn btn-danger" value="X"/>
                      </div>
                      <!-- inner repeater -->
                      <div class="fc-inner-repeater">
                        <div data-repeater-list="fc-inner-list">
                          <div data-repeater-item class="container">
                            <div class="col-md-4 col-sm-12 fc-search-input">
                              <select name="fc-search-product" class="fc-search-product-select form-control" id="fc-search-product" placeholder="Search some products" multiple="multiple">

                              </select>
                            </div>
                            <div class="col-md-3 col-sm-12">
                              <select name="" id="">
                                <option value="in-list" >In List</option>
                                <option value="not-in-list">Not In List</option>
                              </select>
                            </div>
                            <div class="col-md-3 col-sm-12">
                              <select name="" id="">
                                <option value="fc-product">Product</option>
                                <option value="fc-product-category">Product Category</option>
                                <option value="fc-product-tag">Product Tag</option>
                              </select>
                            </div>
                            <div class="col-md-1 col-sm-12">
                              <input data-repeater-delete type="button" class="btn btn-danger" value="-"/> 
                            </div>
                          </div>
                        </div>
                        <input data-repeater-create type="button" class="btn btn-info add-row" value="+"/>
                      </div>
                      <hr style="border-top: 2px solid red; color:red">
                    </div>
                  </div>
                  <input type="button" data-repeater-create class="button button-primary add-rules" value="Add New Rule" id="fc-discount-rules-add-rule"/>
                </form>
              </div>
              <div id="fc-discount-rules-footer-section" class="discount-rules-footer d-flex align-items-stretch">
                <button class="btn btn-success" id="mb-discount-rules-save-chenges" style="float:left;">
                  ذخیره تغییرات
                </button>
              </div>
            </div>
              
            <?php
            break;
          default:
            echo 'Default tab';
            break;
          } 
          ?>
      </div>
    </div>
  <?php
}



