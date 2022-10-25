<?php

function custom_role_add_menu(){
    global $submenu;
    add_menu_page( 'Custom Roles1', 'Custom Roles', 'manage_options', 'custom-roles.php', 'custom_role_show_major_customer_func');
    add_submenu_page( 'custom-roles.php', 'Fixed Customers', 'Fixed Customers','manage_options', 'fixed-customers.php', 'custom_role_show_fixed_customer_func');
    add_submenu_page( 'custom-roles.php', 'Requests', 'Requests','manage_options', 'requests.php','custom_role_show_requests_func');
    add_submenu_page( 'custom-roles.php', 'Settings', 'Settings','manage_options', 'settings.php','custom_role_show_settings_func');
    add_submenu_page( 'custom-roles.php', 'Test Table', 'Test Table','manage_options', 'test.php', 'custom_role_show_datatable');
    $submenu['custom-roles.php'][0][0] = 'Major Buyers';
}

add_action( 'admin_menu', 'custom_role_add_menu' );