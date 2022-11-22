<?php
//All Pages
$page_arr=array();
foreach(get_pages() as $key=>$val){
    $page_arr[$val->ID]=$val->post_title;
}

//All users
$users_arr=array();
global $wp_roles;
$users = $wp_roles->get_names();
foreach($users as $user){

    $users_arr[$user]=$user;
}


$settings = array(
    array(
        'name' => __( 'Price Configuration', 'discount_price_login_user' ),
        'type' => 'title',
        'id'   => $prefix . 'price_config_settings'
    ),
  
    array(
        'id'        => $prefix . 'setting_user_type',
        'name'      => __( 'User Type', 'discount_price_login_user' ), 
        'type'      => 'multiselect',
        'class'     => 'wc-enhanced-select',
        'options'   => $users_arr,
        'desc_tip'  => __( ' The primary user type ( user Roles )', 'discount_price_login_user')
    ),


    array(
        'id'        => $prefix . 'setting_page_type',
        'name'      => __( 'page Type', 'discount_price_login_user' ), 
        'type'      => 'multiselect',
        'class'     => 'wc-enhanced-select',
        'options'   =>$page_arr,
        'desc_tip'  => __( ' The primary page type (all pages)', 'discount_price_login_user')
    ),
    array(
        'id'        => $prefix . 'setting_discount_rate',
        'name'      => __( 'Discount rate in %', 'discount_price_login_user' ), 
        'type'      => 'number',
        'desc_tip'  => __( ' The numeric designation of this discount price to login user.', 'wooplug')
    ),
    array(
        'id'        => $prefix . 'setting_discount_expiry_date',
        'name'      => __( 'Discount rate limit date', 'discount_price_login_user' ), 
        'type'      => 'date',
        'desc_tip'  => __( ' This date is expiry date of discount rate', 'discount_price_login_user')
    ),
    array(
        'id'        => $prefix . 'ship_in_service',
        'name'      => __( 'Enable/Disable(by user & page)', 'discount_price_login_user' ),
        'type'      => 'checkbox',
        'desc'  => __( 'check this box if You want to apply.', 'discount_price_login_user' ),
        'default'   => 'yes'
    ),   
    array(
        '' => __( 'Price Configuration', 'discount_price_login_user' ),
        'type' => 'title',
        'id'   => $prefix . 'price_config_settings'
    ),          
                        
);
?>
